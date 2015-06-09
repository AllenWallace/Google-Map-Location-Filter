<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>

		<!-- DataTables CSS -->
		<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="css/dataTables.editor.css">
		<link rel="stylesheet" type="text/css" href="css/TableTools.css">


		<style type="text/css">

			#container {
				padding-top: 60px !important;
				width: 960px !important;
			}
			#dt_example .big {
				font-size: 1.3em;
				line-height: 1.45em;
				color: #111;
				margin-left: -10px;
				margin-right: -10px;
				font-weight: normal;
			}
			#dt_example {
				font: 95%/1.45em "Lucida Grande", Verdana, Arial, Helvetica, sans-serif;
				color: #111;
			}
			div.dataTables_wrapper, table {
				font: 13px/1.45em "Lucida Grande", Verdana, Arial, Helvetica, sans-serif;
			}
			#dt_example h1 {
				font-size: 16px !important;
				color: #111;
			}
			#footer {
				line-height: 1.45em;
			}
			div.examples {
				padding-top: 1em !important;
			}
			div.examples ul {
				padding-top: 1em !important;
				padding-left: 1em !important;
				color: #111;
			}
		</style>


		<script type="text/javascript" charset="utf-8" src="js/jquery.js" ></script>
		<script type="text/javascript" charset="utf-8" src="js/jquery.dataTables.js" ></script>
		<script type="text/javascript" charset="utf-8" src="js/TableTools.js" ></script>
		<script type="text/javascript" charset="utf-8" src="js/dataTables.editor.js" ></script>

		<script>
			
			$(document).ready(function() {
				
				editor = new $.fn.dataTable.Editor( {
					"ajaxUrl": "php/locations.php",
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
	
	
				$('#example').dataTable( {
					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": "php/locations.php",  
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
						"sRowSelect": "multi",
						"aButtons": [
							{ "sExtends": "editor_create", "editor": editor },
							{ "sExtends": "editor_edit",   "editor": editor },
							{ "sExtends": "editor_remove", "editor": editor }
						]
					}
				} );
			} );

		</script>

    </head>

    <body>

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
    </body>
</html>
