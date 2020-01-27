<?php
session_start();
$page=@$_GET['page']; 
    session_destroy();
 header("Location: self_login.php?page=$page");//④ログイン画面へ遷移する。
?>