<?php
session_start();


if (!isset($_SESSION['loginUser'])) {
  header("Location: Logout.php");
  exit;
}

  
 

if(isset($_POST['save_outgo'])){
    $error1=$_POST['save_outgo'];
    if($error1==""){
    header('Location: hikidashi_again.php');
    exit();
    }
    //DB接続用ファイル呼び出し
    require_once('db.php');
    //データベースに接続確認
    if(!$con){
    echo "接続失敗<br>";
    exit;
    }
    $id=$_SESSION['loginUser'];
    date_default_timezone_set("Asia/Tokyo");
    $now = date("Y-m-d H:i:s");
    $hikidashi=$_POST['save_outgo'];
    $sql="insert into u965831441_selfh.inout (user_id,outgo,kind,comment,date) values ('$id','-$hikidashi','save','貯金を引き出し','$now')";
    $stmt=$con->query($sql);

    if(!$stmt){
    header('Location: hikidashi_again.php');
    exit();
  }else{
    header('Location: main.php');
    exit();
  }
  //データベース接続を切断
  $con = null;
}

?>