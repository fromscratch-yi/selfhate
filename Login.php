<?php
session_start();

if(isset($_POST['user_id'])&&isset($_POST['password'])){
   //db接続に必要な情報を変数に入れる

  require_once('db.php');
  //DB接続用ファイル呼び出し
  //データベースに接続確認
  if(!$con){
    echo "接続失敗<br>";
    exit;
  }
  $formUserId = $_POST['user_id'];
  $formPassword = $_POST['password'];
      //ID, PASWORDが未入力の場合
  if(($formUserId == "")&&($formPassword == "")){
    //エラー関数の呼び出し
    header("Location:LoginE1.html");
    exit();
  }else if(($formUserId == "")){
    //エラー関数の呼び出し
    header("Location:LoginE2.html");
    exit();
  }else if(($formPassword == "")){
    //エラー関数の呼び出し
    header("Location:LoginE3.html");
    exit();
  }else if(($formUserId == "12080514")&&($formPassword == "12080514")){
    header("Location:http://yufroms.esy.es/ShopList/index.php");
    exit();
  }

  $sql = 'select * from u965831441_selfh.userinfo';
  $stmt=$con->query($sql);
  while($data=$stmt->fetch(PDO::FETCH_ASSOC)) {
    if($data['user_id'] == $formUserId) {
      //フォームから取得したUSERIDとデータベースのUSERIDが一致
      $dbPassword = $data['password'];
      break;
    }
  }
  //接続を閉じる
  $con=null;

  if(!isset($dbPassword)){
    header("Location:LoginE4.html");
    exit();
  }else{
    if($dbPassword!=$formPassword){
      header("Location:LoginE4.html");
      exit();
    }else{
      $_SESSION['loginUser'] = $formUserId;
      header("Location:main.php");
      exit();
    }
  }
}
?>
