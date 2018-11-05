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
    $tableName = "subscribers";
    $subscriberName = "";
    $subscriberEmail = "";
    $showForm = false;
    if (isset($_POST['submit'])) {
        $formErrorCount = 0;
        if (!empty($_POST['subName'])) {
            $subscriberName = stripslashes($_POST['subName']);
            $subscriberName = trim($subscriberName);
            if (strlen($subscriberName) == 0) {
                ++$formErrorCount;
                echo "<p>You must include your " . " <strong>name</strong></p>\n";
            }    
        }
        else{
         ++$formErrorCount;
         echo "<p>Form submittal error, no" . " <strong>Name</strong> field!</p>\n";
        }

    
            if (!empty($_POST['subEmail'])) {
                $subscriberEmail = stripslashes($_POST['subEmail']);
                $subscriberEmail = trim($subscriberEmail);
                if (strlen($subscriberEmail) == 0) {
                    ++$formErrorCount;
                    echo "<p>You must include your " . " <strong>Email</strong></p>\n";
                }    
            }
            else{
             ++$formErrorCount;
             echo "<p>Form submittal error, no" . " <strong>Email</strong> field!</p>\n";
            }
        if ($formErrorCount == 0) {
            $showForm = false;
            $DBConnect = mysqli_connect($hostName, $userName, $password);
                if (!$DBConnect) {
                    echo "<p>Connection error:" . mysqli_connect_error() . "</p>";
                } else {
                 if (mysqli_select_db($DBConnect, $DBName)) {
                    echo "<p>Successfully created the \"$DBName\"" . "database.</p>\n";
                    $subscriberDate = date("Y-m-d");
                    $sql = "INSERT INTO $tableName" . " (name, email, subscribeDate)" . " VALUES ('$subscriberName'," . " '$subscriberEmail'," . " '$subscriberDate')";
                    $result = mysqli_query($DBConnect, $sql);
                 if (!$result) {
                    echo "<p>Unable to insert the values" . " into the <strong>$tableName" . "</strong> table.</p>";
                    echo "<p>Error code <strong>" . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</strong></p>\n";
                 }
                } else {
                    echo "<p>could not create the \"$DBName\"" . "database: " . mysqli_error($DBConnect) . "</p>\n";
                }   
                echo "<p>Closing Database connection</p>\n";
                mysqli_close($DBConnect);
            }
        }else {
            $showForm = true;
        }
        }
        else{
            $showForm = true;
        }
    
    
    if ($showForm) {
    ?>
    <form action="NewsLetterSubscribe.php" method="post">
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