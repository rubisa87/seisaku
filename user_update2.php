<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="uft-8">
<meta http-equiv="refresh" content="2;URL=kanri.php">
<title>出勤管理</title>
</head>
<body>
<!-- <p><a href="move/newpage.html">移転先のページ</a></p> -->



<?php
require "dbasename.php";
  $st = $pdo->prepare("UPDATE staffdata SET passcode=?, name=?, datebirth=?, tell=?, address=?, incomdate=?, chii=?, jikyuu=?, sekinin=?, teate=?, koutsuuhi=?  WHERE passcode=?");
  $st->execute(array($_POST['passcode'],$_POST['name'], $_POST['datebirth'],$_POST['tell'],$_POST['address'],$_POST['incomdate'],$_POST['chii'],$_POST['jikyuu'],$_POST['sekinin'],$_POST['teate'],$_POST['koutsuuhi'],$_POST['oldcode']));
require "kanri.php"; 
echo "情報を修せしました。"
?>

</body>
</html>