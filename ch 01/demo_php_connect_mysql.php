<?php
    $dbc = mysqli_connect('localhost', 'ketul', 'k2l@mysql', 'aliendatabase')
    or die('Error');

    $query = "INSERT INTO aliens_abduction (first_name, last_name, when_it_happened, how_long, " .
    "how_many, alien_description, what_they_did, fang_spotted, other, email) " .
    "VALUES ('$first_name', '$last_name', '$when_it_happened', '$how_long', '$how_many', " .
    "'$alien_description', '$what_they_did', '$fang_spotted', '$other', '$email')";

    $result = mysqli_query($dbc, $query)
    or die('Error querying database.');

    mysqli_close($dbc);
?>