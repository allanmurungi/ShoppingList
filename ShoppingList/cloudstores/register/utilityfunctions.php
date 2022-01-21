<?php

//declare necessary variables
$dbName="shopper";
$user="shoppinglist";
$pwd="admin";
$host="localhost"; 


//create existance of table in databasa

function check_table($tab){
    
    $dbName="shopper";
$user="shoppinglist";
$pwd="admin";
$host="localhost"; 

   $connair=mysqli_connect($host,$user,$pwd,$dbName);
   
    
    
    $tab2=$tab."_projects";
    
    $val = mysqli_query($connair,'select 1 from `'.$tab.'`');
    $val2 = mysqli_query($connair,'select 1 from `'.$tab2.'`');
    
    if($val !== FALSE || $val2 !== FALSE)
    {
       return "true";
    }else{
       return "false";
    }
    
    
    }
    
 

/////////////////////////
///////////////////////// create unique random number

function randomNumber($length) {
    $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}
//////////////////////
/////////////////////create unique random string
function randomString($length = 6) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}











?>