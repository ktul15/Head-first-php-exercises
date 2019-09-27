<?php
    $dbc = mysqli_connect('localhost', 'ketul', 'k2l@mysql', 'elvis_store')
        or die("Error connecting database");

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    $query = "INSERT INTO email_list(first_name, last_name, email)".
        "VALUES('$first_name', '$last_name', '$email')";

    mysqli_query($dbc, $query) or die("Error querying database");

    echo 'Customer added';
    echo '<a href="addemail.html">Go Back to Form</a>';

    mysqli_close($dbc);
?>