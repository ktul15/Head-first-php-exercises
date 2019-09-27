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
    <h2>Guitar Wars - High Scores</h2>
    <p>Welcome, Guitar Warrier, do you have what it takes to crack the high score list? If so, just <a href="addScores.php">Add your high scores</a></p>
    <hr>

    <?php
        require_once('appvars.php');
        require_once('connectvars.php');

        //connect to the database
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or die('Error connecting');
        
        //retrieve data from the database
        $query = "SELECT * FROM guitar_wars ORDER BY score DESC, date ASC";
        $data = mysqli_query($dbc, $query)
            or die('Error querying');

        //loop through the array of data, formatting it as html
        echo '<table>';
        $i=0;
        while($row = mysqli_fetch_array($data)){
            //display score data
            if($i==0){
                echo '<tr><td colspan="2" class="topscoreheader">Top Score:'.
                    $row['score'].'</td></tr>';
            }
            echo '<tr><td class="scoreinfo>';
            echo '<span class="score">'.$row['score'].'</span><br>';
            echo '<strong>Name:</strong>'.$row['name'].'<br>';
            echo '<strong>Date:</strong>'.$row['date'].'<br>';
            if (is_file(GW_UPLOADPATH . $row['screenshot']) && filesize(GW_UPLOADPATH . $row['screenshot']) > 0) {
                echo '<td><img src="' . GW_UPLOADPATH . $row['screenshot'] . '" alt="Score image" /></td></tr>';
              }
              else {
                echo '<td><img src="' . GW_UPLOADPATH . 'unverified.gif' . '" alt="Unverified score" /></td></tr>';
              }
            $i++;
        }
        echo '</table>';
        
        mysqli_close($dbc);
    ?>
</body>
</html>