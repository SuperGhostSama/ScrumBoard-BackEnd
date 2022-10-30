<?php
$connection=mysqli_connect('localhost', 'root','' , 'youcodescrumboard');
//$con=new mysqli('localhost','root','','youcodescrumboard');
if(!$connection){
    die(mysqli_error($connection)); //used to show connection failed error
}

?>