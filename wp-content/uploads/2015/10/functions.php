<?php
// TELL THE CORE THIS IS A CHILD THEME
define("WLT_CHILDTHEME", true);

// CHILD THEME LAYOUT SETTINGS
function childtheme_designchanges(){
				
				// LOAD IN CORE STYLES AND UNSET THE LAYOUT ONES SO OUR CHILD THEME DEFAULT OPTIONS CAN WORK
				$core_admin_values = get_option("core_admin_values"); 
			 
					// SET HEADER
					$core_admin_values["layout_header"] = "5";
					// SET MENU
					$core_admin_values["layout_menu"] = "3";
					// SET RESPONISVE DESIGN
					$core_admin_values["responsive"] = "1";
					// SET COLUMN LAYOUTS
					$core_admin_values["layout_columns"] = array('homepage' => '3', 'search' => '3', 'single' => '3', 'page' => '3', 'footer' => '', '2columns' => '', 'style' => '', '3columns' => '');
					// SET WELCOME TEXT
					$core_admin_values["header_welcometext"] = "";        
					// SET RATING
					$core_admin_values["rating"] 		= "1";
					$core_admin_values["rating_type"] 	= "1";
					// BREADCRUMBS
					$core_admin_values["breadcrumbs_inner"] 	= "1";
					$core_admin_values["breadcrumbs_home"] 		= "0"; 
					// TURN OFF CATEGORY DESCRIPTION
					$core_admin_values["category_descrition"] 	= "1";	
					// GEO LOCATION
					$core_admin_values["geolocation"] 	= "";
					$core_admin_values["geolocation_flag"] 	= "";
					// FOOTER SOCIAL ICONS
					$core_admin_values["social"] 	= array(
					'twitter' => 'https://twitter.com/info01076800?lang=nl', 'twitter_icon' => 'fa-twitter', 
					'facebook' => 'https://www.facebook.com/how2behealthy?ref=tn_tnmn ', 'facebook_icon' => 'fa-facebook', 
					'dribbble' => '', 'dribbble_icon' => 'fa-google-plus', 
					'linkedin' => 'https://www.linkedin.com/profile/view?id=AAIAAATHbvgBEOvdlGnxFvPa_Ev1UD2LVNjMon8&trk=nav_responsive_tab_profile_pic', 'linkedin_icon' => 'fa-linkedin', 
					'youtube' => 'https://www.youtube.com/watch?v=wxuBEjRayTg ', 'youtube_icon' => 'fa-youtube', 
					'rss' => '##', 'rss_icon' => 'fa-rss',         
					);
					// FOOTER COPYRIGHT TEXT
					$core_admin_values["copyright"] 	= "© Copyright 2015 - https://how2behealthy.nl";
					// HOME PAGE OBJECT SETUP
					$core_admin_values["homepage"]["widgetblock1"] = "slider5_2,text_7,4columns_4,";	
					
$core_admin_values['widgetobject']['slider5']['2'] = array(
'id' => "first",
'fullw' => "yes",
);
$core_admin_values['widgetobject']['text']['7'] = array(
'text' => "",
'autop' => "1",
'fullw' => "yes",
);
$core_admin_values['widgetobject']['4columns']['4'] = array(
'col1' => "<div class=\'panel \'><div class=\'panel-heading\'><img src=\'https://how2behealthy.nl/wp-content/uploads/2015/09/epicwebsite_how4.jpg\' alt=\'epicwebsite_how4\' class=\'aligncenter size-full wp-image-207\' height=\'189\' width=\'249\' /><h3 style=\'text-align: center;\'>Inbegrepen</h3></div><div class=\'panel-body\'><ul>	<li>Professionele individuele begeleiding</li>	<li>Duidelijke doelen</li>	<li>Maandelijkse evaluatie/meten voortgang</li>	<li>Na 6 maanden vieren we uw nieuwe levensstijl</li></ul></div></div>",
'col2' => "<div class=\'panel panel-\'><div class=\'panel-heading\'><a href=\'https://how2behealthy.nl/wp-content/uploads/2015/09/epicwebsite_how2.jpg\'><img src=\'https://how2behealthy.nl/wp-content/uploads/2015/09/epicwebsite_how2.jpg\' class=\'aligncenter wp-image-210 size-full\' height=\'189\' width=\'249\' /></a><h3 style=\'text-align: center;\'>Inbegrepen</h3></div><div class=\'panel-body\'><ul>	<li>Webinars/lezingen</li>	<li>Samen boodschappen doen</li>	<li>Samen sporten/bewegen</li>	<li>Samen gezond koken</li>	<li>Ontdek! Wat is er nog meer?</li></ul></div></div>",
'col3' => "<div class=\'panel panel-1\'><div class=\'panel-heading\'><img src=\'https://how2behealthy.nl/wp-content/uploads/2015/09/epicwebsite_how3.jpg\' class=\'aligncenter wp-image-210 size-full\' height=\'189\' width=\'249\' /><h3 style=\'text-align: center;\'>Inbegrepen</h3></div><div class=\'panel-body\'><ul>	<li>Gratis E-books</li>	<li>10% korting biologische supplementenlijn</li>	<li>Gratis spaarpunten</li>	<li>Online forum/community: leer van elkaar!</li></ul></div></div>",
'col4' => "<div class=\'panel panel-\'><div class=\'panel-heading\'><img src=\'https://how2behealthy.nl/wp-content/uploads/2015/09/epicwebsite_how41.jpg\' class=\'aligncenter wp-image-210 size-full\' height=\'189\' width=\'249\' /><h3 style=\'text-align: center;\'>Betaald</h3></div><div class=\'panel-body\'><ul>	<li>DSR of Ontspannings-massage</li>	<li>Detoxkuur + supplementen</li>	<li>Bach+persoonlijk-heidsadviezen</li></ul></div></div>",
'fullw' => "yes",
);	
					// SET ITEMCODE
					$core_admin_values["itemcode"] 	= "<div class='itemdata itemid ' ><div class='thumbnail clearfix'>	[IMAGE gallery=1]        <div class='content'>            <h4>[TITLE]</h4>                       [CATEGORY] [INSTOCK class='pull-right']                <div class='hidden_grid'>  <div class='line1'></div> [EXCERPT]  </div>                       <div class='line1'></div>                <div class='pull-right'>[ADD]</div>                        [old_price]                [price]                </div></div> </div>";
					// SET LISTING PAGE CODE
					$core_admin_values["listingcode"] 	= "<div class='panel panel-default'><div class='panel-body'><h1>[TITLE-NOLINK]</h1><hr /><div class='row'><div class='col-md-6'>[IMAGES]</div>        <div class='col-md-6'> [EXCERPT] <hr /> [ADDBIG]</div></div><hr /><ul class='nav nav-tabs navstyle1' id='Tabs'>  <li class='active'><a href='#t1' data-toggle='tab'>Product Description</a></li>  <li><a href='#t4' data-toggle='tab'>Comments</a></li></ul> <div class='tab-content'>  <div class='tab-pane active' id='t1'>  [TOOLBOX]  [CONTENT]    [GOOGLEMAP]   </div>  <div class='tab-pane' id='t4'><br />  [COMMENTS]   </div>  </div> </div> </div> <h4>Related Products</h4><div class='clearfix'></div><hr>[RELATED carousel=true]";
					// SET PRINT PAGE CODE
					$core_admin_values["printcode"]  = "<div class='center'>            <p id='postTitle'>[TITLE-NOLINK]</p>            <p id='postMeta'>Date:<strong>[DATE]</strong>  </p>            <p id='postLink'>[LINK]</p>               <div id='postContent'>[CONTENT]</div>                 <div id='postFields'>[FIELDS]</div>            <p id='printNow'><a href='#print' onClick='window.print(); return false;' title='Click to print'>Print</a></p>            </div>";						
					// RETURN VALUES
					return $core_admin_values;
}
// FUNCTION EXECUTED WHEN THE THEME IS CHANGED
function _after_switch_theme(){
	// SAVE VALUES
	update_option("core_admin_values",childtheme_designchanges());		
}
add_action("after_switch_theme","_after_switch_theme");
// DEMO MODE
if(defined("WLT_DEMOMODE")){ 
	$GLOBALS["CORE_THEME"] = childtheme_designchanges();
}?>