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
					//ici foreach lescollections:
					for (var i = 0 ; i < reponse.les_collections.length; i++){
						showCollection(reponse.les_collections[i]);
					}
				}else{ // ca  a planté
	       			console.log(reponse.error);
	       		}
	       	}
		});
	}

	window.onload = function() {
		get_collection();
	}

	function showCollection(collection) {
		//ici on va contruire la div de une collection
		console.log(collection);
		var html = '<div class="container">'+collection.console_name+'<br/>';
		html += '<br/>Nombre de jeux : '+ collection.nb_jeux;
        html += '<br/>> Liste des jeux';
        html += '<br/>> Ajouter un jeu';
        html += '</div>';
		$("#collec").append(html);
		$("#collec").css({"height":"auto"});
		$("#collec").css({"display":"block"});
	}

</script>