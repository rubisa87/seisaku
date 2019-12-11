<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title> 出勤管理システム</title>
<link rel="stylesheet" href="shop.css">
    <!-- <link rel="stylesheet" type="text/css" href="vendor/bootstrap.css"> -->
<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
</head>
<body>

<p class="top">
    <p1 class = "top1">
       <a href="">打刻</a>
    </p1>
    &nbsp &nbsp 
    <p1 class = "top2">
       <a href='self.php'>従業員</a>

        <?php //$page1= "self"; echo "<a href='self_login.php?page=$page1'>従業員</a>"; ?>
    </p1>
&nbsp&nbsp
    <p1 class = "top3">
       <a href='kanri.php'>管理人</a>

        <?php //$page2= "kanri"; echo "<a href='self_login.php?page=$page2'>管理人</a>"; ?>
    </p1>
</p>
<br><br>
<table  background="" height="40px" />
<tr>
<td valign="top" >
<div style="width:1230px;height:28px;font-size:16px;font-family:Arial;float:right;padding-top:9px;padding-right:25px;">
<marquee onmouseover=this.stop() onmouseout=this.start() scrolldelay="50" scrollamount="5">
<strong>
    おしらせ：
<a href="/Đường dẫn tới thông báo của bạn" style="color:#fb4ca7">  今週の木曜日（１２日）二俣川サンハートで第２回発表があります</a> 

<a href="/Đường dẫn tới thông báo của bạn" style="color:#ff0">    2月１６日最終発表会が行われます  </a>  
</strong>
</marquee>
</div>
</td></tr>
</table>

<?php
session_start();

if (isset($_POST['destroy'])){
    session_destroy();
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
?>





<h2>
    <div class="border in">
    <?php
    $check=null;
    $name=$code=$aisatsu=$in1=$out1=$in2=$out2=   "";
$pdo = new PDO("mysql:dbname=seisaku","root");
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

  // echo $name;
    
// }
  }
}
// if (isset($_POST["skin"])){
//     $code =$_POST["code"];
//     $name =$_POST["name"];
//     // echo "出勤ボタンチェックした"."<br>";
//     // echo "code:".$code.",name:".$name."<br";
//     // echo "name:".$name."<br>";
//             // $stmt = $pdo->prepare("INSERT INTO userData(name, password,realname,mail,address,phone) VALUES (?,?, ?,?,?,?)");
//       // $st->execute(array($_GET['name']));
// if($name!=""){
//     // $st = $pdo->query("INSERT INTO 'kintaidata'( 'date', 'passcode', 'name', 'sk') VALUES (CURRENT_DATE,$code,$name,CURRENT_TIME)");
//         // $st = $pdo->query("INSERT INTO kintaidata( date, passcode, name, sk) VALUES (CURRENT_DATE,$code,$name,CURRENT_TIME)");
// // INSERT INTO `kintaidata`( `date`, `passcode`, `name`, `sk`) VALUES (CURRENT_DATE,$code,'$name',CURRENT_TIME);
//     $stmt = $pdo->prepare("INSERT INTO kintaidata(date, passcode, name, sk) VALUES (CURRENT_DATE,?,?,CURRENT_TIME)");

//             $stmt->execute(array($code,$name));
//         // echo "mysql insert　した "."<br>";

// // $st = $pdo->query("SELECT * FROM kintaidata where date= CURRENT_DATE and passcode=$code");
//     // echo "select＊　in1 とった"."<br>";
// // }else{ echo "no index of name and code ";}
// }}
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
    $aisatsu=$name."さん、<br>おはようございます。";







$st = $pdo->query("SELECT * FROM kintaidata where date= CURRENT_DATE and passcode=$code");

 $kintai = $st->fetch();
    $in1=$kintai['sk'];
 $out1=$kintai['kkks'];
  $in2=$kintai['kksr'];
   $out2=$kintai['tk'];
   if($in1=="00:00:00"){ $in1="";}
   if($out1=="00:00:00"){ $out1="";}
    if($in2=="00:00:00"){ $in2="";}
 if($out2=="00:00:00"){ $out2="";}
}
}

?>                           
<!-- <div class="top_header-date"　> -->
    <!-- <span class="icon"><i class="fa fa-clock-o" aria-hidden="true"></i></span> -->
    <?php sw_get_current_weekday(); ?> || <span id="clock"></span>
<!-- </div> -->
<br>
    <!-- <p style="font-size:15px;">バーコードを入力してください！</p> -->
   <form action="" method="POST">
    <input type="text" name="barcode"  class="barcodein radius" placeholder="パスコード入力" value="<?php echo $code; ?>"></input>
    <!-- <imput  class="barcodein2" type= "submit" name="codein" value="OK"> -->
    <input  class="barcodein2 radius" type= "submit" name="codein" value="OK">
    <p><?php   echo "<br>".$aisatsu;
?></p>


</form>
    <script >
// cho doan truy xuat ten nhan vien
    </script>
</p>
 </div>
</h2>
<h2 class = "lcontent checkbutin">
    <form action = "" method = "POST">

    <input type="hidden" name="code" value="<?php echo $code; ?>">
        <input type="hidden" name="name" value="<?php echo $name; ?>">

 <input  class="butsize radius" type= "submit" name="skin" value="出勤">
  <input  class="butsize radius" type= "submit" name="kkksin" value="休憩開始">
   <input  class="butsize radius" type= "submit" name="kksrin" value="休憩終了">
    <input  class="butsize radius" type= "submit" name="tkin" value="退勤">

    <br><br>
        <input  class="butsize radius" type= "" name="skout" value="<?php echo $in1 ?> ">
        <input  class="butsize radius" type= "" name="kkksout" value="<?php echo $out1 ?>">
        <input  class="butsize radius" type= "" name="kksrout" value="<?php echo $in2 ?>">
        <input  class="butsize radius" type= "" name="tkout" value="<?php echo $out2 ?>">
        <br><br><br><br>
         <input  class="butsize radius" type= "submit" name="destroy" value="終了">
</form>

    </h2>



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
<!-- <footer>
    <p><small>Copyright 2019 Nora Team All rights reserved.</small></p>
</footer> -->

<!-- this script got from www.htmlbestcodes.com-Coded by: Krishna Eydat -->


</script>

</script>

</body>
 <!-- <div id="footer">&copy;2016 Web cơ bản All Rights Reserved</div> -->
</html>

<!-- INSERT INTO `kintaidata`( `date`, `passcode`, `name`, `sk`,) VALUES (CURRENT_DATE,'100','TRAN DUC ANH',CURRENT_TIME); -->
<!-- UPDATE `kintaidata` SET kkks=CURRENT_TIME WHERE date='20191101' and passcode='101'; -->