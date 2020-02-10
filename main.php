<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
<title>打刻</title>
<link rel="stylesheet" href="layout.css" type="text/css" />
<!-- <link rel="stylesheet" href="shop.css">
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>     -->


</head>

<?php
require "dbasename.php";
require "head.php";
require "popup.php";
if (isset($_POST['destroy'])){

}

    function sw_get_current_weekday() {
        date_default_timezone_set('Asia/tokyo');
        $weekday = date("l");
        $weekday = strtolower($weekday);
        switch($weekday) {
            case 'monday':
                $weekday = '月曜日';
                break;
            case 'tuesday':
                $weekday = '火曜日';
                break;
            case 'wednesday':
                $weekday = '水曜日';
                break;
            case 'thursday':
                $weekday = '木曜日';
                break;
            case 'friday':
                $weekday = '金曜日';
                break;
            case 'saturday':
                $weekday = '土曜日';
                break;
            default:
                $weekday = '日曜日';
                break;
        }
        // echo $weekday.', '.date('d/m/Y H:i:s');
        echo $weekday.', '.date('Y年m月d日');
       // echo date('Y')- date('m');
    }
// ---------------------------tao bo dem luot truy cap-------------------

$countFile= "index.log";
$CF = fopen($countFile,"r");
$views=fread($CF,filesize($countFile));
fclose($CF);
$views++;
$CF= fopen($countFile,"w");
fwrite($CF, $views);
fclose($CF);



    // --------------------luot tuy cap /end ---------------------

?>

  <div class="leftcolumn">
    <div class="card">
      <h2>
    <div class="border in">
   <?php
    $check=null;
    $name=$code=$aisatsu=$in1=$out1=$in2=$out2= "";
if (isset($_POST["codein"])) {
   $code= $_POST['barcode'];
  $st = $pdo->query("SELECT * FROM staffdata where passcode= '$code'");
  $row = $st->fetch();
  $name= $row['name'];

if(@($row['name'])){
    $check=True;
     $st = $pdo->query("SELECT * FROM kintaidata where date= CURRENT_DATE and passcode=$code");
    $aisatsu=$name."さん、<br>おはようございます。";
}else{
$aisatsu ="パスコード確認し、再入力ください";

  }
}

if (isset($_POST["skin"]) ||isset($_POST["kkksin"])||isset($_POST["kksrin"])||isset($_POST["tkin"])||(isset($_POST["codein"])&$check==True) ){
    if($check!=True){
    $code =$_POST["code"];
    $name =$_POST["name"];
}
if($name!=""){
if (isset($_POST["skin"])){
$stmt = $pdo->prepare("INSERT INTO kintaidata(date, passcode, name, sk) VALUES (CURRENT_DATE,?,?,CURRENT_TIME)");

            $stmt->execute(array($code,$name));
    }
if (isset($_POST["kkksin"])){

$stmt = $pdo->query("UPDATE `kintaidata` SET kkks=CURRENT_TIME WHERE date=CURRENT_DATE and passcode=$code");
    }
if (isset($_POST["kksrin"])){
$stmt = $pdo->query("UPDATE `kintaidata` SET kksr=CURRENT_TIME WHERE date=CURRENT_DATE and passcode=$code");
    }
if (isset($_POST["tkin"])){
$stmt = $pdo->query("UPDATE `kintaidata` SET tk=CURRENT_TIME WHERE date=CURRENT_DATE and passcode=$code");

    }
    $aisatsu="<span style='color:red;''>".$name."</span>さん、<br>おはようございます。";

$st = $pdo->query("SELECT * FROM kintaidata where date= CURRENT_DATE and passcode=$code");

 $kintai = $st->fetch();
 $dis1=$dis2=$dis3=$dis4="";
    $in1=$kintai['sk'];
 $out1=$kintai['kkks'];
  $in2=$kintai['kksr'];
   $out2=$kintai['tk'];
   if($in1=="00:00:00"){ $in1="";}else if(@$in1){$dis1="disabled";}
   if($out1=="00:00:00"){ $out1="";$dis3="disabled";}else{$dis2="disabled";}
    if($in2=="00:00:00"){ $in2="";}else{$dis3="disabled";}
 if($out2=="00:00:00"){ $out2="";}else{$dis4="disabled";}
}
}
?>
<div style="font-size:20px">
<?php sw_get_current_weekday(); ?></div><span style="font-size:55px" id="clock"></span>
<br>
   <form action="" method="POST">
    <input type="text" name="barcode"  class="barcodein radius" placeholder="パスコード入力" value="<?php echo $code; ?>"></input>
    <input  class="barcodein2 radius" type= "submit" name="codein" value="OK">
    <p><?php   echo "<br>".$aisatsu;
?></p>
</form>


    </div>


    <!-- <div class="card">
      <h2>TITLE HEADING</h2>
      <h5>Title description, Sep 2, 2017</h5>
      <div class="fakeimg" style="height:200px;">Image</div>
      <p>Some text..</p>
      <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
    </div> -->
 
</h2>
    </div>
<h2 class = "lcontent checkbutin">
    <form id ="l_d" action = "" method = "POST">

    <input type="hidden" name="code" value="<?php echo $code; ?>">
        <input type="hidden" name="name" value="<?php echo $name; ?>">

 <input  class="butsize radius" <?php echo @$dis1 ;?> type= "submit" name="skin" value="出勤">
  <input  class="butsize radius" <?php echo @$dis2 ;?> type= "submit" name="kkksin" value="休憩開始">
   <input  class="butsize radius" <?php echo @$dis3 ;?> type= "submit" name="kksrin" value="休憩終了">
    <input  class="butsize radius" <?php echo @$dis4 ;?> type= "submit" name="tkin" value="退勤">

    <br><br>
        <input  class="butsize radius" type= "" name="skout" value="<?php echo $in1 ?> "disabled >
        <input  class="butsize radius" type= "" name="kkksout" value="<?php echo $out1 ?>"disabled >
        <input  class="butsize radius" type= "" name="kksrout" value="<?php echo $in2 ?>" disabled>
        <input  class="butsize radius" type= "" name="tkout" value="<?php echo $out2 ?>" disabled>
        <br><br><br><br>
         <input  class="butsize radius" id ="destroy" type= "submit" name="destroy" value="終了">
</form>

    </h2>


 </div>
  <div class="rightcolumn">
    <div class="card">
      <h2>新着情報</h2>
      <!-- <div class="fakeimg" style="height:100px;">Image</div> -->
      <li><span style="background:yellow;color:red"><a href="shinchaku.php?number=setsumei">本サイトの使い方説明</a></span></li>
      <li><a href="shinchaku.php?number=new">新商品が発売</a></li>
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
<script>
    function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
 
        /* Đặt phần tử của bạn tại đây */
        document.getElementById('clock').innerHTML =
        h + "時" + m + "分" + s　+'秒';
        var t = setTimeout(startTime, 500);
    }
    function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }
    document.querySelector('body').addEventListener("load", startTime());
    
    
</script>
<div class="footer">
  <div style="width:20%;float:left">
    訪問回数：<?php echo $views?>

  </div>
    
  <div >
    <li><a href="#">Contact</a></li>
  Copyright © 2019 Tran Duc Anh - 横浜システム工学院専門学校
    </div>

</div>

</body>
</html>
