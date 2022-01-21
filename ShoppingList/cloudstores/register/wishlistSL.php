<?php 
session_start();
//import helper files
include("connection.php");
include("constants.php");
include("utilityfunctions.php");
///wishlist

$mems="";

if(!isset($_SESSION['SN'])){

if( isset($_POST['phone'])){  
    
   
    
$_SESSION['SN']=randomNumber(6);




$_SESSION["uname"] = $_POST['tag'];

$tag = $_POST['tag'];

$_SESSION["u_verified"] = "";

$_SESSION["in_as"] = 'user';
$memmail="";

try{
   
 
   //get users info from database for verification
  
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
  
  
//redirect to login page
header("location:https://www.shoppinglist.com/cloudstores/register/loginSL.php?");


    
}


if( !isset($_POST['tag'])){

//redirect to login page
header("location:https://www.shoppinglist.com/cloudstores/register/loginSL.php?");



}


if(!isset($_SESSION['cart'])){
				
				
			$_SESSION['cart_count'] = 0;
			$_SESSION['cart'] = array();
			$_SESSION['cart_id']=array();
			}


////sec check








//if user already has a wishlist, get it for updating, if not, insert a new one





$reply="";
$flag="0";
//print_r($_FILES['logo']);
//print_r($_POST);
$tag=$_POST['tag'];

if(isset($_POST['adlist'])){

try{
	$tag = $_POST["tag"];   
	$list= str_replace(' ', '', $_POST["list"]); 




if(isset($_POST['web'])){


try{
   
   
   
   $stmt_ll = $conn->prepare("SELECT tag FROM wishlist where tag='$tag' ", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
          
        $row_ll = $stmt_ll->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
         $stmt_ll->execute(); 
          while ($row_ll = $stmt_ll->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))  {
          //    	$data = $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";      
                
                $flag = "1";
       
            } 
            $stmt_ll = null;
   
   
   
    
    
    
}catch(Exception $e){
    

//$reply="sorry an error occured";
    
}


if($flag == "0"){
//echo "here4";
		 $stmt = $conn->prepare("INSERT INTO wishlist (tag,items)
    VALUES (:tag,:items)");
    $stmt->bindParam(':tag', $tag);
    $stmt->bindParam(':items', $list);
   
$stmt->execute();
       
    $reply= "Your wishlist has been uploaded successfully";
 
 
}else {
    
  //  echo "here5-".$tag;
    	$sqlp = "UPDATE wishlist SET items=:newitems WHERE tag=:oldtag" ;

 			$stmtp = $conn->prepare($sqlp);
		
		    // execute the query
		    $stmtp->execute(['newitems'=>$list,'oldtag'=>$tag]); 
    
    
    
    
}
 
 
 

}



unset($_POST['adlist']);
//unset($_FILES);


}catch(Exception $e){

//echo "error: " . $e->getMessage();
 $reply="sorry there was an error uploading the information";
}

}//end of if

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

    <title>Wishlist</title>

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
var imgerr="false";
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

   function images(event){
       var id =event.target.name;
       event.target.width="150";
       event.target.height="150";
       var reply = confirm("Do you wish to remove this image?");
      if (reply==true){
       	var div=document.getElementById("dvPreview");
				div.innerHTML = "";
			var fileinput=document.getElementById("w");
				fileinput.value="";
       var element=document.getElementById(id);
       
       for(var i = 0; i < element.files.length; i++){
           var file=element.files[i];
       if(file.name==event.target.class){       
		
             event.target.src="";
              event.target.hidden="true";
             event.target.width="150";
             event.target.height="150";
	   				 var form = document.getElementById("form");
					  var input = document.createElement("input");
					  input.type="hidden";
					  input.value=file.name;
					  input.name=file.name;
	   				form.appendChild(input);
                                                                
	   }//end of if
	   
  }//loop

      

}
else{
        event.target.width="150";
       event.target.height="150";

}
}  

window.onload = function () {
 var fileuploadw = document.getElementById("w");
    fileuploadw.onchange = function () {
        if (typeof (FileReader) != "undefined") {
            var dvPreview = document.getElementById("dvPreview");
            dvPreview.innerHTML = "";
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            for (var i = 0; i < fileuploadw.files.length; i++) {
                var file = fileuploadw.files[i];
                if (regex.test(file.name.toLowerCase())) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var img = document.createElement("IMG");
                        img.name="w";
                        img.addEventListener("click", images, false);
                        img.class=file.name;                        
						img.id="logo";
                        img.height = "150";
                        img.width = "150";
                        img.src = e.target.result;
                        dvPreview.appendChild(img);                        
				
						var divimage=document.createElement("div");
							divimage.innerHTML = "your memember photo";
							divimage.class="gray";
						dvPreview.appendChild(divimage);      

                    }
                    reader.readAsDataURL(file);
                } else {
                    alert(file.name + " is not a valid image file.");
                    dvPreview.innerHTML = "";
                    imgerr="true";
                    return false;
                }
            }
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }
    }//
}
</script>


</head>

<body class="gray-bg">
  <div class="navbar-wrapper">
      <div class="container">


      </div>
    </div>


    <div class="loginColumns animated fadeInDown">
        <div class="row">

           
            <div class="col-md-6">
                <div class="ibox-content">
      <form class="m-t" enctype="multipart/form-data" role="form" id="oForm" name="myForm" method="post" onsubmit="return validateForm()"  action=<?php echo $_SERVER['PHP_SELF']; ?> >
                                                
					
								 <div class="card" id="dvPreview" align="center">
 					 			
													 
					
					 
								</div> 					

						<br/>
            	<div class="form-group">
                            <b><p>please enter your interests (separated by commas) <?php 
                            
                          //  echo "hiii".$tag;
                            
                            ?></p></b>
                        </div>  
						<div class="form-group">
                            <textarea rows="4" cols="50" class="form-control" pattern="[A-Za-z0-9-@!#$%^&*,./_ ]+" placeholder="list your interests here"  name="list" required="" ><?php
                            
                           echo $mems;
                            
                            
                            ?>
                            
                            </textarea>    
                        </div>                        
                        
						
						
						 
						  
				
					
							<input type="hidden" name="tag" value=<?php  echo $tag; ?> />
							<input type="hidden" name="adlist" value=<?php echo $tag; ?> >
							<input type="hidden" name="web" value=<?php echo $tag; ?> >

                        <button type="submit" name="submit" class="btn btn-primary block full-width m-b">add my items</button>

                       
                    </form>
                    <p class="m-t">
                        <small>SL &copy; <?php echo date('Y')?></small>
                    </p>
                </div>
            </div>
            
            
            
             <div class="col-md-6" align="center">
               
				 <div class="card">
				     <p><?php echo $reply; ?></p>
 					 <img class="cardimg"src="" alt="Avatar" style="width:100%">
					  <div class="gray">
					    <h4><b>SL</b></h4>
					    <p>cloud city</p>
					  </div>  
					
					 
				</div> 

            </div>
            
            
        </div>
        <hr/>
        
    </div>
      <div id="id01" class="modal">
  
  <form  method="post" class="modal-content animate" action="">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
       <img alt="cloudstores" src="images/cloud.png" class="avatar">
    </div>

    <div class="container-fluid">
    <p>  <label><b>Do you wish to register your store or get a cloud store?</b></label></p>    
	<label><b>Register my store/shop</b></label>

      <div class="form-group">
      <input type="radio" value="register" name="register"> register store
      </div>      

      <label><b>Get a cloudstore/shop</b></label>
      <div class="form-group">      

      <input type="radio" value="cloud" name="cloud" > get cloud store      

        </div>        

      <button type="submit" id="submit" class="btn btn-primary block  m-b" >Go</button>
      
    </div>    

  </form>
</div>
      
      <div id="id02" class="modal">
 
  <form class="modal-content animate" action="">
  <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
       <img alt="pond" src="..." class="avatar">
    </div>
    <div class="container-fluid">
      <label><b>Email</b></label>
      <div class="form-group">
      <input type="text" placeholder="Enter Email" name="email" required>

    <label><b>Account Name</b></label>
    <div class="form-group">
      <input type="text" placeholder="Enter account name" name="acc_name" required>
    </div>
      <label><b>Password</b></label>
      <div class="form-group">
      <input type="password" placeholder="Enter Password" name="psw" required>
    </div>
      <label><b>Repeat Password</b></label>
      <div class="form-group">
      <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
      </div>
      <input type="checkbox" checked="checked"> Remember me
      <p>By creating an account you agree to our Terms & Privacy.</p>

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id02').style.display='none'"  class="signup btn btn-primary block  m-b" >Cancel</button>
        <button type="submit"  class="signup btn btn-primary block  m-b" >Sign Up</button>
      </div>
    </div>
  </form>
</div>
      
      
      
      
      
      
        
   <script type='text/javascript'>
// Get the modal
var modal = document.getElementById('id01');

var opt1 = document.getElementById('opt1');
var opt2 = document.getElementById('opt2');
var opt3 = document.getElementById('opt3');
var opt4 = document.getElementById('opt4');
var opt5 = document.getElementById('opt5');



function validateForm() {
    
var imgerr="false";
 var fileuploadw = document.getElementById("w");
   
        if (typeof (FileReader) != "undefined") {
           
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
             if(fileuploadw.files.length<1){
				alert("please upload a photo");
				return false;
			}
            
            for (var i = 0; i < fileuploadw.files.length; i++) {
                var file = fileuploadw.files[i];
                if (regex.test(file.name.toLowerCase())) {
                    
                } else {
                    alert(file.name + " is not a valid image file.");
                  
                    imgerr="true";
                    return false;
                }
            }
        } else {
            alert("This browser does not support HTML5 FileReader.");
            return false;
        }
    return true;
} 

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }    
	if(event.target == opt1){
	
		var search=document.getElementById('maininput');
			search.placeholder="enter street name";

	}
    	if(event.target == opt2){
	
		var search=document.getElementById('maininput');
			search.placeholder="enter mall/building name";

	}
	if(event.target == opt3){
	
		var search=document.getElementById('maininput');
			search.placeholder="enter location name";

	}
	if(event.target == opt4){
	
		var search=document.getElementById('maininput2');
			search.placeholder="enter product name";

	}
	if(event.target == opt5){
	
		var search=document.getElementById('maininput2');
			search.placeholder="enter service name";

	}
    
}
</script>



</body>


</html>
