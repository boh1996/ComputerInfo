<html>
<head
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
</head>
<body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready();
function Post(){
		$.ajax({
			url: "//127.0.0.1/ci/computer/",
			type:"POST",
			data : {"identifier" : "fiskelalal","organization" : 1},
			success: function(data){
				/*if(typeof data.error_code == "undefined"){
						data = data.replace("{","{\n");
						data = data.replace("}","\n}\n");
					$("#return").append(data+"\n");
				} else {
					$("#return").append(data+"\n");
				}*/
				$("#return").append(data+"\n");
			},
			error: function(){
				$("#return").append(data+"\n");
			}
		});
}

function Get(){
	$.ajax({
		url: "//127.0.0.1/ci/computer/1",
		type:"GET",
		success: function(data){
			if(typeof data.error_code == "undefined"){
				series = data;
				$("#return").append(data.Id+"\n");
			} else {
				$("#return").append(data+"\n");
			}
		},
		error: function(){
			$("#return").append(data+"\n");
		}
	});
}
function Delete(){
	$.ajax({
		url: "//127.0.0.1/ci/computer/19",
		type:"DELETE",
		success: function(data){
			console.log("Success");
			if(typeof data.error_code == "undefined"){
				$("#return").append(data+"\n");
			} else {
				$("#return").append(data+"\n");
			}
		},
		error: function(){
			$("#return").append(data+"\n");
		}
	});
}
function Put(){
	$.ajax({
		url: "//127.0.0.1/ci/computer/19",
		type:"PUT",
		data: {"identifier" : "fiskelal"},
		success: function(data){

		},
		error: function(){
			$("#return").append(data+"\n");
		}
	});
}

function Options(){
	$.ajax({
		url: "//127.0.0.1/ci/computer/1",
		type:"OPTIONS",
		success: function(data){
			if(typeof data.error_code == "undefined"){
				$("#return").append(data+"\n");
			} else {
				$("#return").append(data+"\n");
			}
		},
		error: function(data){
			$("#return").append(data+"\n");
		}
	});
}

function Head(){
	var ajax = $.ajax({
		url: "//127.0.0.1/ci/computer/1",
		type:"HEAD",
		success: function(data){
			$("#return").append(ajax.getAllResponseHeaders()+"\n");
		},
		error: function(){
		}
	});
}
function Patch(){
	var ajax = $.ajax({
		url: "//127.0.0.1/ci/computer/19",
		data : {"identifier": "fiskelal"},
		type:"PATCH",
		success: function(data){
		},
		error: function(){
		}
	});
}
</script>
<button onclick="Post();">Post</button>
<button onclick="Get()">Get</button>
<button onclick="Delete()">Delete</button>
<button onclick="Put()">Put</button>
<button onclick="Options()">Options</button>
<button onclick="Head()">Head</button>
<button onclick="Patch()">Patch</button>
<textarea id="return" style="width:90%;height:90%;"></textarea>
</body>
</html>