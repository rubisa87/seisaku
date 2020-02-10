 <!-- function goi($name){ -->
<!-- // echo " -->
<body>

<div class='header'>
  <div style="width:30%;float:right">
    <h1>勤怠管理システム</h1>
  <p>Tran Duc Anh</p>
</div>
<div style="width:60%;float:left">
 <h1>　店舗コード：<?php echo $_SESSION['store_id'] ?><br>
  店舗名：<?php echo $_SESSION['store_name'] ?>
 </h1> 
 </div>
</div>

<div id='menu'>
  <ul>
    <li><a href='main.php'>ホーム</a></li>
    <li><a href='self.php'>各自</a>
      <ul class='sub-menu'>
        <li><a href='self.php'>勤怠データ</a></li>
        <li><a href='kyuuyo.php'>給与明細</a></li>
        <li><a href='kojin.php'>個人情報確認</a></li>
      </ul>
      </li>
    <li><a href='kanri.php'>管理人</a>
      <ul class='sub-menu'>
        <li><a href='kanri.php'>勤怠データ一覧</a></li>
        <li><a href='keisan.php'>給料清算</a></li>
        <li><a href='kojin_ichiran.php'>従業員一覧</a></li>
      </ul>
    </li>
  </ul>
</div>

<div class='row'>