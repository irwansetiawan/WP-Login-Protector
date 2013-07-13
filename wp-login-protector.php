<?php
/*
Plugin Name: WP Login Protector
Plugin URI: http://www.irwansetiawan.com
Description: Wordpress plugin that protects your Login form from robots that tries to brute force your wordpress site. Only human will be able to see your login page.
Version: 1.0
Author: Irwan Setiawan
Author URI: http://www.irwansetiawan.com
License: GPL2
*/

/*  Copyright 2013 Irwan Setiawan 

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function wp_login_protector()
{
    $wp_login_protector_url_param = 'wp_login_protector';
    $wp_login_protector_cookie_name = 'wp_login_protector';

    if( empty($_COOKIE[$wp_login_protector_cookie_name]) )
    {
        if( empty($_GET[$wp_login_protector_url_param]) )
        {
            setcookie($wp_login_protector_cookie_name, '1', time()+3600, '/');
            wp_redirect( get_bloginfo( 'url' ) . '/wp-login.php?wp_login_protector=1' );
            die();
        }
        else {
            header('HTTP/1.1 403 Forbidden');
            die('You are not human and not authorized to open this page');
        }
    }
}
add_action( 'login_init', 'wp_login_protector' );