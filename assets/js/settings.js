$("#settings-form").submit(function (event) {
	event.preventDefault();
	if ($("#user-language").val() == "") {
		return;
	}
	var data = {
		"save_selection" : ($("#save-selection").attr("checked") == "checked") ? true : false,
		"language" : $("#user-language").val(),
		"user_email" : $("#user-email").val(),
		"user_password" : $("#user-password").val(),
		"user_name" : $("#user-name").val()
	}
	$.ajax({
		url : root + "user/settings?token="+userInfo.getCookie("token"),
		type : "POST",
		data : data,
		success : function () {
			window.location = window.location;
		}
	});
});;