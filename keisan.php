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
// -----------------lam tron thap phan-------------------
function floorp($val, $precision)
{
    $mult = pow(10, $precision); // Can be cached in lookup table        
    return floor($val * $mult) / $mult;
}
function no0($val){
if ($val==0){
    return "";
  }else{
    return $val;
  }
}

  ?>
 <div class="leftcolumn">
    <div class="card">
<h2><br>
    給料計算実行
    </h2>

<table border="1" class="maintable" >
<tr><th>日付</th><th>コード</th><th>氏名</th><th>勤務時間</th><th>休憩時間</th><th>残業時間</th><th>深夜時間</th><th>一般給料</th><th>残業代</th><th>深夜代</th><th>交通費</th><th>合計</th><th>操作</th></tr>
<?php
  $st = $pdo->query("SELECT * FROM kintaidata ");

  while ($row = $st->fetch()) {

        $id=htmlspecialchars($row['id']);
    $date = htmlspecialchars($row['date']);
    $passcode = htmlspecialchars($row['passcode']);
    $name = htmlspecialchars($row['name']);
    $kyuji = (strtotime($row['kksr'])-strtotime($row['kkks']))/3600;
    $kinji = (strtotime($row['tk'])-strtotime($row['sk']))/3600-$kyuji;
    $zanji=$kinji-8;
    $shinyaji =(strtotime($row['tk'])-strtotime("22:00:00"))/3600;
    if($zanji<0){
$zanji=0;
    }
    if($shinyaji<0){
$shinyaji=0;
    }
$stmt = $pdo->query("SELECT * FROM staffdata where passcode=$passcode");
$staff = $stmt->fetch();
$ippan=$kinji*$staff['jikyuu'];
$zangyoudai=$staff['jikyuu']*$zanji*0.25;
$shinyadai=$shinyaji*$staff['jikyuu']*0.25;
    // $kksr = htmlspecialchars($row['kksr']);
    // $tk = htmlspecialchars($row['tk']);
 //    if($kkks=="00:00:00"){ $kkks="";}
 //   if($kksr=="00:00:00"){ $kksr="";}
 //    if($tk=="00:00:00"){ $tk="";}
 // if($sk=="00:00:00"){ $sk="";}
    // echo "交通費：".$staff['koutsuuhi'];
        // echo "時給：".$staff['jikyuu']."<br>";
$koutsuuhi= $staff['koutsuuhi'];
   //print floorp(49.955, 2);
    $kyuji =floorp($kyuji, 2);
    $kinji = floorp($kinji, 2);
    $zanji=floorp($zanji, 2);
$ippan=floorp($ippan, 0);
$shinyaji=floorp($shinyaji, 2);
$zangyoudai=floorp($zangyoudai, 0);
$shinyadai=floorp($shinyadai, 0);
$nikkyu=no0($koutsuuhi +$ippan+$zangyoudai+$shinyadai);
 echo "<div><tr><th>$date</th><th>$passcode</th><th>$name</th><th>$kinji</th><th>".no0($kyuji)."</th>";
 echo "<th>".no0($zanji)."</th><th>".no0($shinyaji)."</th><th>$ippan</th><th>".no0($zangyoudai)."</th><th>".no0($shinyadai)."</th><th>$koutsuuhi</th><th>$nikkyu</th><th><a href='kintai_edit.php?id=$id '>修正</a></th></tr>";
    // echo "<div><tr><td>$date</td><td><input type='hidden' name='id' value=$id> $passcode</td><td>$name</td><td>$sk</td><td>$kkks</td><td>$kksr</td><td>$tk</td><td><a href='kintai_edit.php?id=$id '>修正</a></td></tr>";

  }
?>
</table>
</div>
</div>
<div class="rightcolumn">
    <div class="card">
      <h2>Menu</h2>
      <!-- <div class="fakeimg" style="height:100px;">Image</div> -->
      <li><a href="keisan.php">計算</a></li>
      <li><a href="logout.php?page=self">ログアウト</a></li>

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
</div>
<div class="footer">
    <li><a href="#">Contact</a></li>

  Copyright © 2019 Tran Duc Anh - 横浜システム工学院専門学校
</div>
    </body>
</html>
<!-- diff_hour = (strtotime($date2) - strtotime($date1)) / 3600; -->