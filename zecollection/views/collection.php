<?php
    include_once('includes/header.php');
?>

<?php
    $console_id = $_GET['console'];
?>

<script>
    function get_collection() {
        $.ajax({
            url: "/model/games_for_console.php",
            type: 'POST',
            async: true,
            cache: false,
            timeout: 30000,
            data:{
                    "console_id":"<?php echo $console_id ?>"
                },
            error: function(msg) {
                console.log("Error.");
                console.log(msg);
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
        html += '<br/>> <a href="/views/collection.php?console='+collection.console_id+'">Liste des jeux</a>';
        html += '<br/>> Ajouter un jeu';
        html += '</div>';
        $("#collec").append(html);
        $("#collec").css({"height":"auto"});
        $("#collec").css({"display":"block"});
    }
</script>

<?php
    include_once('includes/footer.php');
?>

