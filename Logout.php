<?php
session_start();

session_unset();
header('Location: Login.html');
exit();
  //データベース接続を切断
  $con = null;
?>