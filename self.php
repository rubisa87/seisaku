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
  <table width="100%" background="" height="40px" />
<tr>
<td valign="top" >
<div style="width:1230px;height:28px;font-size:16px;font-family:Arial;float:right;padding-top:9px;padding-right:25px;">
<marquee onmouseover=this.stop() onmouseout=this.start() scrolldelay="50" scrollamount="5">
<strong>
<a href="/Đường dẫn tới thông báo của bạn" style="color:#fb4ca7">  今週の木曜日（１２日）二俣川サンハートで第２回発表があります</a> 

<a href="/Đường dẫn tới thông báo của bạn" style="color:#ff0">    2月４日最終発表会が行われます  </a>  
</strong>
</marquee>
</div>
</td></tr>
</table>
<?php
session_start();
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
<table border="1" class="maintable" >
<tr><th>パスコード</th><th>名前</th><th>生年月日</th><th>電話番号</th><th>住所</th><th>入社日</th><th>地位</th><th>時給</th><th>責任手当</th><th>他手当</th><th>交通費</th></tr>
<?php
$passcode=@$_SESSION['code'];
  $pdo = new PDO("mysql:dbname=seisaku", "root");
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
<h2><br>
    出勤実績   
    </h2>
<table border="1" class="table" >
<tr><th>日付</th><th>出勤</th><th>休憩開始</th><th>休憩終了</th><th>退勤</th></tr>
<?php
  $pdo = new PDO("mysql:dbname=seisaku", "root");
   // $stmt = $pdo->prepare('SELECT * FROM kintaidata WHERE passcode = ?');
            // $stmt->execute(array($passcode));
 $stmt = $pdo->query("SELECT * FROM kintaidata where passcode= $passcode");
  while ($row = $stmt->fetch()) {
    $date = htmlspecialchars($row['date']);
    $sk = htmlspecialchars($row['sk']);
    $kkks = htmlspecialchars($row['kkks']);
    $kksr = htmlspecialchars($row['kksr']);
    $tk = htmlspecialchars($row['tk']);
    if($kkks=="00:00:00"){ $kkks="";}
   if($kksr=="00:00:00"){ $kksr="";}
    if($tk=="00:00:00"){ $tk="";}
 if($sk=="00:00:00"){ $sk="";}
   

    echo "<tr><td>$date</td><td>$sk</td><td>$kkks</td><td>$kksr</td><td>$tk</td></tr>
";

    // echo "<tr><td>$id</td><td>$name </td><td>$mail </td><td>$address </td><td>$phone </td><td><a href='user_update.php?name=$name '>修正</a><a href='user_delete.php?name=$name' onclick=\"return confirm('Mày định xoá thật à??')\">削除</a></td></tr>";
  }
  
?>
</table>
<?php 
if(isset($_POST['soushin'])){
$from=$_POST['from'];
  $content=$_POST['content'];
  $name=$_POST['name'];
    echo "from:".$from;
  echo "<br>content:".$content;
$st = $pdo->prepare("SELECT * FROM staffdata where name =?");
$st->execute(array($name));
$row = $st->fetch();
$to=$row['passcode'];
echo "<br>to:".$to;
$stmt = $pdo->prepare("INSERT INTO messenger(fromusercode, tousercode, content, status) VALUES (?,?,?,'未読')");

            $stmt->execute(array($from,$to,$content));

}


  ?>
<table border="1" class="mess" >
<tr><th>氏名</th><th>時間</th><th style="width:300px">内容</th><th style="width:30px">状態</th></tr>
<?php
  $pdo = new PDO("mysql:dbname=seisaku", "root");
   $stmt = $pdo->query("SELECT * FROM messenger WHERE tousercode=$passcode");
            // $stmt->execute(array($passcode));
 // $st = $pdo->query("SELECT * FROM kintaidata where passcode= $passcode");
  while ($row = $stmt->fetch()) {
    $id = htmlspecialchars($row['id']);
    $fromu = htmlspecialchars($row['fromusercode']);
    $content = htmlspecialchars($row['content']);
    $time = htmlspecialchars($row['time']);
    $status = htmlspecialchars($row['status']);
$ndb = $pdo->query("SELECT * FROM staffdata WHERE passcode= $fromu");
    $a =$ndb->fetch();


     echo "<tr><td>".$a['name']."</td><td>$time</td><td>$content</td><td>$status</td></tr>";

  }
  
?>
<tr><form method="post">
<td><select name="name" style ="font-size: 9px"
>
            <?php
$pdo = new PDO("mysql:dbname=seisaku", "root");
   $stmt = $pdo->query("SELECT * FROM staffdata");
while ($row = $stmt->fetch()) {
  $code=$row['passcode'];
  $name=$row['name'];
                echo "<option>$name</option>";
                // echo "<input type='hidden' name='code' value=".$code.">";
              }
            ?>
          </select></td>
<td><input type="hidden" name="from" value="<?php echo $_SESSION['code'];  ?>">
  <!-- <input type="hidden" name="code" value="<?php echo $code;  ?>"> --></td>
<td><textarea rows="3" cols="40" name="content">
</textarea></td>
<td><button type = 'submit' formmethod='POST' name ='soushin' >送信</button></td></form>
</tr>
</table>
</div>
  </div>
<div class="rightcolumn">
    <div class="card">
      <h2>新着情報</h2>
      <!-- <div class="fakeimg" style="height:100px;">Image</div> -->
      <li><a>新商品が発売</a></li>
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