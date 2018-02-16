<?php

/* premium.html */
class __TwigTemplate_b957a015a276e1c8948e9cdaa7a9af52f2da7a82abeecbc156490fdb13d2b693 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.html", "premium.html", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "
<style type=\"text/css\">
.mailpoet_video {
  border: 1px solid rgba(0, 0, 0, 0.1);
}
</style>

<div class=\"wrap about-wrap\">
  <h1 style=\"text-align: center; margin-right: 0;\">";
        // line 12
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("What is MailPoet Premium?");
        echo "</h1>

  <p class=\"about-text\" style=\"text-align: center; margin-right: 0;\">";
        // line 14
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Detailed statistics, actionable insights, awesome deliverability, plus great support!");
        echo "</p>

  <hr>

  <div class=\"feature-section one-col\">
    <h2>";
        // line 19
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Insightful Statistics");
        echo "</h2>
    <p class=\"lead-description\">";
        // line 20
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Which links get the most clicks? Which subscribers opened your emails? With MailPoet's stats program, it's easy to find out. Need even more details? Integrating with Google Analytics is as easy as 1-2-3.");
        echo "</p>
    ";
        // line 21
        $context["video_url"] = "//ps.w.org/mailpoet/assets/premium/premium-page-animated-stats.mp4";
        // line 22
        echo "    <video autoplay loop width=\"100%\" class=\"mailpoet_video\">
      <source type=\"video/mp4\" src=\"";
        // line 23
        echo twig_escape_filter($this->env, (isset($context["video_url"]) ? $context["video_url"] : null), "html", null, true);
        echo "\" />
      <a href=\"";
        // line 24
        echo twig_escape_filter($this->env, (isset($context["video_url"]) ? $context["video_url"] : null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, (isset($context["video_url"]) ? $context["video_url"] : null), "html", null, true);
        echo "</a>
    </video>
  </div>

  <hr>

  <div class=\"feature-section one-col\">
    <h2>";
        // line 31
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Hello Inbox, Goodbye Spambox!");
        echo "</h2>
    <p class=\"lead-description\">";
        // line 32
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("The MailPoet Sending Service's delivery rate is over 98%: one of the best in the industry! Our in-house sending service is constantly monitored, tweaked, and improved to make sure that your emails arrive successfully.");
        echo "</p>
    <table class=\"widefat\">
      <thead>
        <tr>
         <td></td>
         <td><strong>";
        // line 37
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("MailPoet");
        echo "</strong></td>
         <td><strong>";
        // line 38
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Web host");
        echo "</strong></td>
         <td><strong>";
        // line 39
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Third party");
        echo "</strong></td>
        </tr>
      </thead>
      <tbody>
        <tr class=\"alternate\">
         <td><strong>";
        // line 44
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Speed");
        echo "</strong></td>
         <td>";
        // line 45
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("50,000 / hour");
        echo "</td>
         <td>";
        // line 46
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("300 / hour");
        echo "</td>
         <td>";
        // line 47
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("2,000 / hour");
        echo "</td>
        </tr>
        <tr>
         <td><strong>";
        // line 50
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Daily email limits");
        echo "</strong></td>
         <td>";
        // line 51
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("None");
        echo "</td>
         <td>";
        // line 52
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Yes");
        echo "</td>
         <td>";
        // line 53
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Depends");
        echo "</td>
        </tr>
        <tr class=\"alternate\">
         <td><strong>";
        // line 56
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Personal deliverability support");
        echo "</strong></td>
         <td>";
        // line 57
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Yes!");
        echo "</td>
         <td>";
        // line 58
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("No");
        echo "</td>
         <td>";
        // line 59
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("No");
        echo "</td>
        </tr>
        <tr>
         <td><strong>";
        // line 62
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("SPF and DKIM Signatures");
        echo "</strong></td>
         <td>";
        // line 63
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("No need!");
        echo "</td>
         <td>";
        // line 64
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Update your DNS");
        echo "</td>
         <td>";
        // line 65
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Depends");
        echo "</td>
        </tr>
        <tr class=\"alternate\">
         <td><strong>";
        // line 68
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Double opt-in");
        echo "</strong></td>
         <td>";
        // line 69
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Enforced");
        echo "</td>
         <td>";
        // line 70
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Not enforced");
        echo "</td>
         <td>";
        // line 71
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Depends");
        echo "</td>
        </tr>
        <tr>
          <td>
            <a
              href=\"http://beta.docs.mailpoet.com/article/181-comparison-table-of-sending-methods?utm_source=plugin&utm_medium=premium&utm_campaign=compare\"
              target=\"_blank\"
            >
              ";
        // line 79
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("View full comparison table");
        echo "
            </a>
          </td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>
    <p>";
        // line 88
        echo twig_replace_filter($this->env->getExtension('MailPoet\Twig\I18n')->translate("Spammers are ineligible to use the MailPoet Sending Service. We reserve the right to cancel any sending plan if we detect more than 5% hard bounces. [link]Customers are required to clean their lists before joining MailPoet[/link]."), array("[link]" => "<a target=\"_blank\" href=\"http://beta.docs.mailpoet.com/article/127-checklist-before-importing-subscribers?utm_source=plugin&utm_medium=premium&utm_campaign=clean-lists\">", "[/link]" => "</a>"));
        // line 94
        echo "</p>
  </div>

  <hr>

  <div class=\"feature-section two-col\">
    <div class=\"col\">
      <h3>";
        // line 101
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Welcome to My Newsletter!");
        echo "</h3>
      ";
        // line 102
        $context["video_url"] = "//ps.w.org/mailpoet/assets/premium/premium-page-animated-welcome-emails.mp4";
        // line 103
        echo "      <video autoplay loop width=\"100%\" class=\"mailpoet_video\">
        <source type=\"video/mp4\" src=\"";
        // line 104
        echo twig_escape_filter($this->env, (isset($context["video_url"]) ? $context["video_url"] : null), "html", null, true);
        echo "\" />
        <a href=\"";
        // line 105
        echo twig_escape_filter($this->env, (isset($context["video_url"]) ? $context["video_url"] : null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, (isset($context["video_url"]) ? $context["video_url"] : null), "html", null, true);
        echo "</a>
      </video>
      <p>";
        // line 107
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Want to send autoresponders and welcome emails to your subscribers? In MailPoet, it’s easy as 1-2-3. Create welcome emails, educational courses, and other automatic email newsletters.");
        echo "</p>
    </div>
    <div class=\"col\">
      <h3>";
        // line 110
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("We’re Here to Help!");
        echo "</h3>
      ";
        // line 111
        $context["video_url"] = "//ps.w.org/mailpoet/assets/premium/premium-page-animated-support.mp4";
        // line 112
        echo "      <video autoplay loop width=\"100%\" class=\"mailpoet_video\">
        <source type=\"video/mp4\" src=\"";
        // line 113
        echo twig_escape_filter($this->env, (isset($context["video_url"]) ? $context["video_url"] : null), "html", null, true);
        echo "\" />
        <a href=\"";
        // line 114
        echo twig_escape_filter($this->env, (isset($context["video_url"]) ? $context["video_url"] : null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, (isset($context["video_url"]) ? $context["video_url"] : null), "html", null, true);
        echo "</a>
      </video>
      <p>";
        // line 116
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("We pride ourselves on giving nearly round-the-clock support. Our remote team spans several continents, hemispheres, and time-zones! If you’ve got a problem, we will help you fix it!");
        echo "</p>
    </div>
  </div>

  <hr>

  <div clas=\"feature-section one-col\">
    <h2>";
        // line 123
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Get Started for Just \$10");
        echo "</h2>
    <p class=\"lead-description\">";
        // line 124
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Our plans start at just \$10 per month. Each plan offers unlimited emails. Pricing scales up with the size of your list.");
        echo "</p>
    <br>
    <p style=\"text-align: center\">
      <a
        target=\"_blank\"
        href=\"https://account.mailpoet.com?s=";
        // line 129
        echo twig_escape_filter($this->env, (isset($context["subscriber_count"]) ? $context["subscriber_count"] : null), "html", null, true);
        echo "&utm_source=plugin&utm_medium=premium&utm_campaign=purchase\"
        class=\"button button-primary\"
        style=\"font-size: 1.5em; padding: 10px 18px; height: 46px;\"
      >";
        // line 132
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Purchase Now");
        echo "</a>
    </p>
    <br>
    <div style=\"width: 65%; margin: 0 auto;\">
      <p style=\"text-align: center\">";
        // line 136
        echo twig_replace_filter($this->env->getExtension('MailPoet\Twig\I18n')->translate("Don't need to use our sending service? Not a problem; we understand. You can also [link]buy the Premium[/link] features separately. Prices start at \$100 per year for 1 website, \$249 for 4 sites and \$499 for an unlimited number of sites."), array("[link]" => "<a target=\"_blank\" href=\"https://account.mailpoet.com/premium?utm_source=plugin&utm_medium=premium&utm_campaign=buy-premium\">", "[/link]" => "</a>"));
        // line 142
        echo "</p>
    </div>
  </div>

</div>

";
    }

    public function getTemplateName()
    {
        return "premium.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  312 => 142,  310 => 136,  303 => 132,  297 => 129,  289 => 124,  285 => 123,  275 => 116,  268 => 114,  264 => 113,  261 => 112,  259 => 111,  255 => 110,  249 => 107,  242 => 105,  238 => 104,  235 => 103,  233 => 102,  229 => 101,  220 => 94,  218 => 88,  206 => 79,  195 => 71,  191 => 70,  187 => 69,  183 => 68,  177 => 65,  173 => 64,  169 => 63,  165 => 62,  159 => 59,  155 => 58,  151 => 57,  147 => 56,  141 => 53,  137 => 52,  133 => 51,  129 => 50,  123 => 47,  119 => 46,  115 => 45,  111 => 44,  103 => 39,  99 => 38,  95 => 37,  87 => 32,  83 => 31,  71 => 24,  67 => 23,  64 => 22,  62 => 21,  58 => 20,  54 => 19,  46 => 14,  41 => 12,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "premium.html", "/var/www/vhosts/how2behealthy.nl/httpdocs/wp-content/plugins/mailpoet/views/premium.html");
    }
}
