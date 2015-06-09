<?php
/*
  Plugin Name: Google Map Location Filter
  Plugin URI: http://www.townsitebrewing.com/GetIt
  Description: Google Map Marker Filter
  Version: 1.0
  Author: Allen Wallace @ Massive Graphic
  Author URI: http://www.massivegraphic.ca
 */

// Set-up Action and Filter Hooks
register_activation_hook(__FILE__, 'googlemaploc_add_defaults');
register_uninstall_hook(__FILE__, 'googlemaploc_delete_plugin_options');
add_action('admin_init', 'googlemaploc_init');
add_action('admin_menu', 'googlemaploc_add_options_page');
add_filter('plugin_action_links', 'googlemaploc_plugin_action_links', 10, 2);

// --------------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: register_uninstall_hook(__FILE__, 'googlemaploc_delete_plugin_options')
// --------------------------------------------------------------------------------------
// THIS FUNCTION RUNS WHEN THE USER DEACTIVATES AND DELETES THE PLUGIN. IT SIMPLY DELETES
// THE PLUGIN OPTIONS DB ENTRY (WHICH IS AN ARRAY STORING ALL THE PLUGIN OPTIONS).
// --------------------------------------------------------------------------------------
// Delete options table entries ONLY when plugin deactivated AND deleted
function googlemaploc_delete_plugin_options() {
	delete_option('googlemaploc_options');
}

// Define default option settings
function googlemaploc_add_defaults() {
	$tmp = get_option('googlemaploc_options');
	if (($tmp['chk_default_options_db'] == '1') || (!is_array($tmp))) {
		delete_option('googlemaploc_options'); // so we don't have to reset all the 'off' checkboxes too! (don't think this is needed but leave for now)
		$arr = array("tags1" => '"Any Type", "Any Country", "Any Area", "By The Bottle", "Vancouver / Lower Mainland", "Canada", "V7V3R5"',
			"position1" => "49.328054,-123.158897",
			"name1" => "16th Street Liquor",
			"description1" => "220 16th Street<br />West Van<br />V7V 3R5<br />(604) 926-1339",
			"bounds1" => "TRUE",
			"active1" => "1",
			"tags2" => '"Any Type", "Any Country", "Any Area","On Tap","Sunshine Coast / Sea to Sky","Canada","V8A2L1"',
			"position2" => "49.84242,-124.52792",
			"name2" => "Alchemist Restaurant",
			"description2" => "4680 Marine Ave Powell River  V8A 2L1",
			"bounds2" => "TRUE",
			"active2" => "1",
			"tags3" => '"Any Type", "Any Country", "Any Area","On Tap","Vancouver / Lower Mainland","Canada","V6A1B8"',
			"position3" => "49.28424,-123.10018",
			"name3" => "Alibi Room",
			"description3" => "157 Alexander Street<br />Vancouver V6A 1B8<br />(604) 623-3383<br /><a target='_blank' href='http://www.alibi.ca'>www.alibi.ca</a>",
			"bounds3" => "TRUE",
			"active3" => "1"
		);
		update_option('googlemaploc_options', $arr);
	}
}

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: add_action('admin_init', 'googlemaploc_init' )
// ------------------------------------------------------------------------------
// THIS FUNCTION RUNS WHEN THE 'admin_init' HOOK FIRES, AND REGISTERS YOUR PLUGIN
// SETTING WITH THE WORDPRESS SETTINGS API. YOU WON'T BE ABLE TO USE THE SETTINGS
// API UNTIL YOU DO.
// ------------------------------------------------------------------------------
// Init plugin options to white list our options
function googlemaploc_init() {
	register_setting('googlemaploc_plugin_options', 'googlemaploc_options', 'googlemaploc_validate_options');
}

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION FOR: add_action('admin_menu', 'googlemaploc_add_options_page');
// ------------------------------------------------------------------------------
// THIS FUNCTION RUNS WHEN THE 'admin_menu' HOOK FIRES, AND ADDS A NEW OPTIONS
// PAGE FOR YOUR PLUGIN TO THE SETTINGS MENU.
// ------------------------------------------------------------------------------
// Add menu page
function googlemaploc_add_options_page() {
	add_options_page('Plugin Get It Google Map Options Page', 'Plugin Options Get It Google Map', 'manage_options', __FILE__, 'googlemaploc_render_form');
}

