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
<?php 
    session_start();

$page=@$_GET['page']; 

$passcode=0;
$pass="";
$errormess="";

if (isset($_POST["login"])) {
 $page = $_POST["page"];
    if (@($_POST["passcode"]) and @($_POST["pass"]) ) {

               $passcode = $_POST["passcode"];
        $pass = $_POST["pass"];
        $pdo = new PDO("mysql:dbname=seisaku","root");
   $stmt = $pdo->prepare('SELECT * FROM staffdata WHERE passcode = ?');
            $stmt->execute(array($passcode));
            $rows = $stmt->fetch();
echo $rows['password'];
if($page=="kanri"){
    if($passcode =="mise" &$pass =="8793"){
    $_SESSION['kanri']=True;
header("Location: kanri.php");
           exit();
    }else{
$errormess=$errormess."アクセス権限無効";

    } 

}else if(($page=="self")&($pass==@$rows["password"])){
            $_SESSION['login']=True;
            $_SESSION['code']=$passcode;
            if($passcode==3){
                $_SESSION['kanri']=True;
            }
        header("Location: self.php");
        exit();
    }else{
        $errormess=$errormess."ユーザー名かパスワードが間違っています";
    }


    } else {
    if(!@($_POST["passcode"])){
    $errormess =$errormess."従業員番号未入力<br>";
    }
    if(!@($_POST["pass"])){
    $errormess=$errormess."パスワード未入力です<br>";
    }
    }
}

if (!empty($_SESSION['error2'])) {
    $errormess= $errormess.$_SESSION['error2'];
    $_SESSION['error2']= null;

}

?>
<div style="height:300px;">
    <div style="float:left;width: 24%;"> &nbsp</div>
    <div class="login">
        <h2>ログイン</h2>
        <?php echo @$errormess;
        // echo $page;?>
        <form action="self_login.php" method="post" id="">
            <p>
                <input type='text' name="passcode" size='14' placeholder="Passcode">
            </p>
            <p>
                <input type='password' name='pass' size='14' maxlength='20'
                    placeholder="Password">
                <input type="hidden" name = "page" value =<?php echo $page ?> >
            </p>
            <p>
                <button type="submit" formmethod="POST" name="login" value="1"
                    id="button">OK</button>
            </p>
        </form>
    </div>
    <div style="float:left;width: 24%;">&nbsp</div>
</div>
 <div class="footer">
    <li><a href="#">Contact</a></li>

  Copyright © 2019 Tran Duc Anh - 横浜システム工学院専門学校
</div>

</body>
</html>


            <!-- echo "<a href='user_update.php?name=$name '>登録情報変更</a>"; -->
  <!-- $name = $_GET['name']; -->
