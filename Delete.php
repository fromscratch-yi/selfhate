<?php
session_start();

if(!isset($_SESSION['loginUser'])){
  	header("Location: Logout.php");
  	exit();
  }
  //DB接続用ファイル呼び出し
  require_once('db.php');
  //データベースに接続確認
  if(!$con){
    header("Location: Logout.php");
    exit;
  }	
  $stmt = $con->query('SET NAMES utf8');

  $id=$_SESSION['loginUser'];
  $stmt = $con->query("delete from u965831441_selfh.userinfo where user_id = '$id'");
  $stmt2 = $con->query("delete from u965831441_selfh.inout where user_id = '$id'");
header('Location: Login.html');
exit();
  //データベース接続を切断
  $con = null;
?>