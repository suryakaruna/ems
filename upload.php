<?php

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp'); // valid extensions
$path = 'uploads/'; // upload directory
if(!empty($_POST['eve']) || $_FILES['image'])
{
$eve = $_POST['eve'];
$img = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];
// get uploaded file's extension
$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
// can upload same image using rand function
$final_image = rand(1000,1000000).$img;
if(in_array($ext, $valid_extensions)) 
{ 
$path = $path.strtolower($img); 
if(move_uploaded_file($tmp,$path)) 
{
require 'api/db.php';
//insert form data in the database
$insert = $conn->query("UPDATE event SET banner='$path' WHERE id='$eve'");    
echo $insert?"<img src='$path' alt='$eve' />":"err".$insert;

}
} 
else 
{
echo 'invalid';
}
}

?>