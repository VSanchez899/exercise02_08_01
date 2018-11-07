
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
         //preset variables
         $hostName = "localhost";
         $userName = "adminer";
         $password = "judge-quick-25";
         $DBName = "interview";
         $tablename = "people";
         $firstName = "";
         $lastName = "";
         $formErrorCount = 0;

         function connectToDB($hostName, $userName, $password){
                 $DBConnect = mysqli_connect($hostName, $userName, $password);
                 if (!$DBConnect) {
                     echo "<p>Connection error: " . mysqli_connect_error() . "</p>\n";
                 }
                 return $DBConnect;
             }

     function selectDB($DBConnect, $DBName){
         $success = mysqli_select_db($DBConnect, $DBName);
         if ($success) {
             echo "<p>Successfully selected the \"$DBName\" database.</p>\n";
         }
         else {
             echo "<p>Could not select the \"$DBName\" database:" . mysqli_error($DBConnect) . ", creating it.</p>";
             $sql = "CREATE DATABASE $DBName";
             if (mysqli_query($DBConnect, $sql)) {
                 echo "<p>Successfully created the \"$DBName\" database.</p>\n";
                 $success = mysqli_select_db($DBConnect, $DBName);
                 if ($success) {
                     echo "<p>Successfully selected the \"$DBName\" database.</p>\n";
                 }
             }
             else{
                 echo "<p>Could not create the \"$DBName\" database: " . mysqli_error($DBConnect) . "</p>\n";
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
                 echo "<p>Unable to create the $tablename table.</p>";
                 echo "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
             }
             else{
                 $success = true;
                 echo "<p>Successfully created the $tablename table.</p>";
             }
         }
         else{
             $success = true;
             echo "The $tablename table already exists.<br>\n";
         }
         return $success;
     }
 

     if ($formErrorCount === 0) {
         $DBConnect = connectToDB($hostName, $userName, $password);
         if ($DBConnect) {
             if (selectDB($DBConnect, $DBName)) {
                 if (createTable($DBConnect, $tablename)) {
                     echo "<p>Connection successful!</p>\n";
                 }
             }
             mysqli_close($DBConnect);
         }
     }
    ?>
    <?php
        $DBConnect = connectToDB($hostName, $userName, $password);
        if ($DBConnect) {
            if (selectDB($DBConnect, $DBName)) {
                if (createTable($DBConnect, $DBName)) {
                    echo "<p>this is working successful!</p>";
                    echo "<h2>Interview Log</h2>";
                    $sql = "SELECT * FROM $tablename";
                    $result = mysqli_query($DBConnect, $sql);
                    if (mysqli_num_rows($result) == 0) {
                        echo "<p>There are no entries in the Guest</p>";
                    }
                    else {
                        echo "<table width='60%' border='1'>";
                        echo "<tr>";
                        echo "<th>Visitor</th>";
                        echo "<th>First Name</th>";
                        echo "<th>Last Name</th>";
                        echo "</tr>";
                        while ($row = mysqli_fetch_row($result)) {
                            echo "<tr>";
                            echo "<td width='10%' style='text-align: center'>$row[0]</td>";
                            echo "<td>$row[2]</td>";
                            echo "<td>$row[1]</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        mysqli_free_result($result);
                    }
                }
            }
            mysqli_close($DBConnect);
        }

    ?>
</body>
</html>