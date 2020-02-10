<?php
session_start();
$page=@$_GET['page']; 
    $_SESSION['login']=FALSE;
    $_SESSION['kanri']=FALSE;
if($page=="tenpo"){
session_destroy();
header("Location: index.php");
exit();
}
 header("Location: self_login.php?page=$page");//④ログイン画面へ遷移する。
?>