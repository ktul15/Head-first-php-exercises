<p>Please select the email addresses to delete from the email list and click Remove.</p>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <?php
        $dbc = mysqli_connect('localhost', 'ketul', 'k2l@mysql', 'elvis_store')
        or die("Error connecting database");

        //delete the customer rows (only if the form is submitted)
        if(isset($_POST['submit'])){
            foreach($_POST['todelete'] as $delete_id){
                $query  = "DELETE FROM email_list WHERE id = $delete_id";
                mysqli_query($dbc, $query) 
                    or die('Error querying!');
            }

            echo "Customer(s) Removed.<br>";
        }

        //display the customer rows with checkboxes for deleting.
        $query = "SELECT * FROM email_list";
        $result = mysqli_query($dbc, $query);
        
        while($row = mysqli_fetch_array($result)){
            echo '<input type="checkbox" value="'.$row['id'].'" name="todelete[]" />';
            echo  $row['first_name'];
            echo ''. $row['last_name'] ;
            echo ''. $row['email'];
            echo '<br />';
        }

        mysqli_close($dbc);
    ?>
    <input type="submit" value="Remove" name="submit"/>
</form>
