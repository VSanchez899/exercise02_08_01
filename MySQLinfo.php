<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MySQLinfo</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    <h2>MySQL Database Server Information</h2>
    <?php
    echo "<p>MySQL client Version: " . mysqli_get_client_info() . "</p>\n";
    $hostName = "localhost";
    $userName = "adminer";
    $password = "judge-quick-25";
    $DBConnect = mysqli_connect($hostName, $userName, $password);
    if (!$DBConnect) {
        echo "<p>Connection Failed</p>";
    } else {
        echo "<p>MySQL connection: " . mysqli_get_host_info($DBConnect) . "</p>\n";
        echo "<p>MySQL protocol version: " . mysqli_get_proto_info($DBConnect) . "</p>\n";
        echo "<p>MySQL server version: " . mysqli_get_server_info($DBConnect) . "</p>\n";
        mysqli_close($DBConnect);
        echo "<p>Closing Database connection</p>\n";
    }
    
    ?>
    </body>
</html>