
<?php

/*** begin our session ***/
session_start();

header('Content-Type: application/json');

//ici on a 2 variables: 
$message_error = ""; // message erreur
$les_collections = null; //les_collections à recupéré
$console_id = $_POST['console_id'];


/*** check if the users is already logged in ***/
if(!isset( $_SESSION['user_id'] ))
{
    $$message_error = 'Not connected bastard !';
}

else
{
    /*** connect to database ***/
    /*** mysql hostname ***/
    $mysql_hostname = 'localhost';

    /*** mysql username ***/
    $mysql_username = 'collector';

    /*** mysql password ***/
    $mysql_password = 'collector3414006600';

    /*** database name ***/
    $mysql_dbname = 'zecollection';

    try
    {
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        /*** $message = a message saying we have connected ***/

        /*** set the error mode to excptions ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** prepare the select statement ***/
       // $stmt = $dbh->prepare("SELECT G.game_id, G.bar_code, G.game_name, G.VERSION, G.editor, G.developer, G.release_year, I.boite, I.calpin, I.jeux, I.price, I.notes FROM games G, items I WHERE G.game_id = I.game_id AND I.user_id = :user_id AND G.console_id = :console_id");
        $stmt = $dbh->prepare("SELECT * FROM games G, items I WHERE I.user_id = :user_id AND G.console_id = :console_id AND G.game_id = I.game_id");

        /*** bind the parameters ***/
        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_STR);
        $stmt->bindParam(':console_id', $console_id, PDO::PARAM_STR);

        /*** execute the prepared statement ***/
        $stmt->execute();

        /*** check for a result ***/
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        /*** if we have no result then fail boat ***/
        if($result == false)
        {
            $message_error = 'Fuuuu';
        }
        /*** if we do have a result, all is well ***/
        else
        {   
            $les_collections = $result;
        }	

    }
    catch(Exception $e)
    {
        /*** if we are here, something has gone wrong with the database ***/
        $message_error = 'We are unable to process your request. Please try again later"';
    }
}
?>

<?php 
$response = json_encode(array("les_collections"=> $les_collections, "error" => $message_error));

echo $response; ?>
