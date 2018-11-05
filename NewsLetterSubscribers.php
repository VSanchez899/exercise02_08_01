<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Create Subscribers T</title>
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
    $tableName = "subscribers";
    $DBConnect = mysqli_connect($hostName, $userName, $password);
    if (!$DBConnect) {
        echo "<p>Connection error:" . mysqli_connect_error() . "</p>";
    } else {
        
        if (mysqli_select_db($DBConnect, $DBName)) {
            echo "<p>Successfully created the \"$DBName\"" . "database.</p>\n";
            $sql = "SELECT * FROM $tableName";
            $result = mysqli_query($DBConnect, $sql);
            echo "<p>number of rows in" . " <strong>$tableName</stong>: " . mysqli_num_rows($result) . ".</p\n>";
            echo "<table width='100%' border='1'>\n";
            echo "<tr>";
            echo "<th>Subscriber ID</th>";
            echo "<th>Name</th>";
            echo "<th>Email</th>";
            echo "<th>Subscriber Date</th>";
            echo "<th>Subscriber Confirm</th>";
            echo "</tr>";
            echo "</table>";
            mysqli_free_result($result);
        } else {
            echo "<p>could not create the \"$DBName\"" . "database: " . mysqli_error($DBConnect) . "</p>\n";
        }
        echo "<p>Closing Database connection</p>\n";
        mysqli_close($DBConnect);
    }
    
    ?>
    </body>
</html>