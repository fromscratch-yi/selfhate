<?php


if(isset($_POST['user_name'])&&isset($_POST['email'])&&isset($_POST['user_sex'])&&isset($_POST['user_id'])&&isset($_POST['password'])&&isset($_POST['password2'])&&isset($_POST['tyokin'])&&isset($_POST['syoji'])){
  
  if($_POST['password']!=$_POST['password2']){
    header('Location: Register_again2.html');
    exit();
  }
  /*
  else if(($_POST['user_name'] == "")||($_POST['password'] == "")||(($_POST['password2'] == "")||($_POST['eimail']== ""){
    header('Location: Register_again2.html');
    exit();
  }
  */

  //DB接続用ファイル呼び出し
  require_once('db.php');
  //データベースに接続確認
  if(!$con){
    echo "接続失敗<br>";
    exit;
  }
  $enc = $con->query('SET NAMES utf8');
  date_default_timezone_set("Asia/Tokyo");
  $now = date("Y-m-d H:i:s");
  if(!$now){
    echo "dateなし";
    exit();
  }

  $income=$_POST['tyokin']+$_POST['syoji'];
  //実行するクエリを変数に入れる。
  $sql="insert into u965831441_selfh.userinfo (user_name,email,user_sex,user_id,password) values ('".$_POST['user_name']."','".$_POST['email']."','".$_POST['user_sex']."','".$_POST['user_id']."','".$_POST['password']."')";
  //クエリを実行
  $sql2="insert into u965831441_selfh.inout (user_id,income,outgo,kind,date) values ('".$_POST['user_id']."','$income','".$_POST['tyokin']."','save','$now')";
  
  //$stmt=$con->query('set names utf8');
  $stmt=$con->query($sql);
  $stmt2=$con->query($sql2);
 

  if(!$stmt){
    header('Location: Register_again.html');
    exit();
  }else if(!$stmt2){
    echo "akan";
    exit();
  }else{
    header('Location: Register_ok.html');
    exit();
  } 
  
  
  //データベース接続を切断
  $con = null;
  
  
}
?>
