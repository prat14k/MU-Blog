<?php require('connection.php');
session_start();



if ( (isset($_POST['name'])) and (!empty($_POST['name'])) and (isset($_POST['pass'])) and (!empty($_POST['pass'])) and(isset($_POST['email'])) and (!empty($_POST['email'])) and (isset($_POST['username'])) and (!empty($_POST['username'])) and (isset($_POST['gender'])) and (!empty($_POST['gender'])) and (isset($_FILES['files']['name']))/* and (!empty($_FILES['files']['name'])) and (isset($_POST['mobile'])) and (!empty($_POST['mobile']))*/ ){
//3.1.1 Assigning posted values to variables.

     $username = mysql_real_escape_string(htmlentities(strip_tags($_POST['username'])));
     $password = mysql_real_escape_string(htmlentities(strip_tags($_POST['pass'])));
     $email = mysql_real_escape_string(htmlentities(strip_tags($_POST['email'])));
     $name = mysql_real_escape_string(htmlentities(strip_tags($_POST['name'])));
    $gender = mysql_real_escape_string(htmlentities(strip_tags($_POST['gender'])));
    // $blogname = mysql_real_escape_string(htmlentities(strip_tags($_POST['blogname'])));
     $mobile = mysql_real_escape_string(htmlentities(strip_tags($_POST['mobile'])));
       // $profilepic = $_FILES['files']['name'];
            
                    
$target_dir = "profile_pic/";
$target_file = $target_dir . basename($_FILES["files"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
//if(isset($_POST["submit"])) {
    echo "in submit";
    //die();
    $check = getimagesize($_FILES["files"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
//}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["files"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["files"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["files"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


            $profile_pic=$_FILES["files"]["name"];
                $d = date("Y-m-d H:i:s");
                // $pic=$location.$namee;
                $query = "Insert into users values(NULL,'$username','$name','$email','$password','$profile_pic','$d','$mobile','$gender')";    
                    if($result = mysql_query($query)) 
                    {
                    //3.1.2 If the posted values are equal to the database values, then session will be created for the user.
                        $location="index.php";
                      
                        header("Location: ".$location);
                    }
                    else{
                echo $query;
                die();
                        header("Location: index.php?val=1");
                
            }                        
      
        } 
        else
            header("Location: index.php?val=1");
                        

    
    

?>
    