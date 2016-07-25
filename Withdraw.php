<?php
  session_start();


  if (!isset($_SESSION['loginUser'])) {
  header("Location: Logout.php");
  exit;
}
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
    <p class="sheet_title outgo">出金シート</p>
    <form class="form" id="form1" action="Withdraw_logic.php" method="post" onSubmit="return check()"> 
      <table class="clearfix">
      <tr>
        
        <td><br>支出金額:<br><input name="outgo"  type="number" placeholder="&yen;" class="intex" pattern="\d*"/><br><br></td>
      </tr>
      <tr>
        
        <td style="padding:5px 0";>支出の種類:<br>
        <label><input name="kind" type="radio" value="spend"  checked /><span style="cursor: pointer;">消費</span></label>
        
        <label><input name="kind"  type="radio" value="waste" /><span style="cursor: pointer;">浪費</span></label>
        <label><input name="kind"  type="radio" value="investment" /><span style="cursor: pointer;">投資</span></label>
        <label><input name="kind" type="radio" value="save" /><span style="cursor: pointer;">貯金</span></label>
        </td>
      </tr>
      <tr>
        
        
        <td>支出詳細(未入力OK):<br><input name="comment" id="comment" type="text" class="intex"  placeholder="参照" /><br><br></td>
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