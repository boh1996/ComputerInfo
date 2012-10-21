<?php
/**
 * Use this to set the subject for the register email
 * @see register_mail_template for variables
 */
$lang["register_mail_subject"] = "Dear {name} please activate your account at {app_name}!";

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
$lang["register_mail_template"] = 'Welcome {name} to <a href="{base_url}">Computer Info</a>,
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
$lang["reset_password_mail_template"] = 'Hey {name}!<br>
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
$lang["reset_password_mail_subject"] = "Dear {name} you have requested a password reset at ComputerInfo!";
?>