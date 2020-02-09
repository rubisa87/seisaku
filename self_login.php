<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
<title>ログイン</title>
<link rel="stylesheet" href="layout.css" type="text/css" />

</head>
<?php 
require "dbasename.php";
require "head.php";
$page=@$_GET['page']; 
$passcode=0;
$pass=$pagename="";
$errormess="";
if($page=="self"){
$pagename='各自に';
}else 
if($page=="kanri"){
$pagename='管理に';
}
if (isset($_POST["login"])) {
 $page = $_POST["page"];
    if (@($_POST["passcode"]) and @($_POST["pass"]) ) {

               $passcode = $_POST["passcode"];
        $pass = $_POST["pass"];
   $stmt = $pdo->prepare('SELECT * FROM staffdata WHERE passcode = ?');
            $stmt->execute(array($passcode));
            $rows = $stmt->fetch();
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
            $_SESSION['name']=$rows["name"];
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
        <h2><?php echo $pagename ?>ログイン</h2>
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
