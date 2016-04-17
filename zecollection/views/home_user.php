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
			success: function(reponse) { 
				//reponse est un objet json:
				if (reponse.les_collections){
					console.log(reponse.les_collections);
				}else{ // ca  a planté
	       			console.log(reponse.error);
	       		}
	       	}
		});
	}

	window.onload = function() {
		get_collection();
	}

	function showCollection(les_collections) {
		//ici on va contruire la div de une collection

		$("#collec").html(msg);
		$("#collec").css({"height":"auto"});
		$("#collec").css({"display":"block"});
	}

</script>