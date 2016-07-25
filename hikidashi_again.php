<?php
    session_start();


  if (!isset($_SESSION['loginUser'])) {
  header("Location: Logout.php");
  exit;
  }

  //DB接続用ファイルを呼び出し
  require_once('db.php');

  //データベースに接続確認
  if(!$con){
    header("Location: Logout.php");
    exit();
  }
  //$stmt1 = $con->query('SET NAMES utf8');
  $id=$_SESSION['loginUser'];
  //貯金合計
  $stmt3 = $con->query("select sum(outgo) from u965831441_selfh.inout where user_id = '$id' and kind = 'save'");
  $data3 = $stmt3->fetch(PDO::FETCH_NUM);
  $save=$data3[0];

  
  

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/deposit.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no,minimum-scale = 1.0,maximum-scale = 1.0,user-scalable = no">
<script type="text/javascript">
function check(){
  if(window.confirm('支出を確定してもよろしいですか？')){
    return true;
  }else{
    window.alert('キャンセルされました。');
    return false;
  }
}
</script>
</head>

<body>



<div id="form-div">
    <p class="back"><a href="main.php"><img src="image/back.png"></a></p>
    <p class="sheet_title outgo">貯金から引き出し</p>

       <div class="saving">
    <p class="savemoney">&yen;<?= number_format($save); ?>-</p>

    </div><!--saving-->
    <div style="text-align:center;color:#F36;text-shadow: 0.3px 0.3px 0.3px #111;font-weight:bold;">【入力内容に誤りがあります】</div>
    <form class="form" id="form1" action="hikidashi_logic.php" method="post" onSubmit="return check()">     
    
      <table class="clearfix">
      <tr>
        
        <td><br>貯金から引き出す金額:<br><input name="save_outgo"  type="number" placeholder="&yen;" class="intex" pattern="\d*"/><br><br></td>
      </tr>
      
      
      
      
      </table>
      <input type="submit" value="支出を確定" id="button-blue">
    </form>

</div>

  
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
</html>
</html>