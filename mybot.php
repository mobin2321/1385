<?php

ob_start();
define('API_KEY','855756992:AAEk2i6KlgiEhfxmI2nJyrb16RSBI8l2El8');
ini_set("log_errors" , "off");
function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));}else{
return json_decode($res);}}
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$from_id = $message->from->id;
$textmessage = $message->text;
$user = json_decode(file_get_contents("data/$from_id.json"),true);
$step = $user["step"];
$Ktoken = $user["token"];
$url = $user["url"];
if (!file_exists("data/$from_id.json")) {
$myfile2 = fopen("data/id.txt", "a") or die("Unable to open file!");
fwrite($myfile2, "$from_id\n");
fclose($myfile2);
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id.json",$outjson);}
if($textmessage == "/start" or $textmessage == "ðŸ”™"){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id.json",$outjson);
	bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"Ø¨Ø§ Ø§ÛŒÙ† Ø±Ø¨Ø§Øª Ù…ÛŒØªÙˆÙ†ÛŒØ¯ Ø¨Ù‡ Ø§Ø¹Ø¶Ø§ÛŒ Ø±Ø¨Ø§Øª Ø®ÙˆØ¯ Ù¾ÛŒØ§Ù… Ù‡Ù…Ú¯Ø§Ù†ÛŒ Ø§Ø±Ø³Ø§Ù„ Ú©Ù†ÛŒØ¯ :/",
 'parse_mode'=>"HTML",
  'reply_to_message_id'=>$message_id,
  'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"send to all"]],
	],
"resize_keyboard"=>true,
	 ])
	 ]); 
 }
elseif($textmessage == "send to all"){
	$user["step"] = "send1";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id.json",$outjson);
	bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"ØªÙˆÚ©Ù† Ø±Ø¨Ø§ØªØª Ø±Ùˆ Ø¨Ø¯Ù‡",
 'parse_mode'=>"HTML",
  'reply_to_message_id'=>$message_id,
  'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"ðŸ”™"]],
	],
"resize_keyboard"=>true,
])
]); 
}
elseif($textmessage && $step == "send1"){
$user["step"] = "send2";
$user["token"] = $textmessage;
$outjson = json_encode($user,true);
file_put_contents("data/$from_id.json",$outjson);
	bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"Ø®Ø¨ Ø­Ø§Ù„Ø§ Ø¢Ø¯Ø±Ø³ ÙØ§ÛŒÙ„ Ø¢ÛŒØ¯ÛŒ Ø¹Ø¯Ø¯ÛŒ Ù‡Ø§ÛŒ Ø±Ø¨Ø§ØªØª Ø±Ùˆ Ø¨Ø¯Ù‡",
 'parse_mode'=>"HTML",
  'reply_to_message_id'=>$message_id,
  'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"ðŸ”™"]],
	],
"resize_keyboard"=>true,
 ])
 ]);}

elseif($textmessage && $step == "send2"){
$user["step"] = "send3";
$user["url"] = $textmessage;
$outjson = json_encode($user,true);
file_put_contents("data/$from_id.json",$outjson);
	bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"Ú†Ù‡ Ù¾ÛŒØ§Ù…ÛŒ Ø¨ÙØ±Ø³ØªÙ…ØŸ",
 'parse_mode'=>"HTML",
  'reply_to_message_id'=>$message_id,
  'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"ðŸ”™"]],
],
"resize_keyboard"=>true,
])
]); 
}
elseif($textmessage && $step == "send3"){
$user["step"] = "none";
$outjson = json_encode($user,true);
file_put_contents("data/$from_id.json",$outjson);
$co = rand(00000,99999);
file_put_contents("data/$co.txt",file_get_contents($url));
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"Ø´Ø±ÙˆØ¹ Ø´Ø¯ Ù„Ø·ÙØ§ Ø¯Ø³ØªÙˆØ±ÛŒ ÙˆØ§Ø±Ø¯ Ù†Ú©Ù†ÛŒØ¯ ØªØ§ Ú©Ø§Ø±Ù…Ùˆ Ø¨Ú©Ù†Ù…",
 'parse_mode'=>"HTML",
  'reply_to_message_id'=>$message_id,
]); 

$all_member = fopen("data/$co.txt", 'r');
while( !feof( $all_member)) {
$userss=fgets( $all_member);
file_get_contents("https://api.telegram.org/bot$Ktoken/sendmessage?parse_mode=html&chat_id=$userss&text=$textmessage");}
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"ØªÙ…ÙˆÙ… Ø´Ø¯ Ø¨Ù‡ Ù‡Ù…Ù‡ ÙØ±Ø³ØªØ§Ø¯Ù…",
 'parse_mode'=>"HTML",
]); 
unlink("data/$co.txt");
}
