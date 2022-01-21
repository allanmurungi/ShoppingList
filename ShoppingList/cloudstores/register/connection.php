<?php
$dbName="bizplora_shopper";
$user="bizplora_murungi";
$pwd="forgetme100%aws";
$host="localhost";

/*
$dbName="bizplora_shopper";
$user="root";
$pwd="";
$host="localhost";
*/

try{
$conn=new PDO('mysql:host=localhost;dbname=bizplora_shopper',$user,$pwd);

 // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//echo "coonection succesful";

}
catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}

 //$cnn= new mysqli("localhost", "root", "", "allan");

?>