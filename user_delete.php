<?php
  $pdo = new PDO("mysql:dbname=loginmanagement", "root");
  $st = $pdo->prepare("DELETE FROM userdata WHERE name=?");
  $st->execute(array($_GET['name']));
?>
レコードを削除しました。
