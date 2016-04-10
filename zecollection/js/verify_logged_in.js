/** Ajax to now if user is logged in **/

var isLoggedIn = function(callback) {

	$.ajax({
        url: "/model/test_login.php",
        type: 'GET',
        async: true,
        cache: false,
        timeout: 30000,
        jsonpCallback: callback,
        error: function(){
            callback(false);
        },
        success: function(msg){ 
     		var logged_in = msg["logged_in"];
     		
     			callback(logged_in);
     		
        }
    });
/*
    $.when( $.ajax({'url':"/model/test_login.php", 'async':false}) ).then(function( data, textStatus, jqXHR ) {
    	console.log(data);
      		return data; // Alerts 200
	});

*/
};

