<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
<title>管理ー勤怠管理</title>
<link rel="stylesheet" href="layout.css" type="text/css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script><!-- tao hieu ung an noi dung -->

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

<?php
require "dbasename.php";
require "head.php";
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
     <div id="error"> <?php echo @$_GET['name']; ?> </div>

<h2 style="color:#ffae6a" onclick ="chendau()" id ="theme2">
      <span id ="dau1">▼</span> 出勤実績<span id ="dau2">▼</span>
    </h2>
    <?php
$m=False;
// --------------------日付による検索ーーーーーーーーーーーーーーーーーーーーーー
    if(!isset($_POST["datesearch"])){

  $st = $pdo->query("SELECT * FROM kintaidata ");
}else{
if(!@$_POST["kara"]||!@$_POST["made"]){
$st = $pdo->query("SELECT * FROM kintaidata ");
}else{
  $m=True;
$kara =$_POST["kara"];
$made =$_POST["made"];
$st = $pdo->prepare("SELECT * FROM kintaidata WHERE date>=? AND date<=?");
$st->execute(array($kara,$made));
}
}
    if($m==True){
    echo "<p><br>".$kara."から";
echo $made."まで</P>";}
// --------------------日付による検索ー↑↑↑↑↑↑↑↑↑↑ーーーーーーーーーーーーーーーーーーーーー

    ?>
    
      <form method="POST">
        <!-- 参照:<input type="date" id="datepicker1" name="kara">から<input type="date" id="datepicker2" name="made">まで <input type="submit" name="datesearch" value="検索"> -->
        参照:<input type="date"  name="kara">から<input type="date" name="made">まで <input type="submit" name="datesearch" value="検索"></form>

<table border="1" class="table" id="cont2">
<tr><th>日付</th><th>コード</th><th>氏名</th><th>出勤</th><th>休憩開始</th><th>休憩終了</th><th>退勤</th><th>操作</th></tr>
<?php
 

  while ($row = $st->fetch()) {

        $id=htmlspecialchars($row['id']);
    $date = htmlspecialchars($row['date']);
    $passcode = htmlspecialchars($row['passcode']);
    $name = htmlspecialchars($row['name']);
    $sk = htmlspecialchars($row['sk']);
    $kkks = htmlspecialchars($row['kkks']);
    $kksr = htmlspecialchars($row['kksr']);
    $tk = htmlspecialchars($row['tk']);
    if($kkks=="00:00:00"){ $kkks="";}
   if($kksr=="00:00:00"){ $kksr="";}
    if($tk=="00:00:00"){ $tk="";}
 if($sk=="00:00:00"){ $sk="";}
   

    echo "<div><tr><td>$date</td><td><input type='hidden' name='id' value=$id> $passcode</td><td>$name</td><td>$sk</td><td>$kkks</td><td>$kksr</td><td>$tk</td><td><a href='kintai_edit.php?id=$id '>修正</a></td></tr>
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
  <h2 style="color:#ffae6a" onclick ="chendau3()" id ="theme3">
      <span id ="dau3">▼</span> メッセージ<span id ="dau4">▼</span>
    </h2>
<table id="cont3" border="1" class="mess">
<tr><th style="width:200px">氏名</th><th style="width:150px">時間</th><th style="width:300px">内容</th><th style="width:30px">状態</th></tr>
<?php
   $stmt = $pdo->query("SELECT * FROM messenger WHERE tousercode=3");
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
<td><input type="hidden" name="from" value="<?php echo "3";  ?>">
  <!-- <input type="hidden" name="code" value="<?php echo $code;  ?>"> --></td>
<td><textarea rows="3" cols="40" name="content">
</textarea></td>
<td><button type = 'submit' formmethod='POST' name ='soushin' >送信</button></td></form>
</tr>
</table>
</div>
  </div>
<?php require "rightcolumn_kanri.php";?>

</div>
<div class="footer">
    <li><a href="#">Contact</a></li>

  Copyright © 2019 Tran Duc Anh - 横浜システム工学院専門学校
</div>

</body>
</html>

<!-- style="width:300px" -->