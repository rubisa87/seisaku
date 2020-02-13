<?php 
// PHP_SESSION_NONE 
if(session_status()==1){
session_start();
}
if (!isset($_SESSION['store_id'])){
     header("Location: index.php");
        exit();
}

$pdo = new PDO("mysql:dbname=seisaku;charset=utf8", "root");
    // $pdo = new PDO("mysql:dbname=b13_24945452_seisaku;host=sql304.byethost.com;charset=utf8", "b13_24945452","NFky0561");
// $pdo->exec("SET time_zone ='+09:00'");
// -------------------------↓↓↓↓↓↓↓↓↓settime zone↓↓↓↓↓↓↓↓↓↓↓ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
// $tz = (new DateTime('now', new DateTimeZone('Asia/Kabul')))->format('P');
// $pdo->exec("SET time_zone='$tz';");
// -------------------------↑↑↑↑↑↑↑↑↑↑↑↑↑↑settime zone↑↑↑↑↑↑↑↑↑↑↑↑↑↑ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー

    ?>
    <link rel="shortcut icon" type="image/x-icon" href="icon.png">
