var data = {
	"computer" : "computer",
	"printer" : "printer",
	"units" : "units",
	"organizations" : "organizations"
} 

if (typeof history.pushState === 'undefined') {
  var History = window.History; // Note: We are using a capital H instead of a lower h
}

$(".nav li a").live('click', function (event) {
  	var title,url,object;
  
  	event.preventDefault();
  	if (event.target.nodeName == 'A') {
	   	url = event.target.getAttribute('data-target');
	    title = event.target.getAttribute('data-title');
	    History.pushState(null,title, root + "#/"+ data[url]);
	}
});

$(window).on('popstate', function (event) {

});

$(window).on("onanchorchange", function (event) {
  	console.log(History.getState());
});

$(window).on('hashchange', function (event) {
	//For old browsers
});

$(window).on('pageshow', function (event) {
	computerGenerator.generateTable();
	computerGenerator.getComputers(1);
	setTimeout(function(){
		computerGenerator.initializeDatatables();
	},300);
});

$(window).on('pagehide', function (event) {
	//Minimize
});