<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    <?php
        //preset varibles
        $hostName = "localhost";
        $userName = "adminer";
        $password = "judge-quick-25";
        $DBName = "interview";
        $tablename = "people";
        $firstName = "";
        $lastName =  "";
        $formErrorCount = 0;

        function connectToDB($hostName, $userName, $password){
            $DBConnect = mysqli_connect($hostName, $userName, $password);
            if (!$DBConnect) {
                echo "<p>Connection error: " . mysqli_connect_error() . "</p>\n";
            }
            return $DBConnect;
        }
        //this code was not finished
    
        function selectDB($DBConnect, $DBName){
            $success = mysqli_select_db($DBConnect, $DBName);
            if ($success) {
                // echo "<p>Successfully selected the \"$DBName\" database.</p>\n";
            }
            else {
                echo "<p>Could not select the \"$DBName\" database:" . mysqli_error($DBConnect) . ", creating it.</p>";
                $sql = "CREATE DATABASE $DBName";
                if (mysqli_query($DBConnect, $sql)) {
                    // echo "<p>Successfully created the \"$DBName\" database.</p>\n";
                    $success = mysqli_select_db($DBConnect, $DBName);
                    if ($success) {
                        // echo "<p>Successfully selected the \"$DBName\" database.</p>\n";
                    }
                }
                else{
                    // echo "<p>Could not create the \"$DBName\" database: " . mysqli_error($DBConnect) . "</p>\n";
                }
            }
            return $success;
        }
    
        function createTable($DBConnect, $tablename){
            $success = false;
            $sql = "SHOW TABLES LIKE '$tablename'";
            $result = mysqli_query($DBConnect, $sql);
            if (mysqli_num_rows($result) === 0) {
                echo "The <strong>$tablename</strong> table does not exist, creating table.<br>\n";
                $sql = "CREATE TABLE $tablename(countID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                 lastName VARCHAR(40), firstName VARCHAR(40))";
                 $result = mysqli_query($DBConnect, $sql);
                if ($result === false) {
                    $success = false;
                    // echo "<p>Unable to create the $tablename table.</p>";
                    echo "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
                }
                else{
                    $success = true;
                    // echo "<p>Successfully created the $tablename table.</p>";
                }
            }
            else{
                $success = true;
                // echo "The $tablename table already exists.<br>\n";
            }
            return $success;
        }
    
        
    
        if (isset($_POST['submit'])) {
            $firstName = stripslashes($_POST['firstname']);
            $firstName = trim($firstName);
            $lastName = stripslashes($_POST['lastname']);
            $lastName = trim($lastName);
            if (empty($firstName) || empty($lastName)) {
                echo "<p> You must enter your first and last <strong>name</strong>.</p>\n";
                ++$formErrorCount;
            }

            if ($formErrorCount === 0) {
                $DBConnect = connectToDB($hostName, $userName, $password);
                if ($DBConnect) {
                    if (selectDB($DBConnect, $DBName)) {
                            // echo "<p>Database selected!</p>\n";
                            $sql = "INSERT INTO $tablename VALUES(NULL, '$lastName', '$firstName')";
                            $result = mysqli_query($DBConnect, $sql);
                            if ($result === false) {
                                // echo "<p>Unable to execute the query.</p>";
                                echo "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_errno($DBConnect) . "</p>";
                            }
                            else{
                                echo "<h3>Thank you for signing our guest book!</h3>";
                                $firstName = "";
                                $lastName = "";
                            }
                        
                    }
                    mysqli_close($DBConnect);
                }
            }
        }
    ?>
    <form action="Interview2.php" method="post">
        <p style="text-align: center;"><strong>First Name: </strong><br>
        <input type="text" name="firstname" value="<?php echo $firstName; ?>" style="text-align: center;"></p>
        <p style="text-align: center;"><strong>Last Name: </strong><br>
        <input type="text" name="lastname" value="<?php echo $lastName; ?>" style="text-align: center;"></p>
        <p style="text-align: center;"><input type="submit" name="submit" value="Submit"></p>
    </form>
    </body>
</html>