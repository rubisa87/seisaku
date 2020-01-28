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
require "dbasename.php";

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
      <!-- ------------------------------------ -->
<h2><br>
    従業員情報一覧
    </h2>
<!-- <input  class="shinki radius" type= "submit" name="shinki" value="新規登録"> -->
<form action ="kintai_edit2.php" method="post">

<table border="1" class="table" >
<tr><th>日付</th><th>コード</th><th>氏名</th><th>出勤</th><th>休憩開始</th><th>休憩終了</th><th>退勤</th><th>操作</th></tr>
<?php
 $id = $_GET['id'];
  $st = $pdo->prepare("SELECT * FROM kintaidata WHERE id=?");
  $st->execute(array($id));
  $row = $st->fetch();
?>
  <tr>
  <td><input type="text"  name="date" value="<?php echo $row["date"] ?>"></td>
  <td><input type="text" size ="8" name="passcode" value="<?php echo $row["passcode"] ?>"></td>
  <td><input type="text" name="name" value="<?php echo $row["name"] ?>"></td>
  <td><input type="text" size ="10" name="sk" value="<?php echo $row["sk"] ?>"></td>
  <td><input type="text" size ="10" name="kkks" value="<?php echo $row["kkks"] ?>"></td>
  <td><input type="text" size ="10" name="kksr" value="<?php echo $row["kksr"] ?>"></td>
  <td><input type="text" size ="10" name="tk" value="<?php echo $row["tk"] ?>"></td>
  
  <td><input type="hidden" name="id" value="<?php echo $id ?>">
  <input type="submit" value="確定"></td>
</tr>
</table>

</form>



<!-- ----------------------------------------------- -->
</div>
  </div>


<div class="rightcolumn">
    <div class="card">
      <h2>Menu</h2>
      <li><a href="keisan.php">計算</a></li>
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
