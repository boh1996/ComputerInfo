<?php
	$route["home"] = "home";
	$route["logout/reset"] = "login/reset";
	$route["home/login"] = "home";
	$route["translate/(:any)"] = "translations/file/$1";
	$route["users/sign_up"] = "user_management/register";
	$route["user/register/check"] = "user_management/check";
	$route["user/register/delete/(:any)"] = "user_management/delete/$1";
	$route["user/activate/resend/(:any)"] = "user_management/resend/$1";
	$route["user/activate/(:any)"] = "user_management/activate/$1";
	$route["user/password/new/check"] = "user_management/reset_password_check";
	$route["user/reset/password"] = "user_management/forgot_password";
	$route["user/settings"] = "user_management/update_user_settings";
	$route["user/remove/new/password/(:any)"] = "user_management/remove_new_password/$1";
	$route["user/reset/password/resend/(:any)"] = "user_management/password_resend/$1";
	$route["user/reset/password/check"] = "user_management/reset_password";
	$route["user/reset/password/new/(:any)"] = "user_management/create_new_password/$1";
	if ( ! empty($_POST["username"]) ) {
		$route["login/check"] = "login/enter";
	} else {
		$route["logout"] = "login/logout";
		$route["login/enter"] = "ui";
		$route["login/check"] = "login/redirect";
		$route["login/(:any)"] = "login/$1";
		$route["login"] = "login";
	}
	$route["(:any)"] = "ui/$1";
	$route["(:any)/(:any)"] = "ui/$1/$2";
?>