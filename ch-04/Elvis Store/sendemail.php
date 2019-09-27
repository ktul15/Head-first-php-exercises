<?php
    $subject        = $_POST['subject'];
    $body           = $_POST['body'];

    if(isset($_POST['submit'])){

        $from           = 'ketulmakwana09@gmail.com';
        
        $output_form    = false;

        if((empty($subject)) && (empty($body)))
        {
            echo "You forgot the mail subject and body text.<br>";
            $output_form=true;
        }

        if((empty($subject)) && (!empty($body)))
        {
            echo "You forgot the mail subject.<br>";
            $output_form=true;
        }

        if((!empty($subject)) && (empty($body)))
        {
            echo "You forgot the mail body text.<br>";
            $output_form=true;
        }
    
    } else {    
        $output_form=true;
    }

    if((!empty($subject)) && (!empty($body)))
    {
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
    }
    
    if($output_form){
?>
        <h1>MakeMeElvis.COM</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <label for="subject">Subject of the email:</label><br>
            <input type="text" id="subject" name="subject" size="60" value="<?php echo $subject; ?>"><br>

            <label for="elvismail">Body of the email:</label><br>
            <textarea name="body" id="elvismail" cols="60" rows="8"><?php echo $body; ?></textarea><br>

            <input type="submit" name="submit" value="Submit">
        </form>
<?php
    }
?>

<!-- <h1>MakeMeElvis.COM</h1>
<form action="sendemail.php" method="POST">
    <label for="subject">Subject of the email:</label><br>
    <input type="text" id="subject" name="subject" size="60"><br>

    <label for="elvismail">Body of the email:</label><br>
    <textarea name="body" id="elvismail" cols="60" rows="8"></textarea><br>

    <button>Submit</button>
</form> -->