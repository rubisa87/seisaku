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
  <!-- tao hieu ung an noi dung -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script>
  a1=a2=a3=0;
  str="▼";
  function chendau(){
    ++a1;
    if(a1%2==1){
      str="▲";
    }else{
      str="▼";
    }
    document.getElementById('dau1').innerHTML =str;
        document.getElementById('dau2').innerHTML =str;

  }
  function chendau3(){
    ++a2;
    if(a2%2==1){
      str="▲";
    }else{
      str="▼";
    }
    document.getElementById('dau3').innerHTML =str;
        document.getElementById('dau4').innerHTML =str;

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
        <li><a href="kojin.php">個人情報確認</a></li>
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

 if ($_SESSION['login']==False){

    $_SESSION['error2'] ="ログインしてください";
    header("Location: self_login.php?page=self");//④ログイン画面へ遷移する。
} 
  ?>
 <div class="leftcolumn">
    <div class="card">

<br>
<h2 style="color:#ffae6a" id="theme2" onclick="chendau3()">
      <span id ="dau3">▼</span> 出勤実績<span id ="dau4">▼</span>
    </h2>
<table id="cont2" border="1" class="table" >
<tr><th>日付</th><th>出勤</th><th>休憩開始</th><th>休憩終了</th><th>退勤</th></tr>
<?php
$passcode=@$_SESSION['code'];
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
  <br>
  <h2 style="color:#ffae6a" onclick ="chendau()" id="theme3">
      <span id ="dau1">▼</span> メッセージ　<span id ="dau2">▼</span>
    </h2>
<table id="cont3" border="1" class="mess" >
<tr><th style="width:200px">氏名</th><th style="width:150px">時間</th><th style="width:300px">内容</th><th style="width:30px">状態</th></tr>
<?php
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
      <h2>Menu</h2>
      <!-- <div class="fakeimg" style="height:100px;">Image</div> -->
           <li><a href="self.php">勤怠</a></li>
     <li><a href="mess.php">メッセージ</a></li>
<li><a href="kojin.php">個人情報確認</a></li>
<br>
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
<div class="footer">
    <li><a href="#">Contact</a></li>

  Copyright © 2019 Tran Duc Anh - 横浜システム工学院専門学校
</div>

</body>
</html>