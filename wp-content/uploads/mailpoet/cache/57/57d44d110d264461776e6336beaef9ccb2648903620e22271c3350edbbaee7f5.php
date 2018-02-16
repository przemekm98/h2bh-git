<?php

/* settings/mta.html */
class __TwigTemplate_16940eb7f2a32ec212b4c60ed8ae20e43cb396e76aa8714924425ce5bcbb3007 extends Twig_Template
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
        $context["intervals"] = array(0 => 1, 1 => 2, 2 => 5, 3 => 10, 4 => 15, 5 => 30);
        // line 2
        $context["default_frequency"] = array("website" => array("emails" => 25, "interval" => 5), "smtp" => array("emails" => 100, "interval" => 5));
        // line 12
        echo "
<!-- mta: group -->
<input
  type=\"hidden\"
  id=\"mta_group\"
  name=\"mta_group\"
  value=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta_group", array()), "html", null, true);
        echo "\"
/>
<input
  type=\"hidden\"
  id=\"mailpoet_smtp_provider\"
  name=\"mailpoet_smtp_provider\"
  value=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "smtp_provider", array()), "html", null, true);
        echo "\"
/>
<!-- mta: method -->
<input
  type=\"hidden\"
  id=\"mta_method\"
  name=\"mta[method]\"
  value=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta", array()), "method", array()), "html", null, true);
        echo "\"
/>

<!-- mta: sending frequency -->
<input
  type=\"hidden\"
  id=\"mta_frequency_emails\"
  name=\"mta[frequency][emails]\"
  value=\"";
        // line 39
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta", array()), "frequency", array()), "emails", array()), "html", null, true);
        echo "\"
/>
<input
  type=\"hidden\"
  id=\"mta_frequency_interval\"
  name=\"mta[frequency][interval]\"
  value=\"";
        // line 45
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta", array()), "frequency", array()), "interval", array()), "html", null, true);
        echo "\"
/>

<!-- mta: mailpoet sending service key -->
<input
  type=\"hidden\"
  id=\"mailpoet_api_key\"
  name=\"mta[mailpoet_api_key]\"
  value=\"";
        // line 53
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta", array()), "mailpoet_api_key", array()), "html", null, true);
        echo "\"
/>

