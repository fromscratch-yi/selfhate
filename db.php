<?php
//windowsローカルサーバー
// try{
//   $con=new PDO('mysql:dbname=u965831441_selfh;host=localhost','ishiyama','Yu123daa',
//   array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
//   }catch (PDOException $e) {
//         die($e->getMessage());
// }
//macローカルサーバー
try{
  $con=new PDO('mysql:dbname=u965831441_selfh;host=localhost','root','root',
  array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
  }catch (PDOException $e) {
        die($e->getMessage());
 }
 //ネットサーバー
// try{
//    $con=new PDO('mysql:dbname=u965831441_selfh;host=mysql.hostinger.jp','u965831441_ishiy','Yu123daa',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
//   }catch (PDOException $e) {
//         die($e->getMessage());
// }
?>
