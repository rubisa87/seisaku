<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
<title>情報修正</title>
<link rel="stylesheet" href="layout.css" type="text/css" />

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
<?php
  $code = $_GET['code'];
  
  $st = $pdo->prepare("SELECT * FROM staffdata WHERE passcode=?");
  $st->execute(array($code));
  $row = $st->fetch();
?>
<form action ="user_update2.php" method="post">

<table width="100%" border="1">
<tr><th>パスコード</th><th>名前</th><th>生年月日</th><th>電話番号</th><th>住所</th><th>入社日</th><th>地位</th><th>時給</th><th>責任手当</th><th>他手当</th><th>交通費</th><th>操作</th></tr>
<tr>
  <td><input type="text" size ="1" name="passcode" value="<?php echo $code ?>"></td>
  <td ><input type="text" size ="2" name="name" value="<?php echo $row["name"] ?>"></td>
  <td><input type="text" size ="6" name="datebirth" value="<?php echo $row["datebirth"] ?>"></td>
  <td><input type="text" size ="6" name="tell" value="<?php echo $row["tell"] ?>"></td>
  <td><input type="text" size ="" name="address" value="<?php echo $row["address"] ?>"></td>
  <td><input type="text" size ="3" name="incomdate" value="<?php echo $row["incomdate"] ?>"></td>
  <td><input type="text" size ="2" name="chii" value="<?php echo $row["chii"] ?>"></td>
  <td><input type="text" size ="1" name="jikyuu" value="<?php echo $row["jikyuu"] ?>"></td>
  <td><input type="text" size ="2" name="sekinin" value="<?php echo $row["sekinin"] ?>"></td>
  <td><input type="text" size ="1" name="teate" value="<?php echo $row["teate"] ?>"></td>
  <td><input type="text" size ="1" name="koutsuuhi" value="<?php echo $row["koutsuuhi"] ?>"></td>
  <td><input type="hidden" name="oldcode" value="<?php echo $code ?>">
  <input type="submit"></td>
</tr>
</table>

</form>



<!-- ----------------------------------------------- -->
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