<?php 
    session_start();
    session_unset();
    session_destroy();
    setcookie('log', '', time()-3444, '/', null, false, true);
    header('location: ../index.php');
    exit();
?>