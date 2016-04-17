<div id="collec"></div>

<script>
	function get_collection() {
		$.ajax({
			url: "/model/get_collection.php",
			type: 'POST',
			async: true,
			cache: false,
			timeout: 30000,
			error: function() {
				console.log("Error.");
			},
			success: function(msg) { 
	        	showCollection(msg.message);
	        }
		});
	}

	window.onload = function() {
		get_collection();
	}

	function showCollection(msg) {
		$("#collec").html(msg);
		$("#collec").css({"height":"auto"});
		$("#collec").css({"display":"block"});
	}
</script>