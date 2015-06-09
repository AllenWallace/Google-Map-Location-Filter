<?php

/*
 * Example PHP implementation used for the index.html example
 */

// DataTables PHP library
include( "lib/DataTables.php" );

// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Join,
	DataTables\Editor\Validate;

// Build our Editor instance and process the data coming from _POST
Editor::inst($db, 'locations')
		->fields(
				Field::inst('tags'), 
				Field::inst('position'), 
				Field::inst('name'), 
				Field::inst('street1'),
				Field::inst('street2'),
				Field::inst('city'),
				Field::inst('region'),
				Field::inst('postal_code'),
				Field::inst('phone'),
				Field::inst('website')
		)
		->process($_POST)
		->json();
