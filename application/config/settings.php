<?php
/**
 * The standard redirect page if logged in
 */
$config["front_page"] = "";
	
/**
 * This contains the controllers that doesn't need security
 * Use  the value in the array to tell if the in_array feature should be used,
 * default is FALSE
 * @example
 * $config['non_security'] = array("login" => true,"api");
 */
$config['non_security'] = array("login","api_old","home","windows_login","user_management","translations","data","api_test");

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
 * Use this to set a directory for proxy url´s,
 * the format is "HTTP_X_FORWARDED_HOST" => "DIRECTORY"
 * @var array
 */
$config["proxy_host_base_urls"] = array(
	"illution.dk" => "https://illution.dk/ci/"
);

/**
 * The email of the webmaster hosting this solution
 */
$config["webmaster_email"] = "support@illution.dk";

/**
 * The name of the sender of emails to the users
 */
$config["email_sender_name"] = "Illution";

/**
 * The application name
 */
$config["app_name"] = "ComputerInfo";

/**
 * The salt used for app salts
 */
$config["app_hashing_salt"] = "7b1ff613e73cf8391e0530cc488a59fcbc182e67069ff9508541c221e88ed733";

/**
 * The minimum length of the password
 */
$config["password_length"] = 7;

/**
 * The number of iterations to hash the new users password with
 */
$config["hashing_iterations"] = 10000;

/**
 * The length of the user salt
 */
$config["user_salt_length"] = 64;
	
/**
 * The minimum required userame length
 */
$config["username_length"] = 5;

/**
 * The password matching pattern
 */
$config["password_pattern"] = "/(?=[a-z]*[0-9])(?=[0-9]*[a-z])([a-z0-9-]+)/i";

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

$config["languages"] = array("danish" => "Dansk","english" => "English");

$config["session_id_cookie"] = "SESSIONID";

$config["user_id_session"] = "user_id";
?>