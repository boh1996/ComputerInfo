<?php
/**
 * The standard redirect page if logged in
 */
$config["front_page"] = "ui";
	
/**
 * This contains the controllers that doesn't need security
 * Use  the value in the array to tell if the in_array feature should be used,
 * default is FALSE
 * @example
 * $config['non_security'] = array("login" => true,"api");
 */
$config['non_security'] = array("login","api","home","windows_login","user");

/**
 * The login controller
 */
$config["login_page"] = "home/login";

/**
 * The not logged in front page
 */
$config["not_logged_in_page"] = "home";

/**
 * The url where to find the assets
 */
$config["asset_url"] = "assets/";

/**
 * The salt used for app salts
 */
$config["app_hashing_salt"] = "7b1ff613e73cf8391e0530cc488a59fcbc182e67069ff9508541c221e88ed733";

/**
 * The minimum length of the password
 */
$config["password_length"] = 7;

/**
 * The login secret key
 */
$config["login_secret"] = "Ft2Cx1125Mh9hMdwKBEqv15q6b00gNNS";

/**
 * The url to jquery
 */
$config["jquery_url"] = "https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js";

/**
 * The url where to request jquery ui
 */
$config["jqueryui_version"] = "1.8.23";

/**
 * If this is set to true, then the login system is turned off
 */
$config["dev_mode"] = true;
	
/**
 * If this parameter is true and dev_mode is true, then security is off
 */
$config["login_off"] = false;
?>