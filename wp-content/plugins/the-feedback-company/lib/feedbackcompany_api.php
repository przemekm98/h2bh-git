<?php
	class feedbackcompany_api
	{
		// $this->ext is an extension object, with localized functions
		// for interacting with Wordpress or other web platforms
		// this is set via the constructor
		public $ext = '';

		private $expire_days_token = 20;
		private $expire_hours_summary = 1;
		private $expire_days_questions = 20;
		private $expire_days_shopsummary = 1;
		private $expire_days_reviews = 1;
		private $expire_days_testimonial = 20;

		function __construct($ext_obj)
		{
			$this->ext = $ext_obj;

			if (!$this->ext->get_cache('access_token'))
				$this->oauth_refreshtoken();
		}

		function oauth_refreshtoken()
		{
			$url = 'https://www.feedbackcompany.com/api/v2/oauth2/token'
				. '?client_id='.$this->ext->get_option('oauth_client_id')
				. '&client_secret='.$this->ext->get_option('oauth_client_secret')
				. '&grant_type=authorization_code';

			$result = $this->http_get($url);

			if (isset($result->access_token))
				$this->ext->set_cache('access_token', $result->access_token, 86400 * $this->expire_days_token);
		}

		// $retry is set to false on recursive requests, to prevent looping
		function http_get($url, $retry = true)
		{
			$args = array();
			$args['headers'] = array();

			if ($this->ext->get_cache('access_token'))
				$args['headers']['Authorization'] = 'Bearer '.$this->ext->get_cache('access_token');

			// Use Wordpress function if available
			if (function_exists('wp_remote_get'))
			{
				$response = wp_remote_get($url, $args);
				if (is_wp_error($response))
					return false;

				$response = json_decode($response['body']);

				// if token has somehow become invalid, delete token and retry request
				if (isset($response->message) && $response->message == '401 Unauthorized' && $retry)
				{
					$this->ext->delete_cache('access_token');
					$this->oauth_refreshtoken();
					return $this->http_get($url, false);
				}

				return $response;
			}
		}

		function get_shopsummary()
		{
			$result = $this->ext->get_cache('shopsummary');
			if (!$result)
			{
				$this->update_shopsummary();
				$result = $this->ext->get_cache('shopsummary');
			}
			return $result;
		}
		function update_shopsummary()
		{
			$url = 'https://www.feedbackcompany.com/api/v2/shop/summary/';
			$result = $this->http_get($url);
			if (!isset($result->data))
				return false;

			$this->ext->set_cache('shopsummary', $result, 3600 * $this->expire_days_shopsummary);
		}

		function get_questions()
		{
			$result = $this->ext->get_cache('questions');
			if (!$result)
			{
				$this->update_questions();
				$result = $this->ext->get_cache('questions');
			}
			return $result;
		}
		function update_questions()
		{
			$url = 'https://www.feedbackcompany.com/api/v2/question/';
			$result = $this->http_get($url);
			$this->ext->set_cache('questions', $result, 86400 * $this->expire_days_questions);
		}

		function get_reviews()
		{
			$result = $this->ext->get_cache('reviews');
			if (!$result)
			{
				$this->update_reviews();
				$result = $this->ext->get_cache('reviews');
			}
			return $result;
		}
		function update_reviews()
		{
			$url = 'https://www.feedbackcompany.com/api/v2/review/';
			$result = $this->http_get($url);
			if (!$result || !isset($result->reviews) || count($result->reviews) == 0)
				return;

			$this->ext->set_cache('reviews', $result, 86400 * $this->expire_days_reviews);
		}

		function get_review($id)
		{
			$result = $this->ext->get_cache('testimonial_'.$id);
			if ($result === false)
			{
				$this->update_review($id);
				$result = $this->ext->get_cache('testimonial_'.$id);
			}
			return $result;
		}
		function update_review($id)
		{
			$url = 'https://www.feedbackcompany.com/api/v2/review/get/?id='.$id;
			$result = $this->http_get($url);
			if (!$result || !isset($result->review))
				return;

			$this->ext->set_cache('testimonial_'.$id, $result, 86400 * $this->expire_days_testimonial);
		}

		function get_summary()
		{
			$result = $this->ext->get_cache('summary');
			if (!$result)
			{
				$this->update_summary();
				$result = $this->ext->get_cache('summary');
			}
			return $result;
		}
		function update_summary()
		{
			$url = 'https://www.feedbackcompany.com/api/v2/review/summary/';
			$result = $this->http_get($url);
			if (!isset($result->statistics) || !is_array($result->statistics))
				return false;

			$this->ext->set_cache('summary', $result, 3600 * $this->expire_hours_summary);
		}

		function clear_cache()
		{
			$this->ext->delete_cache('access_token');
			$this->ext->delete_cache('summary');
			$this->ext->delete_cache('reviews');
		}

		function format_star()
		{
			if ($this->ext->get_option('star_type'))
				return '&#'.$this->ext->get_option('star_type').';';
			else
				return '&#9733;';
		}
		function format_star_color()
		{
			return $this->ext->get_option('star_color');
		}
		function format_stars($score_max, $score)
		{
			$star_scale = $this->ext->get_option('star_scale');
			if (intval($star_scale) == 0)
				$star_scale = 5;

			$percent = $score / $score_max * 100;

			$ret = '<span class="feedbackcompany-stars">';
			$ret .= '<span class="feedbackcompany-stars-negative" style="width: '.(100 - $percent).'%;">';
			for ($i = 0; $i < $star_scale; $i++)
				$ret .= $this->format_star();
			$ret .= '</span>';
			$ret .= '<span class="feedbackcompany-stars-positive" style="width: '.$percent.'%;">';
			for ($i = 0; $i < $star_scale; $i++)
				$ret .= $this->format_star();
			$ret .= '</span>';
			$ret .= '</span>';

			return $ret;
		}

		function get_microdata()
		{
			static $executed = false;
			if ($executed)
				return false;

			$microdata = $this->ext->get_options('richsnippet_');
			if (!$microdata['schema'])
				return false;

			$ret = array();
			$ret['open'] = '<span itemscope itemtype="http://schema.org/'.$microdata['schema'].'">';
			unset($microdata['schema']);

			$ret['items'] = '';
			foreach ($microdata as $key => $value)
			{
				if ($value)
				{
					$ret['items'] .= '<meta '
//						. 'itemtype="http://schema.org/'
//						. (strpos($value, 'www') || strpos($value, '://') ? 'URL' : 'Text').'"'
						. 'itemprop="'.$key.'" content="'.$value.'" />'."\n";
				}
			}

			$ret['rating_open'] = '<span itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';
			$ret['rating_value_open'] = '<span itemprop="ratingValue">';
			$ret['rating_value_close'] = '</span>';
			$ret['rating_count_open'] = '<span itemprop="reviewCount">';
			$ret['rating_count_close'] = '</span>';
			$ret['rating_max_open'] = '<span itemprop="bestRating">';
			$ret['rating_max_close'] = '</span>';
			$ret['rating_close'] = '</span>';

			$ret['close'] = '</span>';

			$executed = true;
			return $ret;
		}

		function simple_score()
		{
			$ret = '';

			$shopsummary = $this->get_shopsummary();
			$summary = $this->get_summary();

			if (!isset($summary->statistics) || !is_array($summary->statistics))
				return false;

			// find question with final score to base widget on
			foreach ($summary->statistics as $q)
				if (isset($q->question_type) && $q->question_type == 'final_score')
					$question = $q;
			// no final score?  stop here
			if (!isset($question))
				return false;

			$microdata = $this->get_microdata();

			$star_scale = $this->ext->get_option('star_scale');
			if (intval($star_scale) == 0)
				$star_scale = 5;

			$score_max = $question->maxscore;
			$score = $question->value;
			$percent = $score / $score_max * 100;

			if ($microdata)
				$ret .= $microdata['open'];

			$ret .= '<span class="feedbackcompany-simple">';
			$ret .= $this->format_stars($score_max, $score);

			if ($microdata)
				$ret .= $microdata['rating_open'];

			$score_scale = $this->ext->get_option('score_scale');
			if ($microdata)
				$ret .= $microdata['rating_value_open'];
			$ret .= str_replace('.', ',', $percent / 100 * $score_scale);
			if ($microdata)
				$ret .= $microdata['rating_value_close'];
			$ret .= ' van ';
			if ($microdata)
				$ret .= $microdata['rating_max_open'];
			$ret .= $score_scale;
			if ($microdata)
				$ret .= $microdata['rating_max_close'];
			$ret .= ' op basis van ';

			if ($microdata)
				$ret .= $microdata['rating_count_open'];
			$ret .= $question->count;
			if ($microdata)
				$ret .= $microdata['rating_count_close'];
			$ret .= ' '.($question->count == 1 ? 'beoordeling' : 'beoordelingen');

			if ($microdata)
				$ret .= $microdata['rating_close'];

			$ret .= ' bij ';
			$ret .= '<a target="_blank" class="feedbackcompany-link" href="'.$shopsummary->data->company_page_url.'">';
			$ret .= 'Feedback Company';
			$ret .= '</a>';
			$ret .= '</span>';

			if ($microdata)
				$ret .= $microdata['items'];

			if ($microdata)
				$ret .= $microdata['close'];

			return $ret;
		}

		function widget_score()
		{
			$ret = '';

			$shopsummary = $this->get_shopsummary();
			$summary = $this->get_summary();

			if (!isset($summary->statistics) || !is_array($summary->statistics))
				return false;

			// find question with final score to base widget on
			foreach ($summary->statistics as $q)
				if (isset($q->question_type) && $q->question_type == 'final_score')
					$question = $q;
			// no final score?  stop here
			if (!isset($question))
				return false;

			$microdata = $this->get_microdata();

			$star_scale = $this->ext->get_option('star_scale');
			if (intval($star_scale) == 0)
				$star_scale = 5;

			$score_max = $question->maxscore;
			$score = $question->value;
			$percent = $score / $score_max * 100;

			if ($microdata)
				$ret .= $microdata['open'];

			$ret .= '<a target="_blank" class="feedbackcompany-link" href="'.$shopsummary->data->company_page_url.'">';
			$ret .= '<span class="feedbackcompany-widget">';

			$ret .= '<span class="feedbackcompany-widgetheader">';
			$ret .= esc_html($this->ext->get_option('title_score'));
			$ret .= '</span>';

			if ($microdata)
				$ret .= $microdata['rating_open'];

			$ret .= $this->format_stars($score_max, $score);

			$score_scale = $this->ext->get_option('score_scale');
			$ret .= '<span class="feedbackcompany-score">';
			if ($microdata)
				$ret .= $microdata['rating_value_open'];
			$ret .= str_replace('.', ',', $percent / 100 * $score_scale);
			if ($microdata)
				$ret .= $microdata['rating_value_close'];
			$ret .= ' van ';
			if ($microdata)
				$ret .= $microdata['rating_max_open'];
			$ret .= $score_scale;
			if ($microdata)
				$ret .= $microdata['rating_max_close'];
			$ret .= '</span>';

			$ret .= '<span class="feedbackcompany-amount">';
			if ($microdata)
				$ret .= $microdata['rating_count_open'];
			$ret .= $question->count;
			if ($microdata)
				$ret .= $microdata['rating_count_close'];
			$ret .= ' '.($question->count == 1 ? 'beoordeling' : 'beoordelingen');
			$ret .= '</span>';

			if ($microdata)
				$ret .= $microdata['rating_close'];

			$ret .= '<span class="feedbackcompany-source">';
			$ret .= '<div><img alt="Feedback Company" src="'.$this->ext->get_url().'/images/feedbackcompany-logo-81x23.png" '
				. 'srcset="'.$this->ext->get_url().'/images/feedbackcompany-logo-162x46.png 2x"></div>';
			if ($shopsummary->data->buysmart_enabled)
				$ret .= '<div><img alt="BuySmart veilig kopen" src="'.$this->ext->get_url().'/images/buysmart-logo-81x16.png" '
					. 'srcset="'.$this->ext->get_url().'/images/buysmart-logo-162x32.png 2x"></div>';
			$ret .= '</span>';

			$ret .= '</span>';
			$ret .= '</a>';

			if ($microdata)
				$ret .= $microdata['items'];

			if ($microdata)
				$ret .= $microdata['close'];

			$ret .= '<br style="clear: both;">';

			return $ret;
		}

		function widget_reviews()
		{
			$ret = '';
			$ret_reviews = '';

			$shopsummary = $this->get_shopsummary();
			$reviews = $this->get_reviews();

			if (!isset($reviews->reviews) || count($reviews->reviews) == 0)
				return;

			$i = 0;
			foreach ($reviews->reviews as $review)
			{
				if ($i >= 10)
					break;

				$main_open = null;
				$final_score = null;

				foreach ($review->questions as $question)
				{
					if (!isset($question->type))
						continue;

					if ($question->type == 'main_open')
						$main_open = $question;
					if ($question->type == 'final_score')
						$final_score = $question;
				}

				if (!$main_open || !$main_open->value || !$final_score)
					continue;

				// TODO - maxscore is hier hard ingesteld op 5... de API geeft in een reviews call geen maxscore mee?

				if ($final_score->value < 4)
					continue;

				$ret_reviews .= '<span id="feedbackcompany-reviewslider'.$i.'">';

				$ret_reviews .= $this->format_stars(5, $final_score->value);

				$ret_reviews .= '<span class="feedbackcompany-reviewauthor">';
				$ret_reviews .= htmlentities($review->client->name);
				$ret_reviews .= '</span>';
				$ret_reviews .= '<span class="feedbackcompany-reviewcontent">';
				$ret_reviews .= htmlentities($main_open->value);
				$ret_reviews .= '</span>';

				$ret_reviews .= '</span>';

				$i++;
			}

			// geen reviews om weer te geven? stop hier
			if (!$ret_reviews)
				return false;

			// widget
			$ret .= '<a target="_blank" class="feedbackcompany-link" href="'.$shopsummary->data->company_page_url.'">';
			$ret .= '<span class="feedbackcompany-widget">';

			$ret .= '<span class="feedbackcompany-widgetheader">';
			$ret .= esc_html($this->ext->get_option('title_reviews'));
			$ret .= '</span>';

			// review output
			$ret .= $ret_reviews;

			// placeholder om hoogte vast te zetten
			$ret .= '<span id="feedbackcompany-placerholder-reviewslider" style="visibility: hidden;">';
			$ret .= $this->format_stars(5, 5);
			$ret .= '<span class="feedbackcompany-reviewauthor"></span>';
			$ret .= '<span class="feedbackcompany-reviewcontent"></span>';
			$ret .= '</span>';

			$ret .= '<span class="feedbackcompany-source">';
			$ret .= '<div><img alt="Feedback Company" src="'.$this->ext->get_url().'/images/feedbackcompany-logo-81x23.png" '
				. 'srcset="'.$this->ext->get_url().'/images/feedbackcompany-logo-162x46.png 2x"></div>';
			if ($shopsummary->data->buysmart_enabled)
				$ret .= '<div><img alt="BuySmart veilig kopen" src="'.$this->ext->get_url().'/images/buysmart-logo-81x16.png" '
					. 'srcset="'.$this->ext->get_url().'/images/buysmart-logo-162x32.png 2x"></div>';
			$ret .= '</span>';

			$ret .= '</span>';
			$ret .= '</a>';

			$ret .= '<br style="clear: both;">';

			return $ret;
		}

		function widget_testimonial($review_id)
		{
			$ret = '';

			$shopsummary = $this->get_shopsummary();
			$review = $this->get_review($review_id);

			if (!isset($review->review))
				return;

			$main_open = null;
			$final_score = null;

			foreach ($review->review->questions as $question)
			{
				if (!isset($question->type))
					continue;

				if ($question->type == 'main_open')
					$main_open = $question;
				if ($question->type == 'final_score')
					$final_score = $question;
			}

			if (!$main_open || !$main_open->value || !$final_score)
				return '';

			// TODO - maxscore is hier hard ingesteld op 5... de API geeft in een reviews call geen maxscore mee?

			$ret .= '<a target="_blank" class="feedbackcompany-link" href="'.$shopsummary->data->company_page_url.'">';
			$ret .= '<span class="feedbackcompany-widget">';

			$ret .= '<span class="feedbackcompany-widgetheader">';
			$ret .= esc_html($this->ext->get_option('title_testimonial'));
			$ret .= ' '.trim($review->review->client->name);
			$ret .= '</span>';

			$ret .= $this->format_stars(5, $final_score->value);

			$ret .= '<span class="feedbackcompany-reviewcontent">';
			$ret .= htmlentities($main_open->value);
			$ret .= '</span>';

			$ret .= '<span class="feedbackcompany-source">';
			$ret .= '<div><img alt="Feedback Company" src="'.$this->ext->get_url().'/images/feedbackcompany-logo-81x23.png" '
				. 'srcset="'.$this->ext->get_url().'/images/feedbackcompany-logo-162x46.png 2x"></div>';
			if ($shopsummary->data->buysmart_enabled)
				$ret .= '<div><img alt="BuySmart veilig kopen" src="'.$this->ext->get_url().'/images/buysmart-logo-81x16.png" '
					. 'srcset="'.$this->ext->get_url().'/images/buysmart-logo-162x32.png 2x"></div>';
			$ret .= '</span>';

			$ret .= '</span>';
			$ret .= '</a>';

			$ret .= '<br style="clear: both;">';

			return $ret;

			$ret .= '<span class="feedbackcompany-amount">';
			$ret .= $question->count.' '.($question->count == 1 ? 'beoordeling' : 'beoordelingen');
			$ret .= '</span>';

			return $ret;
		}
	}

