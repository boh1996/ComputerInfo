<?php
$lang["ui_reset_password"] = "Reset Password";

$lang["ui_reset_password_email"] = "Email";

$lang["password_reset_has_been_requested"] = 'A password reset for this account has already been requested!';

$lang["reset_password_no_user_found"] = 'No user found!';

$lang["reset_password_no_request_found"] = 'No request found!';

$lang["successfully_changed_password"] = 'Successfully changed password!';

$lang["error_no_token_found"] = "Invalid token";

$lang["error_missing_input"] = "Missing input!";

$lang["password_reset_email_send"] = '<a class="btn" href="{resend_url}">Resend password reset email!</a>
<a class="btn" href="{remove_url}">Remove request!</a>';

$lang["reset_password_request_removed"] = "Request removed!";

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

$lang["password_reset_removed"] = "Your password reset have successfully been removed!";
?>