<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title> 出勤管理システム</title>
<link rel="stylesheet" href="shop.css">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap.css">
</head>
<body>
<h5>
<p class="top">
    <p1 class = "top1">
       <a href="main.php">打刻</a>
    </p1>
    &nbsp &nbsp 
    <p1 class = "top2">
        <a href="">従業員</a>
    </p1>
&nbsp&nbsp
    <p1 class = "top3">
        <a href="staffdata.php">管理人</a>
    </p1>
</p>
<br>
</p>

<br>
</h5>

<?php
  $code = $_GET['code'];
  
  $pdo = new PDO("mysql:dbname=seisaku", "root");
  $st = $pdo->prepare("SELECT * FROM staffdata WHERE passcode=?");
  $st->execute(array($code));
  $row = $st->fetch();
    // $name = htmlspecialchars($row["mail"]);
  // $di = htmlspecialchars($row["mail"]);
  // $mail = htmlspecialchars($row["mail"]);
  // $mail = htmlspecialchars($row["mail"]);
  // $mail = htmlspecialchars($row["mail"]);

  // $mail = htmlspecialchars($row["mail"]);
  // $address=htmlspecialchars($row["address"]);
  // $phone = htmlspecialchars($row["phone"]);
?>
<form action ="user_update2.php" method="post">

<table border="1">
<tr><th>パスコード</th><th>名前</th><th>生年月日</th><th>電話番号</th><th>住所</th><th>入社日</th><th>地位</th><th>時給</th><th>責任手当</th><th>他手当</th><th>交通費</th><th>操作</th></tr>
<tr>
  <td><input type="text" name="passcode" value="<?php echo $code ?>"></td>
  <td><input type="text" name="name" value="<?php echo $row["name"] ?>"></td>
  <td><input type="text" name="datebirth" value="<?php echo $row["datebirth"] ?>"></td>
  <td><input type="text" name="tell" value="<?php echo $row["tell"] ?>"></td>
  <td><input type="text" name="address" value="<?php echo $row["address"] ?>"></td>
  <td><input type="text" name="incomdate" value="<?php echo $row["incomdate"] ?>"></td>
  <td><input type="text" name="chii" value="<?php echo $row["chii"] ?>"></td>
  <td><input type="text" name="jikyuu" value="<?php echo $row["jikyuu"] ?>"></td>
  <td><input type="text" name="sekinin" value="<?php echo $row["sekinin"] ?>"></td>
  <td><input type="text" name="teate" value="<?php echo $row["teate"] ?>"></td>
  <td><input type="text" name="koutsuuhi" value="<?php echo $row["koutsuuhi"] ?>"></td>
  <td><input type="hidden" name="oldcode" value="<?php echo $code ?>">
  <input type="submit"></td>
</tr>
</table>

</form>


<!-- パスコード<br>
    <input type="text" name="passcode" value="<?php echo $code ?>"><br>
  名前<br>
  <input type="text" name="name" value="<?php echo $row["name"] ?>"><br>
    生年月日<br>
    <input type="text" name="datebirth" value="<?php echo $row["datebirth"] ?>"><br>
     電話番号<br>
     <input type="text" name="tell" value="<?php echo $row["tell"] ?>"><br>
    住所<br>
    <input type="text" name="address" value="<?php echo $row["address"] ?>"><br>
    入社日<br>
    <input type="text" name="incomdate" value="<?php echo $row["incomdate"] ?>"><br>
    地位<br>
    <input type="text" name="chii" value="<?php echo $row["chii"] ?>"><br>
    基本時給<br>
    <input type="text" name="jikyuu" value="<?php echo $row["jikyuu"] ?>"><br>
      責任手当<br>
         <input type="text" name="sekinin" value="<?php echo $row["sekinin"] ?>"><br>
      他手当<br>
         <input type="text" name="teate" value="<?php echo $row["teate"] ?>"><br>
      交通費<br>
         <input type="text" name="koutsuuhi" value="<?php echo $row["koutsuuhi"] ?>"><br>
  <input type="hidden" name="oldcode" value="<?php echo $code ?>">
  <input type="submit">
</form> -->
</body>
</html>