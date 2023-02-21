<?php
    session_start();
    unset($_SESSION["loginHome"]);
    unset($_SESSION["cart"]);
    header("location:index.php");
?>