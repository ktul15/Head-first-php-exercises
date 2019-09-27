<?php
    require_once('appvars.php');
    require_once('connectvars.php');

    //connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
    or die('Error connecting');

    //delete the score from the database
    $query = "SELECT * FROM guitar_wars";
    $data = mysqli_query($dbc, $query)
        or die("Error querying");
?>