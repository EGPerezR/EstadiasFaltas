<?php
session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>


    <h1>En proceso</h1>
   <br />
    <a href='index.php'>Return</a>
 

<!--
<h2>Enter the Email of Your Account to Reset New Password</h2>

<div class="container">
    <div class="regisFrm">
        <form action="Controllers/backcontra.php" method="post">
            <input type="email" name="correo" placeholder="EMAIL" required="">
            <div class="send-button">
                <input type="submit" value="CONTINUE">
            </div>
        </form>-->
    </div>
</div>