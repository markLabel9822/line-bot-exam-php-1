<?php




session_start();
require_once("LineLoginLib.php");
 
// กรณีต้องการตรวจสอบการแจ้ง error ให้เปิด 3 บรรทัดล่างนี้ให้ทำงาน กรณีไม่ ให้ comment ปิดไป
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
// กรณีมีการเชื่อมต่อกับฐานข้อมูล
//require_once("dbconnect.php");
 
/// ส่วนการกำหนดค่านี้สามารถทำเป็นไฟล์ include แทนได้
define('LINE_LOGIN_CHANNEL_ID','1627383407');
define('LINE_LOGIN_CHANNEL_SECRET','0fb631952a72d1ea886e56b4433c37f5');
define('LINE_LOGIN_CALLBACK_URL','https://testing9822.herokuapp.com/login_uselib_callback.php');
 
$LineLogin = new LineLoginLib(
    LINE_LOGIN_CHANNEL_ID, LINE_LOGIN_CHANNEL_SECRET, LINE_LOGIN_CALLBACK_URL);
     
if(!isset($_SESSION['ses_login_accToken_val'])){    
    $LineLogin->authorize(); 
    exit;
}
 
$accToken = $_SESSION['ses_login_accToken_val'];
// Status Token Check
if($LineLogin->verifyToken($accToken)){
 
  
}
 
 
// Status Token Check with Result 
//$statusToken = $LineLogin->verifyToken($accToken, true);
//print_r($statusToken);
 
 
//////////////////////////

// GET LINE USERID FROM USER PROFILE
//$userID = $LineLogin->userProfile($accToken);
//echo $userID;
 
//////////////////////////

// GET LINE USER PROFILE 
/*$userInfo = $LineLogin->userProfile($accToken,true);
if(!is_null($userInfo) && is_array($userInfo) && array_key_exists('userId',$userInfo)){
    print_r($userInfo);
}
 
//exit;*/

 
if(isset($_SESSION['ses_login_userData_val']) && $_SESSION['ses_login_userData_val']!=""){
    // GET USER DATA FROM ID TOKEN
    $lineUserData = json_decode($_SESSION['ses_login_userData_val'],true);
   // print_r($lineUserData); 
    //echo "<hr>";
 
    //แสดงชื่่อ UserID
    echo "Line UserID: ".$lineUserData['sub']."<br>";
   
 
}
 
 

if(isset($_SESSION['ses_login_refreshToken_val']) && $_SESSION['ses_login_refreshToken_val']!=""){
   
}
if(isset($_SESSION['ses_login_refreshToken_val']) && $_SESSION['ses_login_refreshToken_val']!=""){
    if(isset($_POST['refreshToken'])){
        $refreshToken = $_SESSION['ses_login_refreshToken_val'];
        $new_accToken = $LineLogin->refreshToken($refreshToken); 
        if(isset($new_accToken) && is_string($new_accToken)){
            $_SESSION['ses_login_accToken_val'] = $new_accToken;
        }       
        $LineLogin->redirect("login_uselib.php");
    }
}
// Revoke Token
//if($LineLogin->revokeToken($accToken)){
//  echo "Logout Line Success<br>";   
//}
//
// Revoke Token with Result
//$statusRevoke = $LineLogin->revokeToken($accToken, true);
//print_r($statusRevoke);
?>




<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Flat Sign Up Form Responsive Widget Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->
<!-- css files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all">
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
<!-- //css files -->
<!-- online-fonts -->
<link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'><link href='//fonts.googleapis.com/css?family=Raleway+Dots' rel='stylesheet' type='text/css'>
</head>
<body>
<!--header-->
    <div class="header-w3l">
        <h1>Valet Parking</h1>
    </div>
<!--//header-->
<!--main-->
<div class="main-agileits">
    <h2 class="sub-head">Register</h2>
        <div class="sub-main">  
            <form action="#" method="post">


<?php 

 echo "Line UserID: ".$lineUserData['sub']."<br>";
<br>
    <br>

?>


                <input placeholder="First Name" name="Name" class="name" type="text" required="">
                    <span class="icon1"><i class="fa fa-user" aria-hidden="true"></i></span><br>
                <input placeholder="Last Name" name="Name" class="name2" type="text" required="">
                    <span class="icon2"><i class="fa fa-user" aria-hidden="true"></i></span><br>
                <input placeholder="Phone Number" name="Number" class="number" type="text" required="">
                    <span class="icon3"><i class="fa fa-phone" aria-hidden="true"></i></span><br>
                <input placeholder="Email" name="mail" class="mail" type="text" required="">
                    <span class="icon4"><i class="fa fa-envelope" aria-hidden="true"></i></span><br>
                <input  placeholder="Password" name="Password" class="pass" type="password" required="">
                    <span class="icon5"><i class="fa fa-unlock" aria-hidden="true"></i></span><br>
                <input  placeholder="Confirm Password" name="Password" class="pass" type="password" required="">
                    <span class="icon6"><i class="fa fa-unlock" aria-hidden="true"></i></span><br>
                
                <input type="submit" value="sign up">
            </form>
        </div>
        <div class="clear"></div>
</div>
<!--//main-->

<!--footer-->
<div class="footer-w3">
    <p>&copy; 2018 Valet Parking . All rights reserved | Design by MarkLabel</a></p>
</div>



<?php
if(isset($_POST['lineLogin'])){
    $LineLogin->authorize(); 
    exit;   
}
if(isset($_POST['lineLogout'])){
    unset(
        $_SESSION['ses_login_accToken_val'],
        $_SESSION['ses_login_refreshToken_val'],
        $_SESSION['ses_login_userData_val']
    );  
    echo "<hr>";
    if($LineLogin->revokeToken($accToken)){
        echo "Logout Line Success<br>";   
    }
   
    $LineLogin->redirect("login_uselib.php");
}



?>

