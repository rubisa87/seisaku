<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title> 出勤管理システム</title>
<link rel="stylesheet" href="shop.css">
    <!-- <link rel="stylesheet" type="text/css" href="vendor/bootstrap.css"> -->
</head>
<body>
<!-- <h5> -->
<p class="top">
    <p1 class = "top1">
       <a href="main.php">打刻</a>
    </p1>
    &nbsp &nbsp 
    <p1 class = "top2">
        <a href="self.php">従業員</a>
    </p1>
&nbsp&nbsp
    <p1 class = "top3">
        <a href="kanri.php">管理人</a>
    </p1>
</p>
<br>
</p>
<br><br><br><br><br>

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

        </body>
</html>



            <!-- echo "<a href='user_update.php?name=$name '>登録情報変更</a>"; -->
  <!-- $name = $_GET['name']; -->
