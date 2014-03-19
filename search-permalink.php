<?php
/*
Plugin Name: Search Permalink
Plugin URI: https://github.com/leocaseiro/search-permalink
Version: 1.2.0
Description: Redirects search form queries to cruft-free permalink <acronym title="Uniform Resource Identifier">URI</acronym>s
Author: Leo Caseiro
Author URI: http://leocaseiro.com.br/

	Copyright 2007 Aja Lorenzo Lapus | Leo Caseiro 2014

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

Change Log:
v1.2.0 10-Mar-2014:
	- Rewritten for compatibility with 3.8.1 by Leo Caseiro
v1.1.0 17-Oct-2007:
	- Added client-side script to lessen server-side processing and redirects.
v1.0.1 14-Oct-2007:
	- Support for any combination of permalink and query string requests for search term and page number.
v1.0.0 25-Aug-2007:
	- Fixed URL encoding bug.
Beta v1 19-Aug-2007:
	- First beta release of the Search Permalink plugin.
*/

/* JavaScript Output */


// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}


function searchp_load_js_and_css() {
	wp_enqueue_script( 'searchp_functions', plugins_url( 'js/functions.js' , dirname(__FILE__) ), array('jquery') );
	$search = array(
		'url' => get_bloginfo('url')
	);
	wp_localize_script('functions', 'Search',  $search);
}

/* Server-side Redirect Callback */

function searchp_spredir() {
	if ( is_search() && ! empty( $_GET['s'] ) ) {
		wp_redirect( home_url('/search/') . urlencode( get_query_var('s') ));
		exit();
	}
}

/* WordPress Hooks */

add_action('template_redirect', 'searchp_spredir');
add_action('wp_head', 'searchp_load_js_and_css');