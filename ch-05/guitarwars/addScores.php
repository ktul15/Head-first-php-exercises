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
    <h1>Guitar Wars - Add Your High Scores</h1>

    <?php 
        require_once('appvars.php');
        require_once('connectvars.php');

        if(isset($_POST['submit'])){
            //grab the score data from the post
            $name = $_POST['name'];
            $score = $_POST['score'];
            $screenshot = $_FILES['screenshot']['name'];
            $screenshot_type = $_FILES['screenshot']['type'];
            $screenshot_size = $_FILES['screenshot']['size'];

            if((!empty($name)) && (!empty($score)) && (!empty($screenshot))){
                //true only if file type is image and file size is lower than 32 kb
                if((($screenshot_type = 'image/gif') || ($screenshot_type = 'image/jpeg') || 
                    ($screenshot_type = 'image/png') || ($screenshot_type = 'image/pjpeg')) && 
                    ($screenshot_size > 0) && ($screenshot_size <= GW_MAXFILESIZE))
                {
                    if($_FILES['file']['error'] == 0){
                        //move uploaded file to the target upload folder
                        $target = GW_UPLOADPATH.$screenshot;

                        if(move_uploaded_file($_FILES['screenshot']['tmp_name'], $target))
                        {
                            //connect to the database
                            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                            or die('Error connecting');

                            //write the data to the database
                            $query = "INSERT INTO guitar_wars VALUES ('$name', '$score', NOW(), '$screenshot')";
                            mysqli_query($dbc, $query)
                                or die("Error querying");
                            
                            //confirm success with the user
                            echo '<p>Thanks for adding your new high score. It will be reviewed and added to the high score list as soon as possible.</p>';
                            echo '<p><strong>Name:</strong>'.$name.'<br />';
                            echo '<strong>Score:</strong>'.$score.'</p>';
                            echo '<img src="'.GW_UPLOADPATH.$screenshot.'" alt="Score Image"></p>';
                            echo '<p><a href="index.php">&lt;&lt; Back to high scores</p>';

                            //clear the score data to clear the form
                            $name = "";
                            $score = "";
                            $screenshot = "";

                            mysqli_close($dbc);
                        }
                        else
                        {
                            echo '<p class="error">Sorry, there was a problem uploading your screen shot.</p>';
                        }
                    }
                } 
                else 
                {
                    echo echo '<p class="error">The screen shot must be a GIF, JPEG, or PNG image file no'. 
                                'greater than ' . (GW_MAXFILESIZE / 1024) . ' KB in size.</p>';
                }
                //try to delete the temporary screen shot image file
                // @unlink($_FILES['screenshot']['tmp_name']);
            } 
            else 
            {
                echo '<p class="error">Please enter all of the info. to add your high score.</p>';
            }
        }
    ?>
    <hr />

    <form enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF']?>" method='post'>
        <label for="name">Name:</label>
        <input type="text" name="name"><br>

        <label for="score">Score:</label>
        <input type="text" name="score"><br>

        <label for="screenshot">Screen Shot:</label>
        <input type="file" name="screenshot" id="screenshot"><br>

        <hr>

        <input type="submit" name='submit' value='Add'>
    </form>

    <?php
    
    ?>
</body>
</html>