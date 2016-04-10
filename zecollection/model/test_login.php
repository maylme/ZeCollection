<?php 

/*** begin the session ***/

$logged_in = false;

if(!isset($_SESSION['user_id']))
{
    $logged_in = false;
}
else
{
    try
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


        /*** select the users name from the database ***/
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        /*** $message = a message saying we have connected ***/

        /*** set the error mode to excptions ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** prepare the insert ***/
        $stmt = $dbh->prepare("SELECT username FROM user 
        WHERE user_id = :user_id");

        /*** bind the parameters ***/
        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

        /*** execute the prepared statement ***/
        $stmt->execute();

        /*** check for a result ***/
        $username = $stmt->fetchColumn();

        /*** if we have no something is wrong ***/
        if($username == false)
        {
            $logged_in = false;
        }
        else
        {

            $logged_in = true;
            $user = new stdClass();
            $user->username = $username;
            $user->actions = array();
            $_SESSION['user'] = $user;
        }
    }
    catch (Exception $e)
    {
        /*** if we are here, something is wrong in the database ***/
        $logged_in = false;
    }
}

?>
