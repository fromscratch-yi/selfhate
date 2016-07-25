<?php
session_start();


if (!isset($_SESSION['loginUser'])) {
  header("Location: Logout.php");
  exit;
}
if(isset($_POST['income'])&&isset($_POST['kind'])&&isset($_POST['comment'])){
	$error1=$_POST['income'];
	if($error1==""){
	header('Location: Deposit_again.php');
    exit();
	}
	
  //DB接続用ファイル呼び出し
  require_once('db.php');
  //データベースに接続確認
  if(!$con){
    echo "接続失敗<br>";
    exit;
  }
  date_default_timezone_set("Asia/Tokyo");
  $now = date("Y-m-d H:i:s");
  $id=$_SESSION['loginUser'];
  $sql="insert into u965831441_selfh.inout (user_id,income,kind,comment,date) values ('$id','".$_POST['income']."','".$_POST['kind']."','".$_POST['comment']."','$now')";
  $stmt=$con->query($sql);
  if(!$stmt){
    header('Location: Deposit_again.php');
    exit();
  }else{
    header('Location: main.php');
    exit();
  }
  //データベース接続を切断
	$con = null;
}



?>