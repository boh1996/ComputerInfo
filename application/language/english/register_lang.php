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
If this request wasn\'t created by you, then visit <a href="{remove_email_url}">this</a> link!
<br>
Regards Illution';

$lang["ui_register_username"] = "Username";

$lang["ui_regsiter_password"] = "Password";

$lang["ui_re_passowrd"] = "Re-Password";

$lang["ui_register_repeat_password"] = "Repeat password";

$lang["ui_register_email"] = "Email";

$lang["ui_register_name"] = "Name";

$lang["ui_register_using_google"] = "Register Using Google";

$lang["ui_register_incorrect_captcha"] = "Incorrect CAPTCHA!";

$lang["register_error_passwords_not_matching"] = "Passwords not matching";

$lang["register_username_requirement"] = "Username needs to be 5 characters or more";

$lang["register_password_requirement"] = "Password needs to be 7 characters or more and include numbers";

$lang["register_not_valid_email"] = "Not a matching email";

$lang["register_username_or_email_exists"] = "Username or email already exists";

$lang["register_resend_no_user_found"] = "Sorry no user found!";

$lang["register_no_token_found"] = "No token specified!";

$lang["register_we_couldnt_activate"] = "Sorry we couldn't activate that user!";

$lang["registration_removed"] = 'Your registration have been removed click <a href="{signup_url}">here</a> to sign up again!';

$lang["register_activation_mail_send"] = '<a class="btn" href="{resend_activation_url}">Resend activation email!</a>
<a class="btn" href="{remove_email_url}">Remove registration</a>';

$lang["not_a_valid_email"] = "Email is not an email!";

$lang["error_password_not_macthing"] = "Passwords not matching";

$lang["password_pattern_description"] = "Password should be seven or more characters and contain letters and numbers!";
?>