// ------------------------------------------------------------------------------
// CALLBACK FUNCTION SPECIFIED IN: add_options_page()
// ------------------------------------------------------------------------------
// THIS FUNCTION IS SPECIFIED IN add_options_page() AS THE CALLBACK FUNCTION THAT
// ACTUALLY RENDER THE PLUGIN OPTIONS FORM AS A SUB-MENU UNDER THE EXISTING
// SETTINGS ADMIN MENU.
// ------------------------------------------------------------------------------
// Render the Plugin options form
function googlemaploc_render_form() {
	?>
	<div class="wrap">

		<!-- Display Plugin Icon, Header, and Description -->
		<div class="icon32" id="icon-options-general"><br></div>
		<h2>Get it Google Map</h2>
The steps to edit accounts:<br />
        - If you Edit or put a New account in, put in the first input box of the popup the basic text: Any Type,Any Area,By The Bottle, Vancouver Island<br />
        - Make the choice of: "By The Bottle" or "on Tab"<br />
        - Make the choice of "Powell River" or "Vancouver" or "Sunshine Coast" or "Vancouver Island"<br />
        - Populate all other input fields and hit save.<br />
        To find the Latitude and Longitude goto: <a href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm" target="_blank">FIND Latitude&Longitude</a>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
			<thead>
				<tr>
					<th>Tags</th>
					<th>Position</th>
					<th>Name</th>
					<th>Street1</th>
					<th>Street2</th>
					<th>City</th>
					<th>Region</th>
					<th>Postal Code</th>
					<th>Phone</th>
					<th>Website</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Tags</th>
					<th>Position</th>
					<th>Name</th>
					<th>Street1</th>
					<th>Street2</th>
					<th>City</th>
					<th>Region</th>
					<th>Postal Code</th>
					<th>Phone</th>
					<th>Website</th>
				</tr>
			</tfoot>
		</table>

		<link rel="stylesheet" type="text/css" href="/wp-content/plugins/googlemaploc/css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="/wp-content/plugins/googlemaploc/css/dataTables.editor.css">
		<link rel="stylesheet" type="text/css" href="/wp-content/plugins/googlemaploc/css/TableTools.css">

		<script type="text/javascript" charset="utf-8" src="/wp-content/plugins/googlemaploc/js/jquery.js" ></script>
		<script type="text/javascript" charset="utf-8" src="/wp-content/plugins/googlemaploc/js/jquery.dataTables.js" ></script>
		<script type="text/javascript" charset="utf-8" src="/wp-content/plugins/googlemaploc/js/TableTools.js" ></script>
		<script type="text/javascript" charset="utf-8" src="/wp-content/plugins/googlemaploc/js/dataTables.editor.js" ></script>

		<script>		
			jQuery(document).ready(function() {
					
				var editor = new jQuery.fn.dataTable.Editor( {
					"ajaxUrl": "/wp-content/plugins/googlemaploc/php/locations.php",
					"domTable": "#example",
					"fields": [ {
							"label": "Tags:",
							"name": "tags"
						}, {
							"label": "Position",
							"name": "position"
						}, {
							"label": "Name:",
							"name": "name"
						}, {
							"label": "Street 1:",
							"name": "street1"
						}, {
							"label": "Street 2:",
							"name": "street2"
						}
						, {
							"label": "City:",
							"name": "city"
						}
						, {
							"label": "Region:",
							"name": "region"
						}
						, {
							"label": "Postal Code:",
							"name": "postal_code"
						}
						, {
							"label": "Phone #:",
							"name": "phone"
						}
						, {
							"label": "Website:",
							"name": "website"
						}
					]
				} );
		
				jQuery('#example').dataTable( {
					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": "/wp-content/plugins/googlemaploc/php/locations.php",  
					"sDom": "Tfrtip",
					"aoColumns": [
						{ "mData": "tags" },
						{ "mData": "position" },
						{ "mData": "name" },
						{ "mData": "street1" },
						{ "mData": "street2" },
						{ "mData": "city"},
						{ "mData": "region"},
						{ "mData": "postal_code"},
						{ "mData": "phone"},
						{ "mData": "website"}
					],
					"oTableTools": {
						"sRowSelect": "single",
						"aButtons": [
							{ "sExtends": "editor_create", "editor": editor },
							{ "sExtends": "editor_edit",   "editor": editor },
							{ "sExtends": "editor_remove", "editor": editor }
						]
					}
				} );
			} );
				
		</script>
	<?php
}

