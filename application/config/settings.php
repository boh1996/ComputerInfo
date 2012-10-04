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
$config['non_security'] = array("login","api","home","windows_login","user_management");

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
 * Use this to set the subject for the register email
 * @see register_mail_template for variables
 */
$config["register_mail_subject"] = "Dear {name} please activate your account at {app_name}!";

/**
 * A template for the mail to send to the user,
 * when the are registred and need do activate their accont
 * use {name} for the users name, 
 * {email} for the users email
 * and {token} for the activation token,
 * {base_url} for the site url,
 * and {activation_url} for the activation url with the token appended,
 * {webmaster_email} for the webmaster email,
 * {organization_name} fort the host organization name,
 * {app_name} for your application name
 */
$config["register_mail_template"] = 'Welcome {name} to <a href="{base_url}">Computer Info</a>,
please activate your account.
<br>
To activate your account please visit <a href="{activation_url}">this</a> link!
<br>
Regards Illution';

/**
 * A template for the mail to send to the user,
 * when they have requested for password reset
 * use {name} for the users name, 
 * {email} for the users email
 * and {token} for the reset token,
 * {base_url} for the site url,
 * and {reset_url} for the reset url with the token appended,
 * {webmaster_email} for the webmaster email,
 * {organization_name} fort the host organization name,
 * {app_name} for your application name,
 * {reset_time} the time when the email was sent,
 * {reset_day} the day when the email was sent,
 * {remove_url} the url to the request remove page
 */
$config["reset_password_mail_template"] = 'Hey {name}!<br>
You have requested for a password reset at {reset_time} on the {reset_day},<br>
for your account at <a href="{base_url}">Computer Info</a>,<br>
click <a href="{reset_url}">this</a> link to change your password!<br>
If the password reset request wasn\' created by you,
then click <a href="{remove_url}">this</a> link!
<br>
Regards Illution
';

/**
 * The template for subject for the reset password email
 * @see reset_password_mail_template for template variables
 */
$config["reset_password_mail_subject"] = "Dear {name} you have requested a password reset at ComputerInfo!";

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
$config["hashing_iterations"] = 10;

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
?>