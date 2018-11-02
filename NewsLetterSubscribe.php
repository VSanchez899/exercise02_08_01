<!DOCTYPE html>
<html lang="en">
    <head>
        <title>News Letter subscribe</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    <h2>News Letter subscribe</h2>
    <?php
    $hostName = "localhost";
    $userName = "adminer";
    $password = "judge-quick-25";
    $DBName = "newsletter1";
    $TableName = "subscribers";
    $subscriberName = "";
    $subscriberEmail = "";
    $showForm = false;
    if (isset($_POST['submit'])) {
        $formErrorCount = 0;
        $DBConnect = mysqli_connect($hostName, $userName, $password);
        if (!$DBConnect) {
        echo "<p>Connection error:" . mysqli_connect_error() . "</p>";
        } else {
        
        if (mysqli_select_db($DBConnect, $DBName)) {
            echo "<p>Successfully created the \"$DBName\"" . "database.</p>\n";
            
        } else {
            echo "<p>could not create the \"$DBName\"" . "database: " . mysqli_error($DBConnect) . "</p>\n";
        }   
        echo "<p>Closing Database connection</p>\n";
        mysqli_close($DBConnect);
        }
    } else {
        $showForm = true;
    }
    
    
    if ($showForm) {
    ?>
    <form action="NewsletterSubscribe.php" method="post">
        <p>
            <strong>Your name: </strong><br>
            <input type="text" name="subName" value="<?php echo $subscriberName; ?>">
        </p>

        <p>
            <strong>Your Email Address: </strong><br>
            <input type="Email" name="subEmail" value="<?php echo $subscriberEmail; ?>">
        </p>

        <p>
            <input type="submit" name="submit" value="Submit">

        </p>

    </form>
    </body>
    <?php
    }
    ?>
</html>