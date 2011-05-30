<?php
    session_start();
    if(isset($_SESSION['Nickname']))
    {
        unset($_SESSION['Nickname']);
    }
    header("location:Home.php");
?>

