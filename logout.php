<?php
session_start();
    session_destroy();
    require "main.php"; 
    exit();
?>