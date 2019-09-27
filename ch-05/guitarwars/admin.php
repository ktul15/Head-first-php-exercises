<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Guitar Wars</title>
</head>
<body>
    <h1>Guitar Wars - High Scores Administrations</h1>
    <hr>

    <?php
        require_once('appvars.php');
        require_once('connectvars.php');

        //connect to the database
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or die('Error connecting');

        //retrieve the data from the database
        $query = "SELECT * FROM guitar_wars";
        $data = mysqli_query($dbc, $query)
            or die("Error querying");

        //loop through the data and format it with html
        echo '<table>';
        while($row = mysqli_fetch_array($data)){
            echo '<tr><td>'.$row['name'].'</td>';
            echo '<td>'.$row['date'].'</td>';
            echo '<td>'.$row['score'].'</td>';
            echo '<td><a href="removescore.php?id='.$row['id'].'&amp;date='.$row['date'].
                    '&amp;name='.$row['name'].'&amp;score='.$row['score'].'&amp;screenshot='.
                    $row['screenshot'].'">Remove</a></td></tr>';
        }
        echo '</table>';

        mysqli_close($dbc);
    ?>
</body>
</html>