<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title> 出勤管理システム</title>
<link rel="stylesheet" href="shop.css">
    <!-- <link rel="stylesheet" type="text/css" href="vendor/bootstrap.css"> -->
</head>
<body>
<!-- <h5> -->
<p class="top">
    <p1 class = "top1">
       <a href="main.php">打刻</a>
    </p1>
    &nbsp &nbsp 
    <p1 class = "top2">
        <a href="self.php">従業員</a>
    </p1>
&nbsp&nbsp
    <p1 class = "top3">
        <a href="staffdata.php">管理人</a>
    </p1>
</p>
<br>
</p>

<!-- </h5> -->
<h2><br>
    従業員情報一覧
    </h2>
    <p>
<input  class="shinki radius" type= "submit" name="shinki" value="新規登録">
 </p>
<table border="1">
<br>
<tr><th>パスコード</th><th>名前</th><th>生年月日</th><th>電話番号</th><th>住所</th><th>入社日</th><th>地位</th><th>時給</th><th>責任手当</th><th>他手当</th><th>交通費</th><th>操作</th></tr>
<?php
  $pdo = new PDO("mysql:dbname=seisaku", "root");
  $st = $pdo->query("SELECT * FROM staffdata");
  while ($row = $st->fetch()) {
    $passcode = htmlspecialchars($row['passcode']);
    $name = htmlspecialchars($row['name']);
    $datebirth = htmlspecialchars($row['datebirth']);
    $tell = htmlspecialchars($row['tell']);
    $address = htmlspecialchars($row['address']);
    $incomdate = htmlspecialchars($row['incomdate']);
    $chii = htmlspecialchars($row['chii']);
    $jikyuu = htmlspecialchars($row['jikyuu']);
    $sekinin = htmlspecialchars($row['sekinin']);
    $teate = htmlspecialchars($row['teate']);
    $koutsuuhi = htmlspecialchars($row['koutsuuhi']);

    echo "<tr><td>$passcode</td><td>$name</td><td>$datebirth</td><td>$tell</td><td>$address</td><td>$incomdate</td><td>$chii</td><td>$jikyuu</td><td>$sekinin</td><td>$teate</td><td>$koutsuuhi</td><td><a href='user_update.php?code=$passcode '>修正</a></td></tr>
";

    // echo "<tr><td>$id</td><td>$name </td><td>$mail </td><td>$address </td><td>$phone </td><td><a href='user_update.php?name=$name '>修正</a><a href='user_delete.php?name=$name' onclick=\"return confirm('Mày định xoá thật à??')\">削除</a></td></tr>";
  }
  
?>
</table>
</body>
</html>