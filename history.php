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
  
  $stmt = $con->query('SET NAMES utf8');
  //貯金合計
  $stmt1 = $con->query("select sum(outgo) from u965831441_selfh.inout where user_id = '$id' and kind = 'save'");
  $data1 = $stmt1->fetch(PDO::FETCH_NUM);
  $save=$data1[0];
  $stmt2 = $con->query("select * from u965831441_selfh.inout where user_id = '$id' and kind = 'save'");
  
  //$date = '2013-01-01 00:00:00';
  //echo date('Y/m/d', strtotime($date));
  

  $con=null;
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/reset.css">

<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/help.css">
<link rel="stylesheet" media="screen" href="css/kikagaku.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no,minimum-scale = 1.0,maximum-scale = 1.0,user-scalable = no">
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

<style>
.exp{
  width: 85%;
  margin-bottom: 5%;

}
.savemoney{
  margin-bottom: 10px;
}
.on{
  position:absolute;
  top:0;
  left: 0;
  width: 100%;
}
[data-role=sidemenu-content] > a {
      display: inline-block;
      margin: 8px;
}

table.savehis{
  width: 100%;
  font-family:Avenir , Open Sans , Helvetica Neue , Helvetica , Arial , Verdana , Roboto , 游ゴシック , Yu Gothic , 游ゴシック体 , YuGothic , ヒラギノ角ゴ Pro W3 , Hiragino Kaku Gothic Pro , Meiryo UI , メイリオ , Meiryo , ＭＳ Ｐゴシック , MS PGothic , sans-serif;
  color: #fff;
  border: #fff 2px solid;

  text-align: center;
}
table.savehis tr{
  border-bottom: #fff solid 2px;
  width: 100%;

}
tr:nth-child(odd) { background-color:rgba(92, 161, 205,0.7);}
table.savehis th{

  margin: 2% 0;
  padding: 10px 0;
  font-size: 16px;
  border-right:#fff solid 2px;
  text-align: center;
  background-color:rgba(6, 133, 216,0.5);

}

table.savehis td{
  font-size: 14px;
  padding: 15px 0;
  border-right:#fff solid 2px;

}

table.savehis　th.ttop{
  width: 15%;
}
table.savehis　th.midle{
  width: 35%;
}
table.savehis　th.tbottom{
  width:50%;
}


table.savehis　td.ttop{
  width: 15%;
}
table.savehis　td.midle{
  width: 35%;
}
table.savehis　td.tbottom{
  width:50%;
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
    <p class="savetext">SAVING HISTORY</p>
    <p class="savemoney">&yen;<?= number_format($save); ?>-</p>
    
    
    </div><!--saving-->
    
  <div class="exp">

  <table class="savehis">
  <tr>
  <th class="ttop">日付</th>
  <th class="midle">貯金額</th>
  <th class="tbottom">コメント</th>
  </tr>
  <?php
    while($row = $stmt2 -> fetch(PDO::FETCH_ASSOC)) {

      $date=$row['date'];
      $day=date('m/d', strtotime($date));
      $save=number_format($row["outgo"]);
      echo '<tr>';
      echo '<td class="ttop">' .$day. '</td>';
      echo '<td class="midle">&yen;' .$save.'-</td>';
      echo '<td class="tbottom">' . $row["comment"] .'</td>';
      echo '</tr>';
    } 
  ?>
  </table>
</div><!--exp-->


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