<?php
/*
کانال سورس خونه ! پر از سورس هاي ربات هاي تلگرامي !
لطفا در کانال ما عضو شويد 
@source_home
https://t.me/source_home
*/
ob_start();
error_reporting(0);
date_default_timezone_set('Asia/Tehran');
//-----------------------------------------
$Dev =339434117;  //ایدی عددی ادمین
$channel = "source_home"; // ایدی کانال بدون @
//-----------------------------------------
define('API_KEY','855756992:AAEk2i6KlgiEhfxmI2nJyrb16RSBI8l2El8'); // توکن ربات
//-----------------------------------------
function Bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
//-----------------------------------------
function SendMessage($chat_id,$text,$mode,$reply = null,$keyboard = null){
	Bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>$text,
	'parse_mode'=>$mode,
	'reply_to_message_id'=>$reply,
	'reply_markup'=>$keyboard
	]);
}
function EditMessage($chat_id,$message_id,$text,$keyboard){
	Bot('editMessagetext',[
    'chat_id'=>$chat_id,
	'message_id'=>$message_id,
    'text'=>$text,
    'reply_markup'=>$keyboard
	]);
	}
function SendDocument($chatid,$document,$caption = null){
	Bot('SendDocument',[
	'chat_id'=>$chatid,
	'document'=>$document,
	'caption'=>$caption
	]);
}
function Forward($chatid,$from_id,$massege_id){
	Bot('ForwardMessage',[
    'chat_id'=>$chatid,
    'from_chat_id'=>$from_id,
    'message_id'=>$massege_id
    ]);
}
function Download($link, $path){
    $file = fopen($link, 'r') or die("Can't Open Url !");
    file_put_contents($path, $file);
    fclose($file);
    return is_file($path);
  }
