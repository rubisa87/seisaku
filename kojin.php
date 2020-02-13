<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
<title>個人情報ー勤怠管理</title>
<link rel="stylesheet" href="layout.css" type="text/css" />
  <script>
  a1=a2=a3=0;
  str="\\\/";
  function chendau(){
    ++a1;
    if(a1%2==1){
      str="\/\\";
    }else{
      str="\\\/";
    }
    document.getElementById('dau').innerHTML =str;
  }
// ---------------------cách 2 la đây ↓↓↓↓↓↓↓↓↓↓↓ーーーーーーーーーーーーーー
$(document).ready(function(){

      $("#theme1").click(function(){
        $("#cont1").toggle();
       
    });
      $("#theme2").click(function(){
        $("#cont2").toggle();
       
    });
      $("#theme3").click(function(){
        $("#cont3").toggle();
       
    });
});
// ーーーーーーーーーーーーーーーーーーーーーーーーcách 2 chỉ từng nàyy↑↑↑↑↑↑↑↑↑↑---------------------------
</script>


</head>

<?php
require "dbasename.php";
require "head.php";
require "popup.php";

 if ($_SESSION['login']==False){
    //③SESSIONの「error2」に「ログインしてください」と設定する。
    //④ログイン画面へ遷移する。
// }
    $_SESSION['error2'] ="ログインしてください";
    header("Location: self_login.php?page=self");//④ログイン画面へ遷移する。
} 
  ?>
 <div class="leftcolumn">
    <div class="card">
<h2 style="color:#ffae6a" id = "theme1" onclick="">
    ⇋　個人情報確認　⇋<br><span id ="dau"></span>
    </h2>
<table border="1" id ="cont1" class="maintable" >
<tr><th>パスコード</th><th>名前</th><th>生年月日</th><th>電話番号</th><th>住所</th><th>入社日</th><th>地位</th><th>時給</th><th>責任手当</th><th>他手当</th><th>交通費</th></tr>
<?php
$passcode=@$_SESSION['code'];
   $stmt = $pdo->prepare('SELECT * FROM staffdata WHERE passcode = ?');
            $stmt->execute(array($passcode));
  //$st = $pdo->query("SELECT * FROM staffdata where passcode =$passcode");
  while ($row = $stmt->fetch()) {
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

    echo "<tr><td>$passcode</td><td>$name</td><td>$datebirth</td><td>$tell</td><td>$address</td><td>$incomdate</td><td>$chii</td><td>$jikyuu</td><td>$sekinin</td><td>$teate</td><td>$koutsuuhi</td></tr>
";

    // echo "<tr><td>$id</td><td>$name </td><td>$mail </td><td>$address </td><td>$phone </td><td><a href='user_update.php?name=$name '>修正</a><a href='user_delete.php?name=$name' onclick=\"return confirm('Mày định xoá thật à??')\">削除</a></td></tr>";
  }
  
?>

</table>

</div>
  </div>
<?php require "rightcolumn_self.php";?>

</div>
<div class="footer">
    <li><a href="#">Contact</a></li>

  Copyright © 2019 Tran Duc Anh - 横浜システム工学院専門学校
</div>

</body>
</html>