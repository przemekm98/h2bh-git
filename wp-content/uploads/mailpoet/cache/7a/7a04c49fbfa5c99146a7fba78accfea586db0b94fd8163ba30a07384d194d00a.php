<?php

/* newsletter/templates/blocks/container/twoColumnLayoutWidget.hbs */
class __TwigTemplate_e05304207dd9ba54fa1c4e8e2a6f0dc47f38b8c1110eda89c198ead4ede84011 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"mailpoet_widget_icon\">
";
        // line 2
        echo twig_source($this->env, "newsletter/templates/svg/layout-icons/2-column.svg");
        echo "
</div>
<div class=\"mailpoet_widget_title\">";
        // line 4
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("2 columns");
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "newsletter/templates/blocks/container/twoColumnLayoutWidget.hbs";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  27 => 4,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "newsletter/templates/blocks/container/twoColumnLayoutWidget.hbs", "/var/www/vhosts/how2behealthy.nl/httpdocs/wp-content/plugins/mailpoet/views/newsletter/templates/blocks/container/twoColumnLayoutWidget.hbs");
    }
}
