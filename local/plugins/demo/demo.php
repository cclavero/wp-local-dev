<?php
/*
Plugin Name: demo
Plugin URI: 
Description: Demo plugin
Author: Carles Clavero i Matas
Author URI: carles.clavero@gmail.com
Version: 1.0.0
*/

function demo() {
	echo('<p id="demo">Demo</p>');
}

add_action("admin_notices","demo");

function demo_css() {
	echo "<style type='text/css'>
		#demo {
			float: right;
			z-index: 1000;
			margin: 0;
			padding: 5px 10px;
			font-size: 12px;
			font-weight: bold;
			line-height: 1.6666;
		}
	</style>";
}

add_action("admin_head","demo_css");
