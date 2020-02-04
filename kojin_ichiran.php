<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
<title>打刻</title>
<!-- <link rel="stylesheet" href="menu.css" type="text/css" /> -->
<link rel="stylesheet" href="layout.css" type="text/css" />
<!-- <link rel="stylesheet" href="shop.css"> -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


</head>
<body>

<div class="header">
  <h1>勤怠管理システム</h1>
  <p>Tran Duc Anh</p>
</div>

<div id="menu">
  <ul>
    <li><a href="main.php">ホーム</a></li>
    <li><a href="self.php">各自</a>
      <ul class="sub-menu">
        <li><a href="#">勤怠データ</a></li>
        <li><a href="#">給料</a></li>
        <li><a href="#">個人情報確認</a></li>
      </ul>
      </li>
    <li><a href="kanri.php">管理人</a>
      <ul class="sub-menu">
        <li><a href="#">勤怠データ一覧</a></li>
        <li><a href="#">給料清算</a></li>
        <li><a href="#">個人情報</a></li>
      </ul>
    </li>
  </ul>
</div>

<div class="row">

<?php
require "dbasename.php";
require "popup.php";

 if ($_SESSION['kanri']==False){
    //③SESSIONの「error2」に「ログインしてください」と設定する。
    //④ログイン画面へ遷移する。
// }
    $_SESSION['error2'] ="ログインしてください";
    header("Location: self_login.php?page=kanri");//④ログイン画面へ遷移する。
} 
  ?>
 <div class="leftcolumn">
    <div class="card">
<h2><br>
    従業員情報一覧
    </h2>
    <!-- <input  class="shinki radius" type= "submit" name="shinki" value="新規登録"> -->
<table border="1" class="maintable">
<tr><th>パスコード</th><th>名前</th><th>生年月日</th><th>電話番号</th><th>住所</th><th>入社日</th><th>地位</th><th>時給</th><th>責任手当</th><th>他手当</th><th>交通費</th><th>操作</th></tr>
<?php

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
$passcode1=$passcode+1;
    echo "<tr><td>$passcode</td><td>$name</td><td>$datebirth</td><td>$tell</td><td>$address</td><td>$incomdate</td><td>$chii</td><td>$jikyuu</td><td>$sekinin</td><td>$teate</td><td>$koutsuuhi</td><td><a href='user_update.php?code=$passcode '>修正</a></td></tr>
";

    // echo "<tr><td>$id</td><td>$name </td><td>$mail </td><td>$address </td><td>$phone </td><td><a href='user_update.php?name=$name '>修正</a><a href='user_delete.php?name=$name' onclick=\"return confirm('Mày định xoá thật à??')\">削除</a></td></tr>";
  }
  if(isset($_POST['shinki'])){
echo "<form><tr><td><input type='text' style='width:80px' name='passcode' placeholder='' value='$passcode1' disabled></td>
<td><input type='text' style='width:80px' name='name' placeholder='名前' value=''></td>
<td><input type='text' style='width:80px' name='datebirth' placeholder='年ー月ー日' value=''></td>
<td><input type='text' style='width:80px' name='tell' placeholder='電話番号' value=''></td>
<td><input type='text' style='width:180px' name='address' placeholder='住所' value=''></td>
<td><input type='text' style='width:80px' name='incomdate' placeholder='年ー月ー日' value=''></td>
<td><input type='text' style='width:80px' name='chii' placeholder='地位' value=''></td>
<td><input type='text' size='2' name='jikyuu' placeholder='時給' value=''></td>
<td><input type='text' size='2' name='sekinin' placeholder='責任手当' value='0'></td>
<td><input type='text' size='2' name='teate' placeholder='手当' value='0'></td>
<td><input type='text' size='2' name='koutsuuhi' placeholder='交通費' value='0'></td>
<td><input type='text' size='2' name='password' placeholder='password' value=''></td>

</tr>"; 
echo "<tr><td><button type = 'submit' formmethod='POST' name ='touroku' >登録</button></tr></form>";
 }else{
  echo "<form><tr><td><button type = 'submit' formmethod='POST' name ='shinki' >新規</button></form></tr></form>";

 }
 if(isset($_POST['touroku'])){
echo "lay dc nut dki...............";
echo $_POST['name'];//=====================den doan nay, con lai lam not phan ket noi dbs va chay lai trang=====
echo $_POST['datebirth'];
echo $_POST['tell'];
echo $_POST['address'];
echo $_POST['incomdate'];
echo $_POST['chii'];
echo $_POST['jikyuu'];
echo $_POST['sekinin'];
echo $_POST['teate'];
echo $_POST['koutsuuhi'];
$stmt = $pdo->prepare("INSERT INTO staffdata(name, datebirth, tell, address,incomdate,chii,jikyuu,sekinin,teate,koutsuuhi,password) VALUES (?,?,?,?,?,?,?,?,?,?,?)");

            $stmt->execute(array($_POST['name'],$_POST['datebirth'],$_POST['tell'],$_POST['address'],$_POST['incomdate'],$_POST['chii'],$_POST['jikyuu'],$_POST['sekinin'],$_POST['teate'],$_POST['koutsuuhi'],$_POST['password']));

 }
  
?>

</table>
</div>
  </div>
<div class="rightcolumn">
    <div class="card">
      <h2>Menu</h2>
      <li><a href="keisan.php">計算</a></li>
      <li><a href="kojin_ichiran.php">個人情報一覧、登録</a></li>
      <br><li><a href="logout.php?page=kanri">ログアウト</a></li>

    </div>
    <div class="card">
      <h3>Popular Post</h3>
      <div class="fakeimg"><p>Image</p></div>
      <div class="fakeimg"><p>Image</p></div>
      <div class="fakeimg"><p>Image</p></div>
    </div>
    <div class="card">
      <h3>Follow Me</h3>
      <p>Some text..</p>
    </div>
  </div>
</div>
<div class="footer">
    <li><a href="#">Contact</a></li>

  Copyright © 2019 Tran Duc Anh - 横浜システム工学院専門学校
</div>

</body>
</html>

<!-- style="width:300px" -->