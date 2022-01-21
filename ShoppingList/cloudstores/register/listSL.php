<?php 
session_start();
//import helper files
include("connection.php");
include("constants.php");
include("utilityfunctions.php");
///wishlist

//check if user is authorized to view this page
if(!isset( $_SESSION["status_go"] )){
 
    //if not authorized, redirect to login page
header("location:https://www.shoppinglist.com/cloudstores/register/loginSL.php?");

}

$mems="";

//get and initialize variables
$tag = "m@m.com";
$_SESSION['phone']="yes";

if(!isset($_SESSION['SN'])){

if( isset($_SESSION['phone'])){  
    
   
    
$_SESSION['SN']=randomNumber(6);




$_SESSION["uname"] = "";



$_SESSION["u_verified"] = "";

$_SESSION["in_as"] = 'user';
$memmail="";

try{
   
 
  //compare and get more user details from database for authentication 
  
   $stmt_ll = $conn->prepare("SELECT email,verified,uname FROM visitors where email='$tag' ", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
          
        $row_ll = $stmt_ll->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
         $stmt_ll->execute(); 
          while ($row_ll = $stmt_ll->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))  {
          //    	$data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";      
                
                
                $memmail=$row_ll[0];
                
               $_SESSION["email"] = $memmail;
               $_SESSION["u_verified"]=$row_ll[1];
         // $tag=$row_ll[2];
          
        
            } 
            $stmt_ll = null;
   
   
   
    
    
    
}catch(Exception $e){
    
//echo $e->getMessage();
$reply="sorry an error occured";
    
}





//pass 
}  else{
  
  
header("location:https://www.shoppinglist.com/cloudstores/register/loginSL.php?");

}
    
}





if(!isset($_SESSION['cart'])){
				
				
			$_SESSION['cart_count'] = 0;
			$_SESSION['cart'] = array();
			$_SESSION['cart_id']=array();
			}


////sec check











//get users' shopping list
$reply="";
$flag="0";
//print_r($_FILES['logo']);
//print_r($_POST);

try {
   //echo "here7"; 
$stmt_l = $conn->prepare("SELECT items FROM wishlist where tag='$tag' ORDER BY id desc", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
          
        $row_l = $stmt_l->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
         $stmt_l->execute(); 
          while ($row_l = $stmt_l->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))  {
          //    	$data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";      
                
                
                $mems= str_replace(' ', '',$row_l[0]);
                
               // $all = explode (",", $mems);
              
                //array_push($all,$mems);
                
          
        
            } 
            $stmt_l = null;
   

}catch(Exception $e){

//echo "error: " . $e->getMessage();
// $reply="sorry there was an error uploading the information";
}


?>

<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.6.2.1/login_two_columns.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Nov 2016 16:04:07 GMT -->
<head>



    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>list</title>

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap-3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap-3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
<style>
body {
    background-image: url("https://www.bizplora.com/images/content/main.jpg");
    
    background-attachment: fixed;
    
    background-repeat: no-repeat;

    overflow-x:hidden;
   
   
   /* Full height */
    height: 100%;

    /* Center and scale the image nicely */
    background-position: center;
    background-size: cover;
}


#maininput {
    width: 400px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-image: url('searchicon.png');
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}

#maininput2 {
    width: 400px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-image: url('searchicon.png');
    background-position: 10px 10px; 
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
}




#maininput:focus {
    width: 100%;
}

#maininput2:focus {
    width: 100%;
}



/* Set a style for all buttons */
#submit {
    
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 75%;
}

#submit:hover {
    opacity: 0.8;
}


.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: left;
    padding-top: 16px;
}
.signup{
    width: 45%;
    margin: 10px;
    
}
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 35%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}

/* Add Zoom Animation */
.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)} 
    to {-webkit-transform: scale(1)}
}
    
@keyframes animatezoom {
    from {transform: scale(0)} 
    to {transform: scale(1)}
}



.card {
    /* Add shadows to create the "card" effect */
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
}

/* On mouse-over, add a deeper shadow */
.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

/* Add some padding inside the card container */
.gray {
    padding: 2px 16px;
}
.cardimg,#logo {
    border-radius: 5px 5px 0 0;
}


.topnav {
  overflow: hidden;
   background-color: #fdb515;
}

.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
  background-color: #fdb515;
}

.topnav a:hover {
  background-color: #fff;
  color: black;
}
.active {
  background-color: #4CAF50;
  color: white;
}

.topnav .icon {
  display: none;
}
.btn{
    
    background-color: #FF9800;
    border-color:  #FF9800;
}
.btn:hover{
    
    background-color: #FF9800;
}
@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}


</style>


<script type='text/javascript'>



</script>


</head>

<body class="gray-bg">
  <div class="navbar-wrapper">
      <div class="container">
<!--new nav -->
<nav class="navbar navbar-inverse navbar-static-top">
<div class="topnav" id="myTopnav">
   <a   href=<?php echo DOMAIN_URL."cloudstores/register/loginSL.php" ?> >home</a>
    <a   href=<?php echo DOMAIN_URL."cloudstores/register/logoutSL.php" ?> >logout</a>         
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">menu
    <i class="fa fa-bars"></i>
  </a>
</div>
     
    </nav>
      </div>
    </div>


    <div class="loginColumns animated fadeInDown">
        <div class="row">

           
            <div class="col-md-6">
                <div class="ibox-content">
                                                
					
								 <div class="card" id="dvPreview" align="center">
 					 			
													 
					
					 
								</div> 					

						<br/>
            	<div class="form-group">
                            <b><p>Shopping List <?php 
                            
                          //  echo "hiii".$tag;
                            
                            ?></p></b>
                        </div>  
						<div class="form-group">
                            <textarea rows="4" cols="50" class="form-control" pattern="[A-Za-z0-9-@!#$%^&*,./_ ]+" readonly  name="list" ><?php
                            
                           echo $mems;
                            
                            
                            ?>
                            
                            </textarea>    
                        </div>                        
                        
						
						
						 
						  
				
					
                    <p class="m-t">
                        <small> SL &copy; <?php echo date('Y')?></small>
                    </p>
                </div>
            </div>
            
            
            
             <div class="col-md-6 " align="center">
               
				 <div class="card ibox-content">
				     <p><?php echo $reply; ?></p>
 					 <img class="cardimg"src="" alt="Avatar" style="width:100%">
					  <div class="gray">
					    <h4><b>SL</b></h4>
					    <p>shoppingList</p>
					  </div>  
					
					 
				</div> 

            </div>
            
            
        </div>
        <hr/>
        
    </div>
      <div id="id01" class="modal">
  
 
</div>
      
      <div id="id02" class="modal">
 
 
</div>
      
      
      
      
      
      
        
   <script type='text/javascript'>
// Get the modal
var modal = document.getElementById('id01');

var opt1 = document.getElementById('opt1');
var opt2 = document.getElementById('opt2');
var opt3 = document.getElementById('opt3');
var opt4 = document.getElementById('opt4');
var opt5 = document.getElementById('opt5');


</script>



</body>


</html>
