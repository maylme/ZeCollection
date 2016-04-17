
<?php

/*** begin our session ***/
session_start();

header('Content-Type: application/json');

/*** check if the users is already logged in ***/
if(!isset( $_SESSION['user_id'] ))
{
   // $message = 'Not connected bastard !';
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
        $stmt = $dbh->prepare("SELECT console_name , COUNT(*) as nb_jeux FROM games G, consoles C WHERE G.console_id = C.console_id AND G.game_id IN (SELECT DISTINCT game_id FROM items WHERE user_id = 3 AND jeux = 1) GROUP BY G.console_id");

        /*** bind the parameters ***/
        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_STR);

        /*** execute the prepared statement ***/
        $stmt->execute();

        /*** check for a result ***/
        $message = $stmt->fetchAll(PDO::FETCH_ASSOC);

        /*** if we have no result then fail boat ***/
        if($message == false)
        {
            $message = 'Fuuuu';
        }
        /*** if we do have a result, all is well ***/
        else
        {   
            $consoles = $message;
            //print_r($message);

            $message = '';

            foreach ($consoles as $row => $game) {
                $message .= '<div class="container">'.$game['console_name'].'<br/>';
                $message .= '<br/>Nombre de jeux : '.$game['nb_jeux'];
                $message .= '<br/>> Liste des jeux';
                $message .= '<br/>> Ajouter un jeu';
                $message .= '</div>';

            }

            $message .= '<div class="container">+</div';
        }


    }
    catch(Exception $e)
    {
        /*** if we are here, something has gone wrong with the database ***/
        $message = 'We are unable to process your request. Please try again later"';
    }
}
?>

<?php 
$response = json_encode(array("message"=> $message));

echo $response; ?>