function GetChat($chatid){
	$get =  Bot('GetChat',['chat_id'=>$chatid]);
	return $get;
}
function GetMe(){
	$get =  Bot('GetMe',[]);
	return $get;
} $botid = "@" . getMe() -> result -> username;
//-----------------------------------------
$update = json_decode(file_get_contents('php://input'));
if(isset($update->message)){
    $message = $update->message; 
    $chat_id = $message->chat->id;
    $text = $message->text;
    $message_id = $message->message_id;
    $from_id = $message->from->id;
    $tc = $message->chat->type;
    $first_name = $message->from->first_name;
    $last_name = $message->from->last_name;
    $username = $message->from->username;
    $caption = $message->caption;
    $reply = $message->reply_to_message->forward_from->id;
    $reply_id = $message->reply_to_message->from->id;
}
if(isset($update->callback_query)){
    $Data = $update->callback_query->data;
    $data_id = $update->callback_query->id;
    $chatid = $update->callback_query->message->chat->id;
    $fromid = $update->callback_query->from->id;
    $tccall = $update->callback_query->chat->type;
    $messageid = $update->callback_query->message->message_id;
}
//-----------------------------------------
$get = Bot('GetChatMember',[
'chat_id'=>"@".$channel,
'user_id'=>$from_id]);
$rank = $get->result->status;
//-----------------------------------------
$join = json_encode(['inline_keyboard'=>[
[['text'=>"📍 عضویت در کانال","url"=>"https://t.me/$channel"]],
],'resize_keyboard'=>true
]);
//-----------------------------------------
$about = json_encode(['inline_keyboard'=>[
[['text'=>"📢 کانال ما","url"=>"https://t.me/source_home"],['text'=>"👨‍💻 ارتباط با برنامه نویس","url"=>"https://t.me/TimeOFF"]],
],'resize_keyboard'=>true
]);
//-----------------------------------------
if($from_id != $Dev){
$menu = json_encode(['keyboard'=>[
[['text'=>"ترجمه متن 🤖"]],
[['text'=>"🚦 پشتیبانی"],['text'=>"🔖 درباره ما"]],
[['text'=>"تلفظ کلمه 🗣"]]
],'resize_keyboard'=>true]);
}else{
$menu = json_encode(['keyboard'=>[
[['text'=>"ترجمه متن 🤖"]],
[['text'=>"🚦 پشتیبانی"],['text'=>"🔖 درباره ما"]],
[['text'=>"تلفظ کلمه 🗣"]],
[['text'=>"🖲 مدیریت"]]
],'resize_keyboard'=>true]);
}
//-----------------------------------------
$tarj = json_encode(['inline_keyboard'=>[
[['text'=>"انگلیسی 🇱🇷",'callback_data'=>"en"],['text'=>"عربی 🇮🇶",'callback_data'=>"ar"]],
[['text'=>"روسی 🇸🇰",'callback_data'=>"ru"],['text'=>"فارسی 🇮🇷",'callback_data'=>"fa"]],
[['text'=>"ایتالیایی 🇮🇪",'callback_data'=>"it"],['text'=>"ژاپنی 🇰🇷",'callback_data'=>"ja"]],
[['text'=>"چینی 🇨🇳",'callback_data'=>"zh-CN"],['text'=>"المانی 🇩🇪",'callback_data'=>"de"]],
[['text'=>"ترکی 🇹🇷",'callback_data'=>"tr"],['text'=>"فرانسوی 🇫🇷",'callback_data'=>"fr"]],
[['text'=>"ازبکی 🇬🇺",'callback_data'=>"uz"],['text'=>"هندی 🇮🇳",'callback_data'=>"in"]],
[['text'=>"اوکراینی 🇨🇴",'callback_data'=>"uk"],['text'=>"تایلندی 🇨🇷",'callback_data'=>"ta"]]
],'resize_keyboard'=>true]);
//-----------------------------------------
$panel = json_encode(['keyboard'=>[
[['text'=>"📊 آمار"]],
[['text'=>"📬 ارسال همگانی"],['text'=>"📮 فروارد همگانی"]],
[['text'=>"▫️ برگشت ▫️"]]
],'resize_keyboard'=>true]);
//-----------------------------------------
$back = json_encode(['keyboard'=>[
[['text'=>"▫️ برگشت ▫️"]]
],'resize_keyboard'=>true]);
//-----------------------------------------
$backpanel = json_encode(['keyboard'=>[
[['text'=>"▫️ برگشت به پنل ▫️"]]
],'resize_keyboard'=>true]);
//-----------------------------------------
@$list = json_decode(file_get_contents("Data/list.json"),true);
@$data = json_decode(file_get_contents("Data/$from_id/data.json"),true);
@$step = $data['step'];
@$tlan = $data['tlan'];
//-----------------------------------------
if(preg_match('/^\/(start)$/i',$text)){
	SendMessage($chat_id,"سلام 😉 $first_name
  
به ربات مترجم خوش اومدید ❄️

با استفاه از این ربات راحت یه مترجم همراه اشته باشید و همه جا ازش استفاده کنید 🌟

🤖 $botid
از دکمه های زیر استفاده کن 🔻
برنامه نویسی آسان میشود با سورس خونه 👇👇
@Source_Home
همین الان به آسانی سورس مورد علاقه ات رو پیدا کن 
https://t.me/Source_Home",null, $message_id, $menu);
	$data['step'] = "none";
	file_put_contents("Data/$from_id/data.json",json_encode($data));
}
//-----------------------------------------
elseif($rank == 'left'){
	SendMessage($chat_id,"🍃  برای استفاده از این ربات لازم است ابتدا وارد کانال زیر شوید 

@$channel @$channel  📣
@$channel @$channel  📣

☑️ بعد از عضویت در کانال میتوانید از دکمه ها استفاده کنید", null, $message_id, $join);
}

elseif ($text == "🔖 درباره ما"){
	SendMessage($source_home,"این ربات توسط هورن  تیم ، ساخته شده است 📌

هرگونه کپی برداری از ربات ، غیرقانونی میباشد 🚫

📌 باتشکر از بعضی دوستان که در این پروژه ، به من کمک کردن",null, $message_id, $about);
$data['step'] = "none";
	file_put_contents("Data/$from_id/data.json",json_encode($data));
}

elseif($text == "▫️ برگشت ▫️"){
	SendMessage($chat_id,"🚦 به منوی قبلی بازگشتید",null, $message_id, $menu);
	$data['step'] = "none";
	file_put_contents("Data/$from_id/data.json",json_encode($data));
}
elseif ($text == "🚦 پشتیبانی"){
	SendMessage($chat_id,"نظرات شما باعث دلگرمی ماست❤️
➖➖➖➖➖
انتفادات پیشنهادات و نظرات خود را برای ما ارسال کنید✔️
➖➖➖
پیام خود را وارد کنید",null, $message_id, $back);
$data['step'] = "posh";
	file_put_contents("Data/$from_id/data.json",json_encode($data));
}

elseif($step == "posh"){
	SendMessage($chat_id,"📍 پیامی جدید از سوی کاربران :
✏️ نام : $first_name
✏️ یوزر : @$username
✏️ ایدی : $from_id
🔖 متن پیام :
$text
〰〰〰〰〰〰〰〰",null, $message_id);
	SendMessage($chat_id,"✅ پیام شما با موفقیت ارسال شد.",null, $message_id, $menu);
	$data['step'] = "none";
	file_put_contents("Data/$from_id/data.json",json_encode($data));
}

elseif($text == "ترجمه متن 🤖"){
	SendMessage($chat_id,"لطفا زبان مقصد رو انتخاب کنید 📍",null,$message_id, $tarj);
	$data['step'] = "none";
	file_put_contents("Data/$from_id/data.json",json_encode($data));
}

elseif(empty($Data) === false){
	$data = json_decode(file_get_contents("Data/$fromid/data.json"),true);
	$data['step'] = "tr";
	$data['language'] = (string) $Data;
	file_put_contents("Data/$fromid/data.json",json_encode($data));
	EditMessage($chatid,$messageid,"لطفا متن خود را ارسال کنید 📍",$join);
}

elseif($data['step'] == "tr" and empty($data['language']) === false and isset($text)){
	$get = json_decode(file_get_contents("http://api.novateamco.ir/translate/?to={$data['language']}&text=".urlencode($text)), true);
SendMessage($chat_id,"📍 ترجمه ی متن شما : 
        
		<code>{$get['result']}</code>

🆔 $botid","HTML",$message_id,$join);
unset($data['language']);
$data['step'] = "none";
file_put_contents("Data/$from_id/data.json",json_encode($data));
}

elseif ($text == "تلفظ کلمه 🗣"){
	SendMessage($chat_id,"به بخش تلفظ کلمه خوش اومدید 🗣

📌 اکنون متن خود را به انگلیسی ارسال کنید.","HTML",$message_id,$back);
$data['step'] = "speech";
file_put_contents("Data/$from_id/data.json",json_encode($data));
}

elseif($data['step'] == "speech"){
	if(preg_match('/^[\w\s?]+$/si',$text)){
		Download("http://api.novateamco.ir/translate/?speech=true&text=". urlencode($text),"$botid.mp3");
		Bot('SendAudio',[
        'chat_id' => $chat_id,
        'audio'=> new CURLFile("$botid.mp3"),
		'caption' => "تلفظ کلمه شما 🌟\n🆔 $botid",
		'reply_markup' => $menu
        ]);
		unlink("$botid.mp3");
		$data['step'] = "none";
        file_put_contents("Data/$from_id/data.json",json_encode($data));
        }else{
		SendMessage($chat_id,"خطا , ورودی فقط انگلیسی مجاز است !","HTML",$message_id);
	}
}

if($from_id == $Dev){
    if($text == "🖲 مدیریت" || $text == "▫️ برگشت به پنل ▫️"){
		$data['step'] = "none";
		file_put_contents("Data/$from_id/data.json",json_encode($data));
		SendMessage($chat_id,"■ یکی از گزینه های زیر را انتخاب کنید :", null, $message_id, $panel);
	}
    elseif($text == "📊 آمار"){
		$users = count(scandir("Data"))-4;
		$count = count($list['user'])-9;
		$lastmem = null;
		foreach($list['user'] as $key => $value){
			if($count <= $key){
				$lastmem .= "[$value](tg://user?id=$value) | ";
				$key++;
			}
		}
		SendMessage($chat_id,"■ تعداد کاربران ربات : $users\n■ 9 کاربر اخیر ربات :\n$lastmem", 'MarkDown', $message_id);
	}
	elseif($text == "📬 ارسال همگانی"){
		$data['step'] = "s2all";
		file_put_contents("Data/$from_id/data.json",json_encode($data));
		SendMessage($chat_id,"■ پیام مورد نظر را ارسال کنید", 'MarkDown', $message_id, $backpanel);
	}
	elseif($step == "s2all" and isset($text)){
		$data['step'] = "none";
		file_put_contents("Data/$from_id/data.json",json_encode($data));
		foreach(glob('Data/*') as $value){
		    if(is_dir($value)){
		        $id = pathinfo($value)['filename'];
			    SendMessage($id, $text, null, null, $menu);
		    }
		}
		SendMessage($chat_id,"■ پیام به تمامی اعضا ارسال شد", null, null, $panel);
	}
	elseif($text == "📮 فروارد همگانی"){
		$data['step'] = "f2all";
		file_put_contents("Data/$from_id/data.json",json_encode($data));
		SendMessage($chat_id,"■ پیام مورد نظر را فروارد کنید", 'MarkDown', $message_id, $backpanel);
	}
	elseif($step == "f2all" and isset($message)){
		$data['step'] = "none";
		file_put_contents("Data/$from_id/data.json",json_encode($data));
		foreach(glob('Data/*') as $value){
		    if(is_dir($value)){
		        $id = pathinfo($value)['filename'];
			    Forward($id,$chat_id,$message_id);
		    }
		}
		SendMessage($chat_id,"■ پیام به تمامی اعضا فروارد شد", null, null, $panel);
	}
}

if(!is_dir("Data/$from_id") and !is_null($from_id)){
	mkdir("Data/$from_id");
	touch("Data/$from_id/data.json");
    if($list['user'] == null){ $list['user'] = []; }
	array_push($list['user'], $from_id);
	file_put_contents("Data/list.json",json_encode($list));
}if(!is_dir("Data"))@mkdir("Data");
*/
?>
