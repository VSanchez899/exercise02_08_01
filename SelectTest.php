<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MySQLinfo</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    <h2>Create Newsletter Database</h2>
    <?php
    echo "<p>MySQL client Version: " . mysqli_get_client_info() . "</p>\n";
    $hostName = "localhost";
    $userName = "adminer";
    $password = "judge-quick-25";
    $DBName = "newsletter1";
    $DBConnect = mysqli_connect($hostName, $userName, $password);
    if (!$DBConnect) {
        echo "<p>Connection error:" . mysqli_connect_error() . "</p>";
    } else {
        
        if (mysqli_select_db($DBConnect, $DBName)) {
            echo "<p>Successfully created the \"$DBName\"" . "database.</p>\n";
        } else {
            echo "<p>could not create the \"$DBName\"" . "database: " . mysqli_error($DBConnect) . "</p>\n";
        }
        
        mysqli_close($DBConnect);
        echo "<p>Closing Database connection</p>\n";
    }
    
    ?>
    </body>
</html>