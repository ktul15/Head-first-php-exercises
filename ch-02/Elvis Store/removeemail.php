<?php
    $removeemail = $_POST['removeemail'];

    $dbc = mysqli_connect('localhost', 'ketul', 'k2l@mysql', 'elvis_store')
    or die("Error connecting database");

    $query = "DELETE FROM email_list WHERE email = '$removeemail'";

    mysqli_query($dbc, $query)
        or die('Error querying!');
    
    echo "Customer Removed";

    mysqli_close($dbc);
?>