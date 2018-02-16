<?php

/* update.html */
class __TwigTemplate_9bbce4baa46fc7dda23778418a7047fcc038d9b67ff8a236a6eec4350722a238 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.html", "update.html", 1);
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
<div class=\"wrap mailpoet-about-wrap\">
  <h1>";
        // line 6
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Greetings, humans.");
        echo "</h1>

  <p class=\"about-text\">";
        // line 8
        echo MailPoet\Util\Helpers::replaceLinkTags($this->env->getExtension('MailPoet\Twig\I18n')->translate("Thanks for using MailPoet! We really appreciate all of your love, affection, [link]and (good) plugin reviews.[/link]"), "https://wordpress.org/support/plugin/wysija-newsletters/reviews/", array("target" => "_blank"));
        // line 11
        echo "
  </p>
  <div class=\"mailpoet-logo\"><img src=\"";
        // line 13
        echo $this->env->getExtension('MailPoet\Twig\Assets')->generateImageUrl("welcome_template/mailpoet-logo.png");
        echo "\" alt=\"MailPoet Logo\" /></div>

  <h2 class=\"nav-tab-wrapper wp-clearfix\">
    <a href=\"admin.php?page=mailpoet-welcome\" class=\"nav-tab\">";
        // line 16
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Welcome");
        echo "</a>
    <a href=\"admin.php?page=mailpoet-update\" class=\"nav-tab nav-tab-active\">";
        // line 17
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("What's New");
        echo "</a>
  </h2>

  <div id=\"mailpoet-changelog\" class=\"feature-section one-col\">
    <h2 class=\"mailpoet-feature-top\">";
        // line 21
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("List of Changes");
        echo "</h2>
    ";
        // line 22
        if ((isset($context["changelog"]) ? $context["changelog"] : null)) {
            // line 23
            echo "      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["changelog"]) ? $context["changelog"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 24
                echo "        <h3>";
                echo twig_escape_filter($this->env, $this->getAttribute($context["item"], "version", array()), "html", null, true);
                echo "</h3>
        <ul>
          ";
                // line 26
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["item"], "changes", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["change"]) {
                    // line 27
                    echo "            <li>";
                    echo twig_escape_filter($this->env, $context["change"], "html", null, true);
                    echo "</li>
          ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['change'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 29
                echo "        </ul>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 31
            echo "    ";
        } else {
            // line 32
            echo "      <p style=\"text-align: center\">";
            echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("See readme.txt for a changelog.");
            echo "</p>
    ";
        }
        // line 34
        echo "    <a class=\"button button-secondary\" href=\"https://wordpress.org/plugins/mailpoet/#developers\" target=\"_blank\">";
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("View all changes");
        echo " &rarr;</a>
  </div>

  <hr>

  ";
        // line 39
        if ( !$this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "analytics", array()), "enabled", array())) {
            // line 40
            echo "    <div class=\"feature-section one-col mailpoet_centered\">
      <h2>";
            // line 41
            echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Do Your Part to Make MailPoet Better");
            echo "</h2>
      <div class=\"lead-description\">

        <label>
          <input type=\"checkbox\" id=\"mailpoet_analytics_enabled\" value=\"1\">&nbsp;
          ";
            // line 46
            echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Yes, share my data anonymously.");
            echo "
        </label>
      </div>
      <p class=\"top-space-triple\">";
            // line 49
            echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("By sharing your data with us, you can help us understand what our users like (and don't like).");
            echo "
        ";
            // line 50
            echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("We use it to prioritize and develop new plugin features.");
            echo "<br>
        ";
            // line 51
            echo MailPoet\Util\Helpers::replaceLinkTags($this->env->getExtension('MailPoet\Twig\I18n')->translate("Share your data to help shape the future of MailPoet! [link]Read more.[/link]"), "http://beta.docs.mailpoet.com/article/130-sharing-your-data-with-us", array("target" => "_blank"));
            // line 54
            echo "
    </div>

    <hr>
  ";
        }
        // line 59
        echo "
  <div class=\"feature-section one-col mailpoet_centered\">
    <h2>";
        // line 61
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Care to Give Your Opinion?");
        echo "</h2>

    <script type=\"text/javascript\" charset=\"utf-8\" src=\"//secure.polldaddy.com/p/9801036.js\"></script>
    <noscript><a href=\"//polldaddy.com/poll/9801036/\">Should MailPoet include more default templates?</a></noscript>
  </div>

  <hr>

  <div class=\"feature-section one-col mailpoet_centered\">
    <a class=\"button button-primary go-to-plugin\" href=\"admin.php?page=mailpoet-newsletters\">";
        // line 70
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Awesome! Now, take me to MailPoet");
        echo " &rarr;</a>
  </div>

</div>

<script type=\"text/javascript\">
  jQuery(function(\$) {
    \$(function() {
      MailPoet.trackEvent(
        'User has updated MailPoet',
        {'MailPoet Free version': window.mailpoet_version}
      );
    });
    \$('#mailpoet_analytics_enabled').on('click', function() {
      var is_enabled = \$(this).is(':checked') ? true : '';
      MailPoet.Ajax.post({
        api_version: window.mailpoet_api_version,
        endpoint: 'settings',
        action: 'set',
        data: {
          analytics: { enabled: (is_enabled)}
        }
      }).fail((response) => {
        if (response.errors.length > 0) {
          MailPoet.Notice.error(
            response.errors.map((error) => { return error.message; }),
            { scroll: true }
          );
        }
      });
    })
  });

</script>
";
    }

    public function getTemplateName()
    {
        return "update.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  170 => 70,  158 => 61,  154 => 59,  147 => 54,  145 => 51,  141 => 50,  137 => 49,  131 => 46,  123 => 41,  120 => 40,  118 => 39,  109 => 34,  103 => 32,  100 => 31,  93 => 29,  84 => 27,  80 => 26,  74 => 24,  69 => 23,  67 => 22,  63 => 21,  56 => 17,  52 => 16,  46 => 13,  42 => 11,  40 => 8,  35 => 6,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "update.html", "/var/www/vhosts/how2behealthy.nl/httpdocs/wp-content/plugins/mailpoet/views/update.html");
    }
}
