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
<?php

if($LineLogin->verifyToken($accToken)){
?>

<?php }else{ ?>





 
<?php } ?>
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
   
    if($LineLogin->revokeToken($accToken)){
         
    }
  
    $LineLogin->redirect("login_uselib.php");
}
?>
