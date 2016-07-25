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
  //収入合計
  $stmt = $con->query("select sum(income) from u965831441_selfh.inout where user_id = '$id' ");
  $data = $stmt->fetch(PDO::FETCH_NUM);
  $income=$data[0];

  //支出合計
  $stmt2=$con->query("select sum(outgo) from u965831441_selfh.inout where user_id = '$id'");
  $data2 = $stmt2->fetch(PDO::FETCH_NUM);
  $outgo=$data2[0];

  //貯金合計
  $stmt3 = $con->query("select sum(outgo) from u965831441_selfh.inout where user_id = '$id' and kind = 'save'");
  $data3 = $stmt3->fetch(PDO::FETCH_NUM);
  $save=$data3[0];

  //使えるお金 Can Use
  $canuse=$income-$outgo;

  //使ったお金 (支出合計-貯金)
  $use=$outgo-$save;

  //消費合計
  $stmt4 = $con->query("select sum(outgo) from u965831441_selfh.inout where user_id = '$id' and kind = 'spend'");
  $data4 = $stmt4->fetch(PDO::FETCH_NUM);
  $spend=$data4[0];

  //浪費合計
  $stmt5 = $con->query("select sum(outgo) from u965831441_selfh.inout where user_id = '$id' and kind = 'waste'");
  $data5 = $stmt5->fetch(PDO::FETCH_NUM);
  $waste=$data5[0];

  //投資合計
  $stmt6 = $con->query("select sum(outgo) from u965831441_selfh.inout where user_id = '$id' and kind = 'investment'");
  $data6 = $stmt6->fetch(PDO::FETCH_NUM);
  $investment=$data6[0];
  

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



    <div class="saving">
    <p class="savetext">SAVING</p>
    <p class="savemoney">&yen;<?= number_format($save); ?>-</p>
    <p class="history"><a href="history.php">HISTORY</a></p>
    
    </div><!--saving-->
    
  <div class="canuse">
    <p class="cantext">CAN USE</p>
    <p class="can_month">you can use </p>
    <p class="canmoney">&yen;<?= number_format($canuse); ?>-</p>
    </div><!--canuse-->
    
    
  <div class="used">
    <div class="usedtext clearfix">
    <p>USED<span style="float:right;"><a href="detail.php">DETAIL→</a></span></p>
    </div>
    
    <p class="spend_month">you used</p>
    <p class="spendmoney">&yen;<?= number_format($use); ?>-</p>
    <p class="detail_spend"><span style="font-size:12px">消費</span> -spend-<span style="float:right;">&yen;<?= number_format($spend); ?>-</span></p>
    <p class="detail_waste"><span style="font-size:12px">浪費</span> -waste-<span style="float:right;">&yen;<?= number_format($waste); ?>-</span></p>
    <p class="detail_investment"><span style="font-size:12px">投資</span> -investment-<span style="float:right;">&yen;<?= number_format($investment); ?>-</span></p>
    
    </div><!--used-->


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