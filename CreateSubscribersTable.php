<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Create Subscribers Table</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    <h2>Create Subscribers Table</h2>
    <?php
    $hostName = "localhost";
    $userName = "adminer";
    $password = "judge-quick-25";
    $DBName = "newsletter1";
    $TableName = "subscribers";
    $DBConnect = mysqli_connect($hostName, $userName, $password);
    if (!$DBConnect) {
        echo "<p>Connection error:" . mysqli_connect_error() . "</p>";
    } else {
        
        if (mysqli_select_db($DBConnect, $DBName)) {
            echo "<p>Successfully created the \"$DBName\"" . "database.</p>\n";
            $sql = "SHOW TABLES LIKE '$TableName'";
            $result = mysqli_query($DBConnect, $sql);
            if (mysqli_num_rows($result) == 0) {
                echo "<p>The <strong>$TableName</strong>" . " table does not exist, creating table.</p>\n";
                $sql = "CREATE TABLE $TableName" . " (subscriberID SMALLINT NOT NULL" . " AUTO_INCREMENT PRIMARY KEY," . " name VARCHAR(80), email VARCHAR(100)," . " subscribeDate DATE, ConfirmedDate DATE)";
                $result = mysqli_query($DBConnect, $sql);
            if (!$result) {
                echo "<p>Unable to create the" . " <strong>$TableName</strong> Table.<br>\n";
                echo "Error " . mysqli_error($DBConnect) . "</p>\n";   
            } else {
                echo "<p>Successfully created the" . " <strong>$TableName</strong> Table.<p>\n";    
            }
            } else {
                echo "<p>The<strong>$TableName</strong>" . " table already exist.</p>\n";
                
            }
            
        } else {
            echo "<p>could not create the \"$DBName\"" . "database: " . mysqli_error($DBConnect) . "</p>\n";
        }
        
        mysqli_close($DBConnect);
        echo "<p>Closing Database connection</p>\n";
    }
    
    ?>
    </body>
</html>