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
  if(window.confirm('収入を確定してもよろしいですか？')){
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
    <p class="sheet_title">入金シート</p>
    <div style="text-align:center;color:#F36;text-shadow: 0.3px 0.3px 0.3px #111;font-weight:bold;">【入力内容に誤りがあります】</div>
    <form class="form" id="form1" action="Deposit_logic.php" method="post" onSubmit="return check()"> 
      <table class="clearfix">

        
      <tr>
        
        <td><br>収入金額:<br><input name="income"  type="number" placeholder="&yen;" class="intex" pattern="\d*"/><br><br></td>
      </tr>
        
      <tr>
        
        <td style="padding:17px 0";>収入の種類:
        <label><input name="kind" type="radio" value="salary"  checked /><span style="cursor: pointer;">給料</span></label>
        
        <label><input name="kind" class="kind" type="radio" value="sub_salary" /><span style="cursor: pointer;">副業</span></label>
        <label><input name="kind" class="kind" type="radio" value="income_other" /><span style="cursor: pointer;">その他</span></label>
        </td>

      </tr>
      <tr>
        
        
        <td>収入詳細(未入力OK):<br><input name="comment" id="comment" type="text" class="intex"  placeholder="参照" /><br><br></td>
      </tr>
      
      </table>
      <input type="submit" value="収入を確定" id="button-blue">
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