<?php

/*--------------------------------
	Script Name : Responsive Mailform
	Author : FIRSTSTEP
	Author URL : http://www.1-firststep.com/
	Create Date : 2014/3/25
	Version : 2.0
	Last Update 2016/2/17
--------------------------------*/


error_reporting(E_ALL);


mb_language("Japanese");
mb_internal_encoding("UTF-8");


require 'config.php';





if( isset($_SERVER['HTTP_REFERER']) ){
	$referer = $_SERVER['HTTP_REFERER'];
}else{
	$referer = '';
}

if( $spam_check == 1 && !empty($domain_name) ){
	if( strpos($referer, $domain_name) ===  false){
		echo '<p>不正な操作が行われたようです。</p>';
		exit;
	}
}






$name_1 = '';
$mail_address = '';
$mail_address_confirm = '';
$gender = '';
$kind_separated = '';
$mail_contents = '';


if( !(empty($_POST['name_1'])) ){
	$name_1 = mb_convert_kana($_POST['name_1'], 'KVa');
}else {
	header('Location:contactE2.html') ;
		exit();
}



if( !(empty($_POST['mail_address'])) ){
	$mail_address = $_POST['mail_address'];
}else {
	header('Location:contactE2.html') ;
		exit();
}
if( !(empty($_POST['mail_address_confirm'])) ){
	$mail_address_confirm = $_POST['mail_address_confirm'];
}else {
	header('Location:contactE2.html') ;
		exit();
}

if( !(empty($_POST['mail_address'])) && !(empty($_POST['mail_address_confirm'])) ){

	if( !($mail_address === $mail_address_confirm) ){
		header('Location:contactE1.html') ;
		exit();
	}

	// if( !(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mail_address)) ){
	// 	echo '<p>正しくないメールアドレスです</p>。';
	// 	exit;
	// }
}


if( !(empty($_POST['gender'])) ){
	$gender = $_POST['gender'];
}





if( !(empty($_POST['mail_contents'])) ){
	$mail_contents = mb_convert_kana($_POST['mail_contents'], 'KVa');
}



	header('Location:contactE3.html') ;
	exit();


$now = date('Y年m月d日　H時i分s秒');


$send_subject = 'メールフォームからお問い合わせがありました。';
$additional_headers = "From:".$mail_address;
$send_body = <<<EOM

メールフォームからお問い合わせがありました。
お問い合わせの内容は以下の通りです。

--------------------------------------------------------------------------

送信時刻：{$now}
名前：{$name_1}　
メールアドレス：{$mail_address}
性別：{$gender}

お問い合わせの内容：
{$mail_contents}

--------------------------------------------------------------------------

EOM;


$my_result = mb_send_mail($send_address, $send_subject, $send_body, $additional_headers);






$thanks_subject = 'お問い合わせありがとうございました。';
$send_name = mb_encode_mimeheader($send_name, 'ISO-2022-JP');
$thanks_additional_headers = 'From:'.$send_name.' <'.$send_address.'>';
$thanks_body = <<<EOM
{$thanks_body_head}

---------------------------------------------------------------------------

送信時刻：{$now}
名前：{$name_1}　
メールアドレス：{$mail_address}
性別：{$gender}
お問い合わせの内容：
{$mail_contents}

---------------------------------------------------------------------------


この度はお問い合わせを頂き、重ねてお礼申し上げます。

{$thanks_body_foot}

EOM;


$you_result = mb_send_mail($mail_address, $thanks_subject, $thanks_body, $thanks_additional_headers);




if($my_result && $you_result){
	header('Location: '.$thanks_page_url);
}else{
	echo '<p>エラーが起きました。<br />ご迷惑をおかけして大変申し訳ありません。</p>';
	exit;
}


?>
