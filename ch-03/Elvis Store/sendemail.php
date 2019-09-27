<?php

    $from = 'k1@localhost';
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    $dbc = mysqli_connect('localhost', 'ketul', 'k2l@mysql', 'elvis_store')
        or die("Error connecting database");

    $query = "SELECT * FROM email_list";

    $result = mysqli_query($dbc, $query) 
        or die("Error querying database");

    while($row = mysqli_fetch_array($result)){
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];

        $msg = "Dear $first_name $last_name, \n $body";

        $to = $row['email'];
        if(mail($to, $subject, $msg, 'From:'. $from)){
            echo "Email sent to: ". $to . "<br />";
        }

    }
    mysqli_close($dbc);
?>