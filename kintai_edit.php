<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
<title>管理ー勤怠管理</title>
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


<?php require "rightcolumn_kanri.php";?>

</div>
<div class="footer">
    <li><a href="#">Contact</a></li>

  Copyright © 2019 Tran Duc Anh - 横浜システム工学院専門学校
</div>

</body>
</html>

<!-- style="width:300px" -->
