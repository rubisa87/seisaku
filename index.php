<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
<title>打刻</title>
<link rel="stylesheet" href="layout.css" type="text/css" />
	<!-- <link rel="stylesheet" type="text/css" href="bootstrap.css"> -->
	<!-- <meta http-equiv="refresh" content="0;URL=main.php"> -->

</head>

<?php
if(session_status()==1){
session_start();
}
$pdo = new PDO("mysql:dbname=seisaku;charset=utf8", "root");
    // $pdo = new PDO("mysql:dbname=b13_24945452_seisaku;host=sql304.byethost.com;charset=utf8", "b13_24945452","NFky0561");
// $pdo->exec("SET time_zone ='+09:00'");
if (isset($_SESSION['store_id'])){
     header("Location: main.php");
        exit();
}
// ------初期設定ーーーーーーーーーーー
$tenpocode=0;
$tenpass="";
$errormess="";

// ーーーーーーーーーーーーログインボタンをクリックしたらーーーーーーーーーーー
if (isset($_POST["login"])) {
	// ーーーーーーーーーフォームに両方も入力されているかとーーーーーーーーーーーー
    if (@($_POST["tenpocode"]) and @($_POST["tenpass"]) ) {
        $tenpocode = $_POST["tenpocode"];
        $tenpass = $_POST["tenpass"];
   $stmt = $pdo->prepare('SELECT * FROM store_list WHERE id = ?');
            $stmt->execute(array($tenpocode));
            $rows = $stmt->fetch();
if($tenpass==@$rows["password"]){
            $_SESSION['store_id']=$tenpocode;
            $_SESSION['store_name']=$rows["name"];
            $_SESSION['store_log']=True;
        header("Location: main.php");
        exit();
    }else{
        $errormess=$errormess."店舗コードまたはパスワードは間違えっています";
    }


    } else {
    if(!@($_POST["tenpocode"])){
    $errormess =$errormess."店舗コード未入力です<br>";
    }
    if(!@($_POST["tenpass"])){
    $errormess=$errormess."パスワード未入力です<br>";
    }
    }
}

if (!empty($_SESSION['error2'])) {
    $errormess= $errormess.$_SESSION['error2'];
    $_SESSION['error2']= null;

}






?>
		 	
		 	<!-- <button style="height:100px" onclick=window.location.href='main.php' class="btn btn-info btn-block" type="submit" height="30">打刻</button> -->
		 	<!-- <button style="height:100px" class="btn btn-info btn-block" type="submit">従業員</button> -->
		 	<!-- <button style="height:100px" onclick=window.location.href='staffdata.php' class="btn btn-info btn-block" type="submit">管理者</button> -->

<body style="background-color:#f4fff2">

<div class='header' style="height:100px;">
  <h1>勤怠管理システム</h1>
  <p>Tran Duc Anh</p>

</div>
<div id='menu'>
  <ul>
    <li>	</li>
    <li> 	</li>
    <li>	</li>
  </ul>
</div>
<div class='card' style="height:700px;">

<div style="height:300px;">
    <div style="float:left;width: 24%;"> &nbsp</div>
    <div class="login">
        <h1>店舗にログイン</h1>
        <?php echo @$errormess;
        // echo $page;?>
        <form action="index.php" method="post" id="">
            <p>
                <input style= "font-size:25px" type='text' name="tenpocode" size='14' placeholder="店舗コード">
            </p>
            <p>
                <input style= "font-size:25px;margin-top:10px" type='password' name='tenpass' size='14' maxlength='20'
                    placeholder="Password">
            </p>
            <p>
                <button style= "font-size:25px;margin-top:10px" type="submit" formmethod="POST" name="login" value="1"
                    >ログイン</button>
            </p>
        </form>
        <br><br>
        <p style="">アカウントをお持ちではない店舗は<a href="signUp.php">新店舗登録</a></p>
    </div>
    <div style="float:left;width: 24%;">&nbsp</div>

</div>
</div>


<div class="footer">
  <div style="width:20%;float:left">
<!-- <a href= "http://facebook.com/rubisa87" target="_blank">facebook</a>
 -->
  </div>
    
  <div >
    <li><a href="#">Contact</a></li>
  Copyright © 2019 Tran Duc Anh - 横浜システム工学院専門学校
    </div>

</div>

</body>
</html>
