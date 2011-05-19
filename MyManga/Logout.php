<?php
    session_start();
    if(isset($_SESSION["UserNickName"]))
    {
        unset ($_SESSION["UserNickName"]);
    }
    header("location:Home.php");
?>
