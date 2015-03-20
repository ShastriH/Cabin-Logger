<?php
	// Connection constants
	define('DB_HOST', '*');
	define('DB_USER', '*');
	define('DB_PASSWORD', '*');
	define('DB_NAME', '*');

	// Connecting
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Error connecting to MySQL server');

	// Abbreviated company name
	$aCName = "Cabin Logger";
	// Full company name
	$fCName = "Cabin Logger";
	// Online company name (website name)
	$oCName = "cabinlogger.com";
	
	$homeURL = '*';
	$imageURL = $homeURL . 'images/';
	
	$breadcrumbs = array();