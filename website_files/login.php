<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Post - Start Bootstrap Template</title>
<?php require('connection.php');?>

    <!-- Bootstrap Core CSS -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<?php
session_start();
$val=1;

//3. If the form is submitted or not.

//3.1 If the form is submitted

if ((isset($_POST['uid'])) and (isset($_POST['pass'])) and (!empty($_POST['uid'])) and (!empty($_POST['pass']))){
//3.1.1 Assigning posted values to variables.
    $username = mysql_real_escape_string(htmlentities(strip_tags($_POST['uid'])));
    $password = mysql_real_escape_string(htmlentities(strip_tags($_POST['pass'])));

    $count = 0;
    //3.1.2 Checking the values are existing in the database or not
    $query = "SELECT * FROM users WHERE username='$username' and password='$password'";    
    $result = mysql_query($query) or die(mysql_error());

    $count = mysql_num_rows($result);

//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
    if ($count == 1){
        $rrr = mysql_fetch_array($result);
        $_SESSION['username'] = $username;
        $_SESSION['userid']=$rrr['userid'];
        $location="wall.php?authorid=".$_SESSION['userid'];
        header("Location: ".$location);

    }
    else{

        //3.1.3 If the login credentials doesn't match, he will be shown with an error message.
        header("Location: index.php?val=1");
    }

}

?>
    <!-- Navigation -->
</body>
</html>