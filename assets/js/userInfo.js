var userInfo = {

	/**
	 * This function gets info from a url
	 * @param  {string} url   The url to get data from
	 * @param  {string} token An optional user token
	 * @param {function} callback The function to call when the action is done
	 */
	getInfo : function ( url, token, callback) {
		token = token || this.token || null;
		info = null;
		$.ajax({
			url : this.createAutherizedUrl(url,token),
			success :  function (data) {
				info = data;
				if (typeof callback == "function") {
					callback(data,"ok");
				}
			},
			error : function () {
				callback(null,"fail");
			}
		});
	},

	/**
	 * This function reads a cookie by name
	 * @param  {string} c_name The name of the cookie to read
	 * @return {string}
	 */
	getCookie : function (c_name) {
		var i,x,y,ARRcookies=document.cookie.split(";");
		for (i=0;i<ARRcookies.length;i++) {
		  	x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
		  	y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
		  	x=x.replace(/^\s+|\s+$/g,"");
		  	if (x==c_name) {
		    	return unescape(y);
		  	}
		}
	},

	/**
	 * This function sets a cookie by name
	 * @param {string} c_name The name of the cookie to set
	 * @param {string} value  The value to set
	 * @param {integer} exdays The expirering day
	 */
	setCookie : function (c_name,value,exdays) {
		var exdate=new Date();
		exdate.setDate(exdate.getDate() + exdays);
		var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
		document.cookie=c_name + "=" + c_value;
	},

	/**
	 * This function adds the token parameter to the url
	 * @since 1.1
	 * @param  {string} url The current url to append the token too
	 * @param {string} token The user token0
	 * @return {string}
	 */
	createAutherizedUrl : function (url,token) {
		token = token || this.token;
		if (token != null) {
			if (url.indexOf("?") == -1) {
				url += "?";
			} else {
				url += "&";
			}
			url += "token=" + token;
		}
		return url;
	},
}