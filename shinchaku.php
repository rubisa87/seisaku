<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
<title>打刻</title>
<link rel="stylesheet" href="layout.css" type="text/css" />
</head>
<!-- <body>

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

<div class="row"> -->


<?php
require "dbasename.php";
require "head.php";
require "popup.php";
?>
  <div class="leftcolumn">
    <div class="card">
<?php
$number=$_GET['number'];

$read = file("$number.php");
    foreach ($read as $line) {
    echo $line;
    }
// switch ($number) {
//    case 'pop1':
//      # code...
//    echo "「QRコード決済導入について」　の詳細内容はありません";
//      break;
//    case 'pop2':
//      # code...
//       echo "「確定申告はもうすぐ締め切りで、早めにしてください」　の詳細内容はありません";
//      break;
//   case 'new':
//      # code...
//       echo "新発売商品　の詳細内容はありません";
//      break;
//   case 'setsumei':
//     # code...
// $read = file('setsumei.txt');
//     foreach ($read as $line) {
//     echo $line;
//      break;
//    default:
//   echo "<h3>記事の詳細細内容はまだありません</h3>";
//      break;
 // }
?>
</div>
 </div>
  <div class="rightcolumn">
    <div class="card">
      <h2>新着情報</h2>
      <!-- <div class="fakeimg" style="height:100px;">Image</div> -->
      <li><a href="shinchaku.php?number=new">新商品が発売</a></li>
      <li><a href="main.php">戻る</a></li>

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