// Sanitize and validate input. Accepts an array, return a sanitized array.
function googlemaploc_validate_options($input) {
	// strip html from textboxes
	$input['textarea_one'] = wp_filter_nohtml_kses($input['textarea_one']); // Sanitize textarea input (strip html tags, and escape characters)
	$input['txt_one'] = wp_filter_nohtml_kses($input['txt_one']); // Sanitize textbox input (strip html tags, and escape characters)
	return $input;
}

// Display a Settings link on the main Plugins page
function googlemaploc_plugin_action_links($links, $file) {

	if ($file == plugin_basename(__FILE__)) {
		$googlemaploc_links = '<a href="' . get_admin_url() . 'options-general.php?page=googlemaploc/googlemaploc.php">' . __('Settings') . '</a>';
		// make the 'Settings' link appear first
		array_unshift($links, $googlemaploc_links);
	}

	return $links;
}

add_shortcode('googlemaploc', 'googlemaploc_output');

//function media_add_content($text) {
function googlemaploc_output() {
	$options = get_option('googlemaploc_options');
	ob_start();
	?>		
		<div id="getitmap">
			<div class="location-filter-col">
				<p>Tap or Bottle</p>
				<select id="type">
					<option value="Any Type">-Any-</option>
					<option value="On Tap">On Tap</option>
					<option value="By The Bottle">By The Bottle</option>
				</select>
			</div>
			<div class="location-filter-col">
				<p>Region</p>
				<select id="area">
					<option value="Any Area">- Any -</option>									
					<option value="Powell River">Powell River</option>
					<option value="Sunshine Coast">Sunshine Coast</option>	
					<option value="Vancouver">Vancouver</option>
					<option value="Vancouver Island">Vancouver Island</option>					
				</select>
			</div>
			<div class="location-filter-col"><button id="reset">Reset</button></div>
			<div id="map_canvas" style="height: 400px;"> </div>
		</div>

	<?php
	return ob_get_clean();
}

function wpscripts_googlemaploc() {
	wp_register_script('getit1-map-script', 'http://maps.google.com/maps/api/js?sensor=true', array(), '6610', true);
	wp_enqueue_script('getit1-map-script');
}

add_action('wp_enqueue_scripts', 'wpscripts_googlemaploc');

function wpscriptssec_googlemaploc() {
	wp_register_script('getit2-map-script', plugins_url('/js/jquery-ui-map-3.0-rc/ui/jquery.ui.map.js', __FILE__), array(), '6620', true);
	wp_enqueue_script('getit2-map-script');
}

add_action('wp_enqueue_scripts', 'wpscriptssec_googlemaploc');

function wpscriptsthi_googlemaploc() {
	wp_register_script('getit3-map-script', plugins_url('/js/locations.js', __FILE__), array(), '6630', true);
	wp_enqueue_script('getit3-map-script');
}

add_action('wp_enqueue_scripts', 'wpscriptsthi_googlemaploc');
?>
