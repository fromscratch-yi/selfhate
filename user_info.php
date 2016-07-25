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
  //$stmt1 = $con->query('SET NAMES utf8');

  $id=$_SESSION['loginUser'];
  $stmt = $con->query("select * from u965831441_selfh.userinfo where user_id = '$id'");

  while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $user_id=$data['user_id'];
    $pass=$data['password'];
    $pass_mask = str_pad("", strlen($pass), "*");
    $user_name=$data['user_name'];
    $email=$data['email'];
    $user_sex=$data['user_sex'];
  }
  $con=null;
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/reset.css">

<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" media="screen" href="css/kikagaku.css">
<link rel="stylesheet" href="css/jquery.sidemenu.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no,minimum-scale = 1.0,maximum-scale = 1.0,user-scalable = no">
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="js/jquery.sidemenu.min.js"></script>
<script type="text/javascript">

function delcheck(){
  if(confirm('ユーザー情報は完全に削除され復元できません。本当によろしいですか?')==true){
    
    location.href = "Delete.php";
  }
}
</script>
<style>
  
.on{
  position:absolute;
  top:0;
  left: 0;
  
  height: 100vh;
  width: 100%;
}
[data-role=sidemenu-content] > a {
      display: inline-block;
      margin: 8px;
}
.exp{
    text-align: left;
    width: 96%;
    margin: 2% auto;
    padding: 5% 0 2% 0;
    background: rgba(0,0,0,0.2);
    border-radius: 5px;
    font-family:Avenir , Open Sans , Helvetica Neue , Helvetica , Arial , Verdana , Roboto , 游ゴシック , Yu Gothic , 游ゴシック体 , YuGothic , ヒラギノ角ゴ Pro W3 , Hiragino Kaku Gothic Pro , Meiryo UI , メイリオ , Meiryo , ＭＳ Ｐゴシック , MS PGothic , sans-serif;

  }
</style>

</head>
<body>

<!-- count particles -->

<!--<p>ようこそ<?=htmlspecialchars($_SESSION['loginUser'], ENT_QUOTES); ?>さん</p>-->
<!-- particles.js container -->
<div style="z-index:0;position: relative;" id="particles-js">

</div>
<div class="on" data-role="sidemenu-container" data-sidemenu-dir="left">
      <div id="sidemenu">
        <ul>
          <li><a href="#" data-role="sidemenu-toggle" style="padding:2% 0 2% 20px;font-size:30px;">×</a></li>
          <li class="divider"></li>
          <li><a href="main.php">トップ</a></li>
          <li class="divider"></li>
          <li><a href="user_info.php">ユーザー情報</a></li>
          <li class="divider"></li>
          <li><a href="help.html">このアプリについて</a></li>
          <li class="divider"></li>
          <li><a href="contact.html">お問い合わせ</a></li>
          <li class="divider"></li>
          <li><a href="Logout.php" onClick="outcheck()">ログアウト</a></li>
          
          
        </ul>
      </div>

<p class="hb_bn"><a href="#" data-role="sidemenu-toggle"><img src="image/hn_bn.png"></a></p>

<div id="overlay">
   
   <p id="close" class="add_bn"><img src="image/close_bn.png"></p>
   <div class="kind">
   <p>シートの種類を選択してください。</p>
   <p style="clear:both;" class="add_menu"><a href="Deposit.php">入金-Deposit-</a></p>
   <p class="add_menu"><a href="Withdraw.php">出金-Withdraw-</a></p>
   <p class="add_menu"><a href="hikidashi.php">貯金から引き出し</a></p>
   </div>
</div>
<p id="btn" class="add_bn"><img src="image/add_bn.png"></p>
<p style="clear: both;font-size: 25px;color: #fff;text-align: center;">【ユーザ情報】</p>
<div class="exp">
  
  <p class="thead">Name</p>
  <p class="tin"><?=$user_name ?></p>

  <p class="thead">ID</p>
  <p class="tin"><?=$user_id ?></p>

  <p class="thead">Password</p>
  <p class="tin"><?=$pass_mask ?></p>

  <p class="thead">Email</p>
  <p class="tin"><?=$email ?></p>

  <p class="thead">Gender</p>
  <p class="tin"><?=$user_sex ?></p>



</div>
<p class="delete" onClick="delcheck()">>>ユーザー削除</p>
    


</div>


<!-- scripts -->
<script src="js/particles.js"></script>
<script src="js/app.js"></script>

<!-- stats.js -->

<script>
  var count_particles, stats, update;
  stats = new Stats;
  stats.setMode(0);
  stats.domElement.style.position = 'absolute';
  stats.domElement.style.left = '0px';
  stats.domElement.style.top = '0px';
  document.body.appendChild(stats.domElement);
  count_particles = document.querySelector('.js-count-particles');
  update = function() {
    stats.begin();
    stats.end();
    if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
      count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
    }
    requestAnimationFrame(update);
  };
  requestAnimationFrame(update);
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">
  $(function() {
     $("#btn").click(function() {
           $("#overlay").fadeIn();　/*ふわっと表示*/
 });
     $("#close").click(function() {
           $("#overlay").fadeOut();　/*ふわっと消える*/
 });
});
</script>
<script type="text/javascript">
window.onorientationchange = function () {
 switch ( window.orientation ) {
  case 0:
   break;
  case 90:
   alert('このアプリは画面を縦にしてお使いください。');
   break;
  case -90:
   alert('このアプリは画面を縦にしてお使いください。');
   break;
 }
}
</script>
</body>
</html>