<?php
/*
Plugin Name: Search Permalink
Plugin URI: http://www.ajalapus.com/downloads/search-permalink/
Version: 1.0
Description: Redirects search form queries to cruft-free permalink <acronym title="Uniform Resource Identifier">URI</acronym>s
Author: Aja Lorenzo Lapus
Author URI: http://www.ajalapus.com/

    Copyright 2007 Aja Lorenzo Lapus

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
v1.0 25-Aug-2007:
    - Fixed URL encoding bug.
Beta v1 19-Aug-2007:
    - First beta release of the Search Permalink plugin.
*/

function aja_spredir() {
    if (is_search() && $_GET['s']) {
        if (!empty($_GET['paged'])) {
            $aja_uri = get_bloginfo('url') .'/search/'. urlencode(get_query_var('s')) .'/page/'. get_query_var('paged') .'/';
        } else {
            $aja_uri = get_bloginfo('url') .'/search/'. urlencode(get_query_var('s')) .'/';
        }
        wp_redirect($aja_uri);
    }
}

add_action('template_redirect', 'aja_spredir'); 
