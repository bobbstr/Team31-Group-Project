    <?php
        $server = "localhost";
        $username = "user";
        $password = "password";
        $db_name = "SugarRush";

        try{
            $conn = mysqli_connect($server, $username, $password, $db_name);
        }
        catch(mysqli_sql_exception){
            echo "could not connect!";
        }
        // Check database connection is working correctly.
        if ($conn){
            echo "You are connected!";
        }
    ?>