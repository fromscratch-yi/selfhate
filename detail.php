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
  $wariai1=((double)($spend/$use)*100);
  //浪費合計
  $stmt5 = $con->query("select sum(outgo) from u965831441_selfh.inout where user_id = '$id' and kind = 'waste'");
  $data5 = $stmt5->fetch(PDO::FETCH_NUM);
  $waste=$data5[0];
  $wariai2=((double)($waste/$use)*100);
  //投資合計
  $stmt6 = $con->query("select sum(outgo) from u965831441_selfh.inout where user_id = '$id' and kind = 'investment'");
  $data6 = $stmt6->fetch(PDO::FETCH_NUM);
  $investment=$data6[0];
  $wariai3=((double)($investment/$use)*100);

  $con=null;
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/help.css">
<link rel="stylesheet" href="css/detail.css">
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
<p class="hb_bn"><a href="main.php"><img src="image/back.png"></a></p>

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
    <p class="savetext">USED DETAIL</p>
    <p class="savemoney">&yen;<?= number_format($use); ?>-</p>

    
    </div><!--saving-->
    <div class="graph" style="margin-bottom: 15%;">
    <p class="ggroup">消 費<br><spna style="font-size: 12px;">&yen;<?= number_format($spend); ?>-</spna></p>
    <p class="kaku">(<?=floor($wariai1) ?>%)</p>
    <div class="gline"><a href="spendhis.php"><p style="margin-top:5px;min-height:35px;width:<?=$wariai1 ?>%;color:#40E186;background-color: #40E186; ">&nbsp;</p></a></div>
    


    <p class="ggroup">浪 費<br><spna style="font-size: 12px;">&yen;<?= number_format($waste); ?>-</spna></p>
    <p class="kaku">(<?=floor($wariai2) ?>%)</p>
    <div class="gline"><a href="wastehis.php"><p style="margin-top:5px;min-height:35px;width:<?=$wariai2 ?>%;color:#FF6F49;background-color: #FF6F49; ">&nbsp;</p></a></div>
    

    <p class="ggroup">投 資<br><spna style="font-size: 12px;">&yen;<?= number_format($investment); ?>-</spna></p>
    <p class="kaku">(<?=floor($wariai3) ?>%)</p>
    <div class="gline"><a href="investmenthis.php"><p style="margin-top:5px;min-height:35px;width:<?=$wariai3 ?>%;text-align:center;color:#FFAB49;background-color: #FFAB49; ">&nbsp;</p></a></div>
    

    </div><!--graph-->

    <div style="  font-family:Avenir , Open Sans , Helvetica Neue , Helvetica , Arial , Verdana , Roboto , 游ゴシック , Yu Gothic , 游ゴシック体 , YuGothic , ヒラギノ角ゴ Pro W3 , Hiragino Kaku Gothic Pro , Meiryo UI , メイリオ , Meiryo , ＭＳ Ｐゴシック , MS PGothic , sans-serif;    font-size: 20px;
clear:both;color: #fff;font-size:16px;width:80%;" class="exp">
    
    <?php

      if($wariai2 < 15){
        echo "<p>とっても有意義なお金の使い方です。あなたにはほとんど無駄がありません。</p>";
        
      }else if($wariai2 < 20){
        echo "<p>いい感じです。次の目標は浪費15%以内に抑えてみませんか?</p>";
      }else if($wariai2 < 30){
        echo "<p>もっとちょっと浪費を投資に変えることができたらあなたの見える世界が変わっていくことを実感するでしょう。</p>";
      }else if($wariai2 < 40){
        echo "<p>ちょっと自分の無駄を見直してみては？</p>";
      }else if($wariai2 < 45){
        echo "<p>無駄遣いを投資に変えるべきです。</p>";
      }else{
        echo "<p>無駄遣いがちょっと多いですね。。。</p>";
      }
      //echo '<p style="text-align:center;">今日の一言</p>'

      
    ?>
    
    </div><!--msg-->


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