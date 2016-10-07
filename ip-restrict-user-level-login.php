<?php

/*
Plugin Name: IP Restrict User Level Login
Plugin URI: https://github.com/stillatmylinux/ip-restrict-user-level-login
Description: A WordPress plugin to restrict logins for a certain user level by IP address.
Version: 1.0.0
Author: Matt Thiessen
Author URI: http://matt.thiessen.us/
License: GPLv3 or later
*/

/*
Copyright (C) 2016  Matt Thiessen (email : matt@thiessen.us)
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

class IP_Restrict_User_Level_Login {
	private $user_level = 'shop';
	private $allowed_IPs = array('50.80.27.89', '127.0.0.1');

	private static $instance;

	public static $api;


	/**
	 * Get active instance
	 *
	 * @access      public
	 * @since       1.0.0
	 * @return      object self::$instance
	 */
	public static function instance() {
		if( ! self::$instance ) {
			self::$instance = new IP_Restrict_User_Level_Login();
			self::$instance->hooks();
		}

		return self::$instance;
	}

	/**
	 * Add the hooks
	 *
	 * @access      public
	 * @since       1.0.0
	 * @return      null
	 */
	public function hooks() {
		add_action( 'wp_login', array( $this, 'verify_user_level_login') );
	}

	/**
	 * Get the current user's IP address
	 *
	 * @access      public
	 * @since       1.0.0
	 * @return      null
	 */
	public function get_ip_address_address(){
		foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
			if (array_key_exists($key, $_SERVER) === true){
				foreach (explode(',', $_SERVER[$key]) as $ip){
					$ip = trim($ip); // just to be safe

					if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
						return $ip;
					}
				}
			}
		}
	}

	/**
	 * Compare the IP to allowed IP(s)
	 *
	 * @access      public
	 * @since       1.0.0
	 * @return      null
	 */
	public function verify_user_level_login() {
		$user_info = wp_get_current_user();

		if( isset( $user_info->wp_capabilities[$this->user_level] ) && $user_info->wp_capabilities[$this->user_level] ) {

			if( ! in_array( $this->get_ip_address(), $this->allowed_IPs ) ) {
				wp_logout();
				die('logged out ' . $this->get_ip_address() );
			}
		}
		
	}
}

IP_Restrict_User_Level_Login::instance();