<!-- smtp: available sending methods -->
<ul class=\"mailpoet_sending_methods clearfix\">
  <li
    data-group=\"mailpoet\"
    ";
        // line 60
        if (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta_group", array()) == "mailpoet")) {
            echo "class=\"mailpoet_active\"";
        }
        // line 61
        echo "  >
    <h3>
      <img
        src=\"";
        // line 64
        echo twig_escape_filter($this->env, (isset($context["assets_url"]) ? $context["assets_url"] : null), "html", null, true);
        echo "/img/mailpoet_logo.png\"
        alt=\"MailPoet\"
        width=\"137\"
        height=\"54\"
      />
    </h3>

    <p
      class=\"mailpoet_description";
        // line 72
        if (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta_group", array()) != "mailpoet")) {
            echo " mailpoet_hidden";
        }
        echo "\"
      id=\"mailpoet_sending_method_active_text\"
    >
      <strong>";
        // line 75
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("You're now sending with MailPoet!");
        echo "</strong>
      <br />
      ";
        // line 77
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Great, you're all set up. Your emails will now be sent quickly and reliably!");
        echo "
    </p>

    <p
      class=\"mailpoet_description";
        // line 81
        if (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta_group", array()) == "mailpoet")) {
            echo " mailpoet_hidden";
        }
        echo "\"
      id=\"mailpoet_sending_method_inactive_text\"
    >
      <strong>";
        // line 84
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Solve all of your sending problems!");
        echo "</strong>
      <br />
      ";
        // line 86
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Let MailPoet send your emails and get the Premium features for as little as 10 dollars or euros per month.");
        echo "
      <br/>
      <br/>
      <a
        href=\"";
        // line 90
        echo admin_url("admin.php?page=mailpoet-premium");
        echo "\"
        class=\"button button-primary\"
      >";
        // line 92
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Find out more");
        echo "</a>
    </p>

    <div class=\"mailpoet_status\">
      <span>";
        // line 96
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Activated");
        echo "</span>
    </div>

    <div class=\"mailpoet_actions\">
      <button
        type=\"button\"
        class=\"mailpoet_sending_service_activate button-secondary\"
        ";
        // line 103
        if ((($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta_group", array()) == "mailpoet") ||  !(isset($context["mss_key_valid"]) ? $context["mss_key_valid"] : null))) {
            echo " disabled=\"disabled\"";
        }
        // line 104
        echo "      >";
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Activate");
        echo "</button>
    </div>
  </li>
  <li
    data-group=\"other\"
    ";
        // line 109
        if ((($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta_group", array()) == "smtp") || ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta_group", array()) == "website"))) {
            echo "class=\"mailpoet_active\"";
        }
        // line 110
        echo "  >
  <h3>";
        // line 111
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Other");
        echo "</h3>
  <p class=\"mailpoet_description\">
    <strong>";
        // line 113
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Send with your website or third party");
        echo "</strong>
    <br />
    ";
        // line 115
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Choose to send emails through your website (not recommended) or a third party sender.");
        echo "
  </p>

  <div class=\"mailpoet_status\">
    <span>";
        // line 119
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Activated");
        echo "</span>
  </div>

  <div class=\"mailpoet_actions\">
    <a
      class=\"button-secondary\"
      href=\"#mta/other\">";
        // line 125
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Configure");
        echo "</a>
  </div>
  </li>
</ul>

<p class=\"mailpoet_sending_methods_help help\">
  ";
        // line 131
        echo MailPoet\Util\Helpers::replaceLinkTags($this->env->getExtension('MailPoet\Twig\I18n')->translate("Need help to pick? [link]Check out the comparison table of sending methods[/link]."), "http://beta.docs.mailpoet.com/article/181-comparison-table-of-sending-methods", array("target" => "_blank"));
        // line 134
        echo "
</p>

<div id=\"mailpoet_sending_method_setup\">

  <!-- Sending Method: Other -->
  <div class=\"mailpoet_sending_method\" data-group=\"other\" style=\"display:none;\">
    <table class=\"form-table\">
      <tr>
        <th scope=\"row\">
          <label for=\"mailpoet_smtp_method\">
            ";
        // line 145
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Method");
        echo "
          </label>
        </th>
        <td>
          <!-- smtp provider -->
          <select
            id=\"mailpoet_smtp_method\"
            name=\"smtp_provider\"
          >
            <option data-interval=\"5\" data-emails=\"25\" value=\"server\">
              ";
        // line 155
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Your web host / web server");
        echo "
            </option>
            <option data-interval=\"5\" data-emails=\"100\" value=\"manual\"
              ";
        // line 159
        if (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta_group", array()) == "smtp")) {
            // line 161
            echo "              selected=\"selected\"
              ";
        }
        // line 163
        echo "            >
              ";
        // line 164
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("SMTP");
        echo "
            </option>
            <!-- providers -->
            <optgroup label=\"";
        // line 167
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Select your provider");
        echo "\">
              ";
        // line 168
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["hosts"]) ? $context["hosts"] : null), "smtp", array()));
        foreach ($context['_seq'] as $context["host_key"] => $context["host"]) {
            // line 169
            echo "              <option
                value=\"";
            // line 170
            echo twig_escape_filter($this->env, $context["host_key"], "html", null, true);
            echo "\"
                data-emails=\"";
            // line 171
            echo twig_escape_filter($this->env, $this->getAttribute($context["host"], "emails", array()), "html", null, true);
            echo "\"
                data-interval=\"";
            // line 172
            echo twig_escape_filter($this->env, $this->getAttribute($context["host"], "interval", array()), "html", null, true);
            echo "\"
                data-fields=\"";
            // line 173
            echo twig_escape_filter($this->env, twig_join_filter($this->getAttribute($context["host"], "fields", array()), ","), "html", null, true);
            echo "\"
              ";
            // line 174
            if (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "smtp_provider", array()) == $context["host_key"])) {
                // line 175
                echo "              selected=\"selected\"
              ";
            }
            // line 177
            echo "              >";
            echo twig_escape_filter($this->env, $this->getAttribute($context["host"], "name", array()), "html", null, true);
            echo "</option>
              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['host_key'], $context['host'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 179
        echo "            </optgroup>
          </select>
        </td>
      </tr>
      <tr id=\"mailpoet_sending_method_host\"
        ";
        // line 185
        if (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta_group", array()) == "smtp")) {
            // line 187
            echo "        style=\"display:none;\"
        ";
        }
        // line 189
        echo "      >
        <th scope=\"row\">
          <label for=\"mailpoet_web_host\">
            ";
        // line 192
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Your web host");
        echo "
          </label>
        </th>
        <td>
          <p>
            <!-- sending frequency -->
            <select
              id=\"mailpoet_web_host\"
              name=\"web_host\"
            >

              <!-- web hosts -->
              <option
                value=\"\"
                data-emails=\"25\"
                data-interval=\"5\"
                label=\"";
        // line 208
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Select your web host");
        echo "\"
              >
              ";
        // line 210
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["hosts"]) ? $context["hosts"] : null), "web", array()));
        foreach ($context['_seq'] as $context["host_key"] => $context["host"]) {
            // line 211
            echo "              <option
                value=\"";
            // line 212
            echo twig_escape_filter($this->env, $context["host_key"], "html", null, true);
            echo "\"
                data-emails=\"";
            // line 213
            echo twig_escape_filter($this->env, $this->getAttribute($context["host"], "emails", array()), "html", null, true);
            echo "\"
                data-interval=\"";
            // line 214
            echo twig_escape_filter($this->env, $this->getAttribute($context["host"], "interval", array()), "html", null, true);
            echo "\"
              ";
            // line 215
            if (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "web_host", array()) == $context["host_key"])) {
                // line 216
                echo "              selected=\"selected\"
              ";
            }
            // line 218
            echo "              >";
            echo twig_escape_filter($this->env, $this->getAttribute($context["host"], "name", array()), "html", null, true);
            echo "</option>
              ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['host_key'], $context['host'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 220
        echo "            </select>
            &nbsp;
            <!-- website: sending frequency -->
            <span id=\"mailpoet_website_sending_frequency\"></span>
          </p>

        </td>
      </tr>
      <tr>
        <th scope=\"row\">
          <label for=\"mailpoet_web_host\">
            ";
        // line 231
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Sending frequency");
        echo "
          </label>
        </th>
        <td>
          <p>
            <!-- sending frequency -->
            <select
              id=\"mailpoet_sending_frequency\"
              name=\"mailpoet_sending_frequency\"
            >
              <option value=\"auto\">
                ";
        // line 242
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Recommended");
        echo "
              </option>
              <option value=\"manual\"
                ";
        // line 246
        if ( !($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mailpoet_sending_frequency", array()) == "auto")) {
            // line 248
            echo "                selected=\"selected\"
                ";
        }
        // line 250
        echo "              >
                ";
        // line 251
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("I'll set my own frequency");
        echo "
              </option>
            </select>
            <span id=\"mailpoet_recommended_daily_emails\"></span>
          </p>
          <div id=\"mailpoet_sending_frequency_manual\"
            ";
        // line 258
        if (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mailpoet_sending_frequency", array()) == "auto")) {
            // line 260
            echo "              style=\"display: none\"
            ";
        }
        // line 262
        echo "          >
            <p>
              <input
                id=\"other_frequency_emails\"
                type=\"number\"
                min=\"1\"
                max=\"1000\"
              ";
        // line 269
        if (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta_group", array()) == "website")) {
            // line 270
            echo "              value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta", array()), "frequency", array()), "emails", array()), "html", null, true);
            echo "\"
              ";
        } else {
            // line 272
            echo "              value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["default_frequency"]) ? $context["default_frequency"] : null), "website", array()), "emails", array()), "html", null, true);
            echo "\"
              ";
        }
        // line 274
        echo "              />
              ";
        // line 275
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("emails");
        echo "
              <select id=\"other_frequency_interval\">
                ";
        // line 277
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["intervals"]) ? $context["intervals"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["interval"]) {
            // line 278
            echo "                <option
                  value=\"";
            // line 279
            echo twig_escape_filter($this->env, $context["interval"], "html", null, true);
            echo "\"
                ";
            // line 281
            if (( !$this->getAttribute($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta", array()), "frequency", array()), "interval", array()) && (            // line 282
$context["interval"] == $this->getAttribute($this->getAttribute((isset($context["default_frequency"]) ? $context["default_frequency"] : null), "website", array()), "interval", array())))) {
                // line 284
                echo "                selected=\"selected\"
                ";
            }
            // line 286
            echo "                ";
            if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta", array()), "frequency", array()), "interval", array()) == $context["interval"])) {
                // line 287
                echo "                selected=\"selected\"
                ";
            }
            // line 289
            echo "                >
                ";
            // line 290
            echo $this->env->getExtension('MailPoet\Twig\Functions')->getSendingFrequency($context["interval"]);
            echo "
                ";
            // line 291
            if (($context["interval"] == $this->getAttribute($this->getAttribute((isset($context["default_frequency"]) ? $context["default_frequency"] : null), "website", array()), "interval", array()))) {
                // line 292
                echo "                (";
                echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("recommended");
                echo ")
                ";
            }
            // line 294
            echo "                </option>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['interval'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 296
        echo "              </select>
              <span id=\"mailpoet_other_daily_emails\"></span>
            </p>
            <br />
            <p>
              ";
        // line 301
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("<strong>Warning!</strong> Sending more than the recommended amount of emails? You may break the terms of your web host or provider!");
        echo "'
              <br />
              ";
        // line 303
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Please ask your host for the maximum number of emails you are allowed to send per day.");
        echo "
            </p>
          </div>
        </td>
      </tr>
      <tr class=\"mailpoet_smtp_field\" data-field=\"host\"
        ";
        // line 310
        if ((($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta_group", array()) != "smtp") || ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "smtp_provider", array()) != "manual"))) {
            // line 312
            echo "        style=\"display:none;\"
        ";
        }
        // line 314
        echo "      >
        <th scope=\"row\">
          <label for=\"settings[mta_host]\">
            ";
        // line 317
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("SMTP Hostname");
        echo "
          </label>
          <p class=\"description\">
            ";
        // line 320
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("e.g.: smtp.mydomain.com");
        echo "
          </p>
        </th>
        <td>
          <input
            type=\"text\"
            class=\"regular-text\"
            id=\"settings[mta_host]\"
            name=\"mta[host]\"
            value=\"";
        // line 329
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta", array()), "host", array()), "html", null, true);
        echo "\" />
        </td>
      </tr>
      <!-- smtp: port -->
      <tr class=\"mailpoet_smtp_field\" data-field=\"port\"
        ";
        // line 335
        if ((($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta_group", array()) != "smtp") || ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "smtp_provider", array()) != "manual"))) {
            // line 337
            echo "        style=\"display:none;\"
        ";
        }
        // line 339
        echo "      >
        <th scope=\"row\">
          <label for=\"settings[mta_port]\">
            ";
        // line 342
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("SMTP Port");
        echo "
          </label>
        </th>
        <td>
          <input
            type=\"number\"
            max=\"65535\"
            min=\"1\"
            maxlength=\"5\"
            style=\"width:5em;\"
            id=\"settings[mta_port]\"
            name=\"mta[port]\"
            value=\"";
        // line 354
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta", array()), "port", array()), "html", null, true);
        echo "\"
          />
        </td>
      </tr>

      <!-- smtp: amazon region -->
      <tr class=\"mailpoet_aws_field\" data-field=\"region\"
        ";
        // line 362
        if ((($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta_group", array()) != "smtp") || ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "smtp_provider", array()) != "AmazonSES"))) {
            // line 364
            echo "        style=\"display:none;\"
        ";
        }
        // line 366
        echo "      >
        <th scope=\"row\">
          <label for=\"settings[mta_region]\">
            ";
        // line 369
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Region");
        echo "
          </label>
        </th>
        <td>
          <select
            id=\"settings[mta_region]\"
            name=\"mta[region]\"
            value=\"";
        // line 376
        if (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta_group", array()) == "smtp")) {
            // line 377
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta", array()), "region", array()), "html", null, true);
        }
        // line 378
        echo "\"
          >
            ";
        // line 380
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["hosts"]) ? $context["hosts"] : null), "smtp", array()), "AmazonSES", array()), "regions", array()));
        foreach ($context['_seq'] as $context["region"] => $context["server"]) {
            // line 381
            echo "            <option
              value=\"";
            // line 382
            echo twig_escape_filter($this->env, $context["server"], "html", null, true);
            echo "\"
            ";
            // line 383
            if (($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta", array()), "region", array()) == $context["server"])) {
                // line 384
                echo "            selected=\"selected\"
            ";
            }
            // line 386
            echo "            >
            ";
            // line 387
            echo twig_escape_filter($this->env, $context["region"], "html", null, true);
            echo "
            </option>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['region'], $context['server'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 390
        echo "          </select>
        </td>
      </tr>

      <!-- smtp: amazon access_key -->
      <tr class=\"mailpoet_aws_field\" data-field=\"access_key\"
        ";
        // line 397
        if ((($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta_group", array()) != "smtp") || ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "smtp_provider", array()) != "AmazonSES"))) {
            // line 399
            echo "        style=\"display:none;\"
        ";
        }
        // line 401
        echo "      >
        <th scope=\"row\">
          <label for=\"settings[mta_access_key]\">
            ";
        // line 404
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Access Key");
        echo "
          </label>
        </th>
        <td>
          <input
            type=\"text\"
            class=\"regular-text\"
            id=\"settings[mta_access_key]\"

            name=\"mta[access_key]\"
            value=\"";
        // line 414
        if (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta_group", array()) == "smtp")) {
            // line 415
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta", array()), "access_key", array()), "html", null, true);
        }
        // line 416
        echo "\"
          />
        </td>
      </tr>

      <!-- smtp: amazon secret_key -->
      <tr class=\"mailpoet_aws_field\" data-field=\"secret_key\"
        ";
        // line 424
        if ((($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta_group", array()) != "smtp") || ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "smtp_provider", array()) != "AmazonSES"))) {
            // line 426
            echo "        style=\"display:none;\"
        ";
        }
        // line 428
        echo "      >
        <th scope=\"row\">
          <label for=\"settings[mta_secret_key]\">
            ";
        // line 431
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Secret Key");
        echo "
          </label>
        </th>
        <td>
          <input
            type=\"text\"
            class=\"regular-text\"
            id=\"settings[mta_secret_key]\"

            name=\"mta[secret_key]\"
            value=\"";
        // line 441
        if (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta_group", array()) == "smtp")) {
            // line 442
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta", array()), "secret_key", array()), "html", null, true);
        }
        // line 443
        echo "\"
          />
        </td>
      </tr>

      <!-- smtp: domain -->
      <tr class=\"mailpoet_smtp_field\" data-field=\"domain\"
        ";
        // line 451
        if ((($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta_group", array()) != "smtp") || ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "smtp_provider", array()) != "manual"))) {
            // line 453
            echo "        style=\"display:none;\"
        ";
        }
        // line 455
        echo "      >
        <th scope=\"row\">
          <label for=\"settings[mta_domain]\">
            ";
        // line 458
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Domain");
        echo "
          </label>
          <p class=\"description\">
            ";
        // line 461
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("e.g.: smtp.mydomain.com");
        echo "
          </p>
        </th>
        <td>
          <input
            type=\"text\"
            class=\"regular-text\"
            id=\"settings[mta_domain]\"
            name=\"mta[domain]\"
            value=\"";
        // line 470
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta", array()), "domain", array()), "html", null, true);
        echo "\" />
        </td>
      </tr>

      <!-- smtp: api key -->
      <tr class=\"mailpoet_sendgrid_field\" data-field=\"api_key\"
        ";
        // line 477
        if ((($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta_group", array()) != "smtp") || ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "smtp_provider", array()) != "SendGrid"))) {
            // line 479
            echo "        style=\"display:none;\"
        ";
        }
        // line 481
        echo "      >
        <th scope=\"row\">
          <label for=\"settings[mta_api_key]\">
            ";
        // line 484
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("API Key");
        echo "
          </label>
        </th>
        <td>
          <input
            type=\"text\"
            class=\"regular-text\"
            id=\"settings[mta_api_key]\"
            name=\"mta[api_key]\"
            value=\"";
        // line 493
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta", array()), "api_key", array()), "html", null, true);
        echo "\"
          />
        </td>
      </tr>

      <!-- smtp: login -->
      <tr id=\"mta_login\" class=\"mailpoet_smtp_field\" data-field=\"login\"
        ";
        // line 501
        if ((($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta_group", array()) != "smtp") || ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "smtp_provider", array()) != "manual"))) {
            // line 503
            echo "        style=\"display:none;\"
        ";
        }
        // line 505
        echo "      >
        <th scope=\"row\">
          <label for=\"settings[mta_login]\">
            ";
        // line 508
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Login");
        echo "
          </label>
        </th>
        <td>
          <input
            type=\"text\"
            class=\"regular-text\"
            id=\"settings[mta_login]\"
            name=\"mta[login]\"
            value=\"";
        // line 517
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta", array()), "login", array()), "html", null, true);
        echo "\"
          />
        </td>
      </tr>
      <!-- smtp: password -->
      <tr id=\"mta_password\" class=\"mailpoet_smtp_field\" data-field=\"password\"
        ";
        // line 524
        if ((($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta_group", array()) != "smtp") || ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "smtp_provider", array()) != "manual"))) {
            // line 526
            echo "        style=\"display:none;\"
        ";
        }
        // line 528
        echo "      >
        <th scope=\"row\">
          <label for=\"settings[mta_password]\">
            ";
        // line 531
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Password");
        echo "
          </label>
        </th>
        <td>
          <input
            type=\"password\"
            class=\"regular-text\"
            id=\"settings[mta_password]\"
            name=\"mta[password]\"
            value=\"";
        // line 540
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta", array()), "password", array()), "html", null, true);
        echo "\"
          />
        </td>
      </tr>
      <!-- smtp: security protocol -->
      <tr class=\"mailpoet_smtp_field\" data-field=\"encryption\"
        ";
        // line 547
        if ((($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta_group", array()) != "smtp") || ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "smtp_provider", array()) != "manual"))) {
            // line 549
            echo "        style=\"display:none;\"
        ";
        }
        // line 551
        echo "      >
        <th scope=\"row\">
          <label for=\"settings[mta_encryption]\">
            ";
        // line 554
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Secure Connection");
        echo "
          </label>
        </th>
        <td>
          <select id=\"settings[mta_encryption]\" name=\"mta[encryption]\">
            <option value=\"\">";
        // line 559
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("No");
        echo "</option>
            <option
              value=\"ssl\"
            ";
        // line 562
        if (($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta", array()), "encryption", array()) == "ssl")) {
            // line 563
            echo "            selected=\"selected\"
            ";
        }
        // line 565
        echo "            >SSL</option>
            <option
              value=\"tls\"
            ";
        // line 568
        if (($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta", array()), "encryption", array()) == "tls")) {
            // line 569
            echo "            selected=\"selected\"
            ";
        }
        // line 571
        echo "            >TLS</option>
          </select>
        </td>
      </tr>
      <!-- smtp: authentication -->
      <tr class=\"mailpoet_smtp_field\" data-field=\"authentication\"
        ";
        // line 578
        if ((($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta_group", array()) != "smtp") || ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "smtp_provider", array()) != "manual"))) {
            // line 580
            echo "        style=\"display:none;\"
        ";
        }
        // line 582
        echo "      >
        <th scope=\"row\">
          <label>
            ";
        // line 585
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Authentication");
        echo "
          </label>
          <p class=\"description\">
            ";
        // line 588
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Leave this option set to Yes. Only a tiny portion of SMTP services prefer Authentication to be turned off.");
        echo "
          </p>
        </th>
        <td>
          <label>
            <input
              type=\"radio\"
              value=\"1\"
              name=\"mta[authentication]\"
            ";
        // line 598
        if (( !$this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta", array()), "authentication", array()) || ($this->getAttribute($this->getAttribute(        // line 599
(isset($context["settings"]) ? $context["settings"] : null), "mta", array()), "authentication", array()) == "1"))) {
            // line 600
            echo "            checked=\"checked\"
            ";
        }
        // line 602
        echo "            />";
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Yes");
        echo "
          </label>
          &nbsp;
          <label>
            <input
              type=\"radio\"
              value=\"-1\"
              name=\"mta[authentication]\"
            ";
        // line 610
        if (($this->getAttribute($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "mta", array()), "authentication", array()) == "-1")) {
            // line 611
            echo "            checked=\"checked\"
            ";
        }
        // line 613
        echo "            />";
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("No");
        echo "
          </label>
        </td>
      </tr>
      </tbody>
    </table>
  </div>

  <table class=\"form-table\">
    <tbody>
      <!-- SPF -->
      <tr id=\"mailpoet_mta_spf\">
        <th scope=\"row\">
          <label>
            ";
        // line 627
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("SPF Signature (Highly recommended!)");
        echo "
          </label>
          <p class=\"description\">
            ";
        // line 630
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("This improves your delivery rate by verifying that you're allowed to send emails from your domain.");
        echo "
          </p>
        </th>
        <td>
          <p>
            ";
        // line 635
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("SPF is set up in your DNS. Read your host's support documentation for more information.");
        echo "
          </p>
        </td>
      </tr>
      <!-- test method -->
      <tr>
        <th scope=\"row\">
          <label for=\"mailpoet_mta_test_email\">
            ";
        // line 643
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Test the sending method");
        echo "
          </label>
        </th>
        <td>
          <p>
            <input
              type=\"text\"
              id=\"mailpoet_mta_test_email\"
              class=\"regular-text\"
              value=\"";
        // line 652
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["current_user"]) ? $context["current_user"] : null), "user_email", array()), "html", null, true);
        echo "\"
            />
            <a
              id=\"mailpoet_mta_test\"
              class=\"button-secondary\"
            >";
        // line 657
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Send a test email");
        echo "</a>
          </p>
        </td>
      </tr>
      <!-- activate or cancel -->
      <tr>
        <th scope=\"row\">
          <p>
            <a
              href=\"javascript:;\"
              class=\"mailpoet_mta_setup_save button button-primary\"
            >";
        // line 668
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Activate");
        echo "</a>
            &nbsp;
            <a
              href=\"javascript:;\"
              class=\"mailpoet_mta_setup_cancel\"
            >";
        // line 673
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("or Cancel");
        echo "</a>
          </p>
        </th>
        <td></td>
      </tr>
    </tbody>
  </table>
</div>

<script type=\"text/javascript\">
  jQuery(function(\$) {
    var sending_frequency_template =
      Handlebars.compile(\$('#mailpoet_sending_frequency_template').html());

    // om dom loaded
    \$(function() {
      // constrain number type inputs
      \$('input[type=\"number\"]').on('keyup', function() {
        var currentValue = \$(this).val();
        if(!currentValue) return;

        var minValue = \$(this).attr('min');
        var maxValue = \$(this).attr('max');
        \$(this).val(Math.min(Math.max(minValue, currentValue), maxValue));
      });

      // testing sending method
      \$('#mailpoet_mta_test').on('click', function() {
        // get test email and include it in data
        var recipient = \$('#mailpoet_mta_test_email').val();

        var settings = jQuery('#mailpoet_settings_form').serializeObject();
        var mailer = settings.mta;
        mailer.method = getMethodFromGroup(\$('#mta_group').val());

        // check that we have a from address
        if(settings.sender.address.length === 0) {
          // validation
          return MailPoet.Notice.error(
            '";
        // line 712
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->env->getExtension('MailPoet\Twig\I18n')->translate("The email could not be sent. Make sure the option \"Email notifications\" has a FROM email address in the Basics tab."), "js"), "html", null, true);
        echo "',
            { scroll: true, static: true }
          );
        }

        MailPoet.Modal.loading(true);
        MailPoet.Ajax.post({
          api_version: window.mailpoet_api_version,
          endpoint: 'mailer',
          action: 'send',
          data: {
            mailer: mailer,
            newsletter: {
              subject: \"";
        // line 725
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("This is a Sending Method Test");
        echo "\",
              body: {
                html: \"<p>";
        // line 727
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Yup, it works! You can start blasting away emails to the moon.");
        echo "</p>\",
                text: \"";
        // line 728
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("Yup, it works! You can start blasting away emails to the moon.");
        echo "\"
              }
            },
            subscriber: recipient
          }
        }).always(function() {
          MailPoet.Modal.loading(false);
        }).done(function(response) {
          MailPoet.Notice.success(
            \"";
        // line 737
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->env->getExtension('MailPoet\Twig\I18n')->translate("The email has been sent! Check your inbox."), "js"), "html", null, true);
        echo "\",
            { scroll: true }
          );
        }).fail(function(response) {
          if (response.errors.length > 0) {
            MailPoet.Notice.error(
              response.errors.map(function(error) { return _.escape(error.message); }),
              { scroll: true }
            );
          }
        });
      });

      // sending frequency update based on selected provider
      \$('#mailpoet_web_host').on('change keyup', renderHostSendingFrequency);

      // update manual sending frequency when values are changed
      \$('#other_frequency_emails').on('change keyup', function() {
        updateSendingFrequency('other');
      });
      \$('#other_frequency_interval').on('change keyup', function() {
        updateSendingFrequency('other');
      });

      // save configuration of a sending method
      \$('.mailpoet_sending_service_activate').on('click', function() {
        \$('#mta_group').val('mailpoet');
        saveSendingMethodConfiguration('mailpoet');
      });
      \$('.mailpoet_mta_setup_save').on('click', function() {
        // get selected method
        var group = \$('.mailpoet_sending_method:visible').data('group');
        saveSendingMethodConfiguration(group);
      });
      \$('#mailpoet_smtp_method').on('change keyup', renderHostsSelect);
      \$('#mailpoet_sending_frequency').on('change keyup', sendingFrequencyMethodUpdated);
      \$('#mailpoet_smtp_method').trigger(\"change\");
      \$('#other_frequency_emails').trigger(\"change\");

      function saveSendingMethodConfiguration(group) {

        // set sending method
        if(group === undefined) {
          MailPoet.Notice.error(
            \"";
        // line 781
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->env->getExtension('MailPoet\Twig\I18n')->translate("You have selected an invalid sending method."), "js"), "html", null, true);
        echo "\"
          );
        } else {
          // set new sending method active
          setSendingMethodGroup(group);

          // enforce signup confirmation depending on selected group
          setSignupConfirmation(group);

          // back to selection of sending methods
          MailPoet.Router.navigate('mta', { trigger: true });

          // save settings
          \$('.mailpoet_settings_submit > input').trigger('click');
        }
      }

      function setSignupConfirmation(group) {
        if (group === 'mailpoet') {
          // force signup confirmation (select \"Yes\")
          \$('.mailpoet_signup_confirmation[value=\"1\"]').attr('checked', true);
          \$('.mailpoet_signup_confirmation[value=\"\"]').attr('checked', false);

          // hide radio inputs
          \$('#mailpoet_signup_confirmation_input').hide();

          // show mailpoet specific notice
          \$('#mailpoet_signup_confirmation_notice').show();

          // show signup confirmation options
          \$('#mailpoet_signup_options').show();
        } else {
          // show radio inputs
          \$('#mailpoet_signup_confirmation_input').show();

          // hide mailpoet specific notice
          \$('#mailpoet_signup_confirmation_notice').hide();
        }
      }

      function setSendingMethodGroup(group) {
        // deactivate other sending methods
        \$('.mailpoet_sending_methods .mailpoet_active')
          .removeClass('mailpoet_active');

        // set active sending method
        \$('.mailpoet_sending_methods li[data-group=\"'+group+'\"]')
          .addClass('mailpoet_active');

        var method = getMethodFromGroup(\$('#mta_group').val());

        \$('#mta_method').val(method);

        // set MailPoet method description
        \$('#mailpoet_sending_method_active_text')
          .toggleClass('mailpoet_hidden', group !== 'mailpoet');
        \$('#mailpoet_sending_method_inactive_text')
          .toggleClass('mailpoet_hidden', group === 'mailpoet');

        // Hide server error notices
        \$('.mailpoet_notice_server').hide();

        updateMSSActivationUI();
      }

      function getMethodFromGroup(group) {
        var group = group || 'website';
        switch(group) {
          case 'mailpoet':
            return 'MailPoet';
          break;
          case 'website':
            return 'PHPMail';
          break;
          case 'smtp':
            var method = \$('#mailpoet_smtp_provider').val();
            if(method === 'manual') {
              return 'SMTP';
            }
            return method;
          break;
        }
      }

      // cancel configuration of a sending method
      \$('.mailpoet_mta_setup_cancel').on('click', function() {
        // back to selection of sending methods
        MailPoet.Router.navigate('mta', { trigger: true });
      });

      // render sending frequency form
      \$('#mailpoet_smtp_provider').trigger('change');
      \$('#mailpoet_web_host').trigger('change');
    });

    function setProviderForm() {
      // check provider
      var provider = \$(this).find('option:selected').first();
      var fields = provider.data('fields');

      if(fields === undefined) {
        fields = [
          'host',
          'port',
          'login',
          'password',
          'authentication',
          'encryption'
        ];
      } else {
        fields = fields.split(',');
      }

      \$('.mailpoet_smtp_field').hide();

      fields.map(function(field) {
        \$('.mailpoet_smtp_field[data-field=\"'+field+'\"]').show();
      });

      // update sending frequency
      renderSMTPSendingFrequency(provider);
    }

    function renderSMTPSendingFrequency() {
      // set sending frequency
      var emails = \$('#smtp_frequency_emails').val();
      var interval = \$('#smtp_frequency_interval').val();
      setSendingFrequency({
        output: '#mailpoet_smtp_daily_emails',
        only_daily: true,
        emails: emails,
        interval: interval
      });
      \$('#mta_frequency_emails').val(emails);
      \$('#mta_frequency_interval').val(interval);
    }

    function sendingFrequencyMethodUpdated() {
      var method = \$(this).find('option:selected').first();
      var sendingMethod = \$('#mailpoet_smtp_method').find('option:selected').first().val();
      if(method.val() === \"manual\") {
        \$('#mailpoet_sending_frequency_manual').show();
        \$('#mailpoet_recommended_daily_emails').hide();
        \$('#other_frequency_emails').trigger(\"change\");
      } else {
        \$('#mailpoet_sending_frequency_manual').hide();
        if(sendingMethod !== \"server\") {
          \$('#mailpoet_recommended_daily_emails').show();
        }
        \$('#mailpoet_smtp_method').trigger(\"change\");
      }
    }

    function renderHostsSelect() {
      var method = \$(this).find('option:selected').first();
      var val = method.val();

      if(val === \"server\") {
        \$('#mailpoet_sending_method_host').show();
        \$('#mta_group').val('website');
      } else {
        \$('#mailpoet_sending_method_host').hide();
      }
      if(val === \"manual\") {
        \$('.mailpoet_smtp_field').show();
        \$('#mta_group').val('smtp');
        \$('#mailpoet_smtp_provider').val('manual');
      } else {
        \$('.mailpoet_smtp_field').hide();
      }
      if(val === \"AmazonSES\") {
        \$('.mailpoet_aws_field').show();
        \$('#mta_group').val('smtp');
        \$('#mailpoet_smtp_provider').val('AmazonSES');
      } else {
        \$('.mailpoet_aws_field').hide();
      }
      if(val === \"SendGrid\") {
        \$('.mailpoet_sendgrid_field').show();
        \$('#mta_group').val('smtp');
        \$('#mailpoet_smtp_provider').val('SendGrid');
      } else {
        \$('.mailpoet_sendgrid_field').hide();
      }
      const frequencyMethod = \$('#mailpoet_sending_frequency').find('option:selected').first().val();
      if(frequencyMethod === \"manual\") {
        \$('#mailpoet_recommended_daily_emails').hide();
      } else {
        \$('#mailpoet_recommended_daily_emails').show();
      }
      var emails = method.data('emails');
      var interval = method.data('interval');
      if(val === \"server\") {

        var emails = \$('#mailpoet_web_host').find('option:selected').first().data('emails');
        var interval = \$('#mailpoet_web_host').find('option:selected').first().data('interval');
      }
      setSendingFrequency({
        output: '#mailpoet_recommended_daily_emails',
        only_daily: false,
        emails: emails,
        interval: interval
      });
      \$('#mta_frequency_emails').val(emails);
      \$('#mta_frequency_interval').val(interval);
    }

    function renderHostSendingFrequency() {

      var host = \$(this).find('option:selected').first();
      var emails =
        host.data('emails') || ";
        // line 992
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["default_frequency"]) ? $context["default_frequency"] : null), "website", array()), "emails", array()), "html", null, true);
        echo ";
      var interval =
        host.data('interval') || ";
        // line 994
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["default_frequency"]) ? $context["default_frequency"] : null), "website", array()), "interval", array()), "html", null, true);
        echo ";
      var fields =
        host.data('fields') || '';

      if(host.val() === 'manual' ) {
        // set sending frequency
        setSendingFrequency({
          output: '#mailpoet_website_daily_emails',
          only_daily: true,
          emails: \$('#website_frequency_emails').val(),
          interval: \$('#website_frequency_interval').val()
        });
      } else {

        \$('#website_frequency_emails').val(emails);
        \$('#website_frequency_interval').val(interval);

        // set sending frequency
        setSendingFrequency({
          output: '#mailpoet_website_sending_frequency',
          emails: emails,
          interval: interval
        });
      }
      \$('#mta_frequency_emails').val(emails);
      \$('#mta_frequency_interval').val(interval);
    }

    function updateSendingFrequency(method) {
      // get emails
      var options = {
        only_daily: true,
        emails: \$('#'+method+'_frequency_emails').val(),
        interval: \$('#'+method+'_frequency_interval').val()
      };

      var MINUTES_PER_DAY = 1440;
      var SECONDS_PER_DAY = 86400;

      options.daily_emails = ~~(
        (MINUTES_PER_DAY / options.interval) * options.emails
      );

      options.emails_per_second = (~~(
        ((options.daily_emails) / 86400) * 10)
      ) / 10;


      // format daily emails number according to locale
      options.daily_emails = options.daily_emails.toLocaleString();

      \$('#mailpoet_'+method+'_daily_emails').html(
        sending_frequency_template(options)
      );

      // update actual sending frequency values
      \$('#mta_frequency_emails').val(options.emails);
      \$('#mta_frequency_interval').val(options.interval);
    }

    function setSendingFrequency(options) {
      options.daily_emails = ~~((1440 / options.interval) * options.emails);

      // format daily emails number according to locale
      options.daily_emails = options.daily_emails.toLocaleString();

      \$(options.output).html(
        sending_frequency_template(options)
      );
    }

    Handlebars.registerHelper('format_time', function(value, block) {
      var label = null;
      var labels = {
        minute: \"";
        // line 1068
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("every minute");
        echo "\",
        minutes: \"";
        // line 1069
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("every %1\$d minutes");
        echo "\",
        hour: \"";
        // line 1070
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("every hour");
        echo "\",
        hours: \"";
        // line 1071
        echo $this->env->getExtension('MailPoet\Twig\I18n')->translate("every %1\$d hours");
        echo "\"
      };

      // cast time as int
      value = ~~(value);

      // format time depending on the value
      if(value >= 60) {
        // we're dealing with hours
        if(value === 60) {
          label = labels.hour;
        } else {
          label = labels.hours;
        }
        value /= 60;
      } else {
        // we're dealing with minutes
        if(value === 1) {
          label = labels.minute;
        } else {
          label = labels.minutes;
        }
      }

      if(label !== null) {
        return label.replace('%1\$d', value);
      } else {
        return value;
      }
    });
  });

  // enable/disable MSS method activate button and notice
  function updateMSSActivationUI() {
    var \$ = jQuery;
    var group = \$('.mailpoet_sending_methods .mailpoet_active').data('group');
    var key_valid = !\$('.mailpoet_mss_key_valid').hasClass('mailpoet_hidden');
    var activation_possible = group !== 'mailpoet' && key_valid;
    \$('.mailpoet_sending_service_activate').prop('disabled', !activation_possible);
    \$('.mailpoet_mss_activate_notice').toggle(activation_possible);
  }
</script>

";
        // line 1114
        echo $this->env->getExtension('MailPoet\Twig\Handlebars')->generatePartial($this->env, $context, "mailpoet_sending_frequency_template", "settings/templates/sending_frequency.hbs");
        // line 1117
        echo "
";
    }

    public function getTemplateName()
    {
        return "settings/mta.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1573 => 1117,  1571 => 1114,  1525 => 1071,  1521 => 1070,  1517 => 1069,  1513 => 1068,  1436 => 994,  1431 => 992,  1217 => 781,  1170 => 737,  1158 => 728,  1154 => 727,  1149 => 725,  1133 => 712,  1091 => 673,  1083 => 668,  1069 => 657,  1061 => 652,  1049 => 643,  1038 => 635,  1030 => 630,  1024 => 627,  1006 => 613,  1002 => 611,  1000 => 610,  988 => 602,  984 => 600,  982 => 599,  981 => 598,  969 => 588,  963 => 585,  958 => 582,  954 => 580,  952 => 578,  944 => 571,  940 => 569,  938 => 568,  933 => 565,  929 => 563,  927 => 562,  921 => 559,  913 => 554,  908 => 551,  904 => 549,  902 => 547,  893 => 540,  881 => 531,  876 => 528,  872 => 526,  870 => 524,  861 => 517,  849 => 508,  844 => 505,  840 => 503,  838 => 501,  828 => 493,  816 => 484,  811 => 481,  807 => 479,  805 => 477,  796 => 470,  784 => 461,  778 => 458,  773 => 455,  769 => 453,  767 => 451,  758 => 443,  755 => 442,  753 => 441,  740 => 431,  735 => 428,  731 => 426,  729 => 424,  720 => 416,  717 => 415,  715 => 414,  702 => 404,  697 => 401,  693 => 399,  691 => 397,  683 => 390,  674 => 387,  671 => 386,  667 => 384,  665 => 383,  661 => 382,  658 => 381,  654 => 380,  650 => 378,  647 => 377,  645 => 376,  635 => 369,  630 => 366,  626 => 364,  624 => 362,  614 => 354,  599 => 342,  594 => 339,  590 => 337,  588 => 335,  580 => 329,  568 => 320,  562 => 317,  557 => 314,  553 => 312,  551 => 310,  542 => 303,  537 => 301,  530 => 296,  523 => 294,  517 => 292,  515 => 291,  511 => 290,  508 => 289,  504 => 287,  501 => 286,  497 => 284,  495 => 282,  494 => 281,  490 => 279,  487 => 278,  483 => 277,  478 => 275,  475 => 274,  469 => 272,  463 => 270,  461 => 269,  452 => 262,  448 => 260,  446 => 258,  437 => 251,  434 => 250,  430 => 248,  428 => 246,  422 => 242,  408 => 231,  395 => 220,  386 => 218,  382 => 216,  380 => 215,  376 => 214,  372 => 213,  368 => 212,  365 => 211,  361 => 210,  356 => 208,  337 => 192,  332 => 189,  328 => 187,  326 => 185,  319 => 179,  310 => 177,  306 => 175,  304 => 174,  300 => 173,  296 => 172,  292 => 171,  288 => 170,  285 => 169,  281 => 168,  277 => 167,  271 => 164,  268 => 163,  264 => 161,  262 => 159,  256 => 155,  243 => 145,  230 => 134,  228 => 131,  219 => 125,  210 => 119,  203 => 115,  198 => 113,  193 => 111,  190 => 110,  186 => 109,  177 => 104,  173 => 103,  163 => 96,  156 => 92,  151 => 90,  144 => 86,  139 => 84,  131 => 81,  124 => 77,  119 => 75,  111 => 72,  100 => 64,  95 => 61,  91 => 60,  81 => 53,  70 => 45,  61 => 39,  50 => 31,  40 => 24,  31 => 18,  23 => 12,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "settings/mta.html", "/var/www/vhosts/how2behealthy.nl/httpdocs/wp-content/plugins/mailpoet/views/settings/mta.html");
    }
}
