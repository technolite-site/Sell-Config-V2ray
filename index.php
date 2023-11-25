 <?php 

 error_reporting(0);
date_default_timezone_set('Asia/Tehran');
error_reporting(0);
#-----------------------------#
#-----------------------------#
include ("main.php");
include ("config.php");
#-----------------------------#
#-----------------------------#
if(!is_dir("data")){
mkdir("data");
}
if(!is_dir("data/user")){
mkdir("data/user");
}
if(!is_dir("data/code")){
mkdir("data/code");
}
if(!is_dir("data/vpn")){
mkdir("data/vpn");
}
if(!is_dir("data/vpn/v2ray")){
mkdir("data/vpn/v2ray");
}
if(!is_dir("data/vpn/iran")){
mkdir("data/vpn/iran");
}
if(!is_dir("data/user/$from_id")){
mkdir("data/user/$from_id");
}
if(!is_dir("data/user/$from_id/vpn")){
mkdir("data/user/$from_id/vpn");
}
if(!is_dir("data/user/$from_id/vpn/v2ray")){
mkdir("data/user/$from_id/vpn/v2ray");
}
if(!is_dir("data/user/$from_id/vpn/iran")){
mkdir("data/user/$from_id/vpn/iran");
}
if(!file_exists("data/user/$from_id/coin.txt")){
file_put_contents("data/user/$from_id/coin.txt", "0");
}
if(!file_exists("data/helpcont")){
    file_put_contents("data/helpcont", "😑متن راهنما تنظیم نشده است !");
}
if(!file_exists("data/ex")){
    file_put_contents("data/ex", "0");
}
if(!file_exists("data/v2ray")){
    file_put_contents("data/v2ray", "0");
}
if(!file_exists("data/osm")){
    file_put_contents("data/osm", "خاموش");
}
if(!file_exists("data/channel")){
    file_put_contents("data/channel", "none");
}
#-----------------------------#
$step = file_get_contents ("data/user/$from_id/step.txt");
$coin = file_get_contents ("data/user/$from_id/coin.txt");
$helpcont = file_get_contents ("data/helpcont");
$cart = file_get_contents ("data/cart");
$o = "🔘 بازگشت";
$oo = "🔘 برگشت";
$channel = file_get_contents ("data/channel");
$truechannel = json_decode(file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=@$channel&user_id=".$from_id));
$tch = $truechannel->result->status;
$pooyaosm = file_get_contents ("data/osm");
$online = file_get_contents ("data/setting/online.txt");
$gar = file_get_contents ("data/setting/gar.txt");
$date = date ('y/m/d');
#-----------------------------#
$ex = file_get_contents ("data/ex");
$v2ray = file_get_contents ("data/v2ray");
#-----------------------------#
$back = json_encode(['keyboard'=>[
[['text'=>"$o"]],
],
'input_field_placeholder'=>"@zitactm",
'resize_keyboard' =>true]);
$bk = json_encode(['keyboard'=>[
[['text'=>"$oo"]],
],
'input_field_placeholder'=>"@zitactm",
'resize_keyboard' =>true]);
#-----------------------------#
#-----------------------------#
if($online == "🔴خاموش" and $chat_id != $dev){
sendmessage ($chat_id , "💥ربات از سوی ادمین خاموش است .");
exit();
}
#-----------------------------#
if ($pooyaosm == "روشن"){
if($tch != 'member' && $tch != 'creator' && $tch != 'administrator' && $chat_id != $dev){
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "
▫️شما در کانال اسپانسر عضو نیستید ⚜️
◼️عضو شوید و سپس /start را بفرستید",
            'parse_mode' => "html",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => "@$channel", 'url' => "https://telegram.me/$channel"]
                    ],
                    
                ]
            ])
        ]);
            exit();
	}}
#-----------------------------#
if($text == "/start" || $text == $o){
$key1 = json_encode(['keyboard'=>[
[['text'=>"🛒 خرید سرویس"]],
[['text'=>"💫 اطلاعات کاربری"],['text'=>"🎰گردونه شانس"],['text'=>"⚜ وضعیت سرویس ها"]],
[['text'=>"💡 آموزش اتصال"],['text'=>"🪫کد هدیه"],['text'=>"➕ افزایش موجودی"]],
],
'input_field_placeholder'=>"@zitactm",
'resize_keyboard' =>false]);
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "
▪︎ سلام $first_name عزیز به ربات فروش وی پی ان ما خوش آمدی :
",
'reply_markup'=>$key1,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "🛒 خرید سرویس"){
$key2 = json_encode(['keyboard'=>[
[['text'=>"🎖ایرانسل"],['text'=>"🎖همراه اول"]],
[['text'=>"$o"]],
],
'input_field_placeholder'=>"@zitactm",
'resize_keyboard' =>true]);
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "
💥لطفا اپراتور خود را از لیست زیر انتخاب کنید :
",
'reply_markup'=>$key2,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "⚜ وضعیت سرویس ها"){
$scan = scandir ("data/vpn/v2ray");
$tv2ray = count ($scan) - 2;
$scan1 = scandir ("data/vpn/iran");
$tex = count ($scan1) - 2;
$keyom = json_encode(['inline_keyboard' => [
[['text' =>"تعداد سرویس",'callback_data'=>"a"],['text'=>"قیمت(ریال)",'callback_data'=>"a"],['text' =>"نام سرویس",'callback_data'=>"a"]],
[['text' =>"$tex",'callback_data'=>"a"],['text'=>"$ex",'callback_data'=>"a"],['text' =>"🎖ایرانسل",'callback_data'=>"a"]],
[['text' =>"$tv2ray",'callback_data'=>"a"],['text'=>"$v2ray",'callback_data'=>"a"],['text' =>"🎖همراه اول",'callback_data'=>"a"]],
]]);
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "🎴 وضعیت سرویس های وی پی ان و همچنین قیمت های آنها به شرح ذیل می باشد :",
'reply_markup'=>$keyom,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
elseif($text == "🎖همراه اول"){
$scan = scandir ("data/vpn/v2ray");
$tv2ray = count ($scan) - 2;
if($coin < $v2ray){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "❌ متأسفانه موجودی شما جهت خرید این سرویس کافی نیست .",
'reply_markup'=>$back,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
exit();
}
if($tv2ray < 1){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "متاسفانه تعداد اکانت های این سرویس به اتمام رسیده است . لطفا بعدا مراجعه کنید .",
'reply_markup'=>$key1,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
exit();
}
else{
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "لطفا کمی صبر کنید ربات درحال ساخت فیلتر شکن شما می باشد ...",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
sleep ('5');
$a = $coin - $v2ray;
file_put_contents ("data/user/$from_id/coin.txt",$a);
$scan = scandir("data/vpn/v2ray");
$random = $scan[rand(2, count($scan) - 1)];
$a = file_get_contents ("data/vpn/v2ray/$random");
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "
✅ کانفیگ شما ساخته شد .
`$a`
",
'reply_markup'=>$key1,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/vpn/v2ray/acc.v2ray","$a");
unlink ("data/vpn/v2ray/$random");
file_put_contents ("data/user/$from_id/step.txt","none");
}
}
#-----------------------------#
if($text == "🪫کد هدیه"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "👈 کد هدیه را وارد کنید :",
'reply_markup'=>$back,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","okpopoa");
}
elseif ($step == "okpopoa"and $text != $o){
    
    $a = file_exists("data/code/$text");
    if($text == $a){
        
        $aa = file_get_contents ("data/code/$text");
        $b = $coin + $aa;
        file_put_contents ("data/user/$from_id/coin.txt",$b);
        unlink ("data/code/$text");
        sendmessage ($chat_id , "کد هدیه با موفقیت وارد شد و مبلغ $aa به حساب شما افزوده شد." , $back);
        file_put_contents ("data/user/$from_id/step.txt","none");
        
    }else{
        sendmessage ($chat_id , "کد هدیه اشتباه یا استفاده شده است.");
        file_put_contents ("data/user/$from_id/step.txt","none");
    }
    
}
#-----------------------------#
#-----------------------------#
elseif($text == "🎖ایرانسل"){
$scan = scandir ("data/vpn/iran");
$tv2ray = count ($scan) - 2;
if($coin < $ex){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "❌ متأسفانه موجودی شما جهت خرید این سرویس کافی نیست .",
'reply_markup'=>$back,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
exit();
}
if($tv2ray < 1){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "متاسفانه تعداد اکانت های این سرویس به اتمام رسیده است . لطفا بعدا مراجعه کنید .",
'reply_markup'=>$key1,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
exit();
}
else{
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "لطفا کمی صبر کنید ربات درحال ساخت فیلتر شکن شما می باشد ...",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
sleep ('5');
$a = $coin - $ex;
file_put_contents ("data/user/$from_id/coin.txt",$a);
$scan = scandir("data/vpn/iran");
$random = $scan[rand(2, count($scan) - 1)];
$a = file_get_contents ("data/vpn/iran/$random");
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "
✅ کانفیگ شما ساخته شد .
`$a`
",
'reply_markup'=>$key1,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/vpn/iran/acc.v2ray","$a");
unlink ("data/vpn/iran/$random");
file_put_contents ("data/user/$from_id/step.txt","none");
}
}
#-----------------------------#
if($text == "💡 آموزش اتصال"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "$helpcont",
'reply_markup'=>$key1,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
elseif($text == "🎰گردونه شانس"){
if($gar == "off"){
    bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"⛔ گردونه شانس توسط مدیریت خاموش شده است .‌",
    'parse_mode'=>"Markdown",
    ]);
}else{
$kop = json_encode(['keyboard'=>[
[['text'=>"🔔ارسال شانس"]],
[['text'=>"$o"]],
],
'input_field_placeholder'=>"@zitactm",
'resize_keyboard' =>true]);
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
🤯خب دوست عزیز با کلیک روی دکمه زیر یکی از اعداد برای شما نمایش داده می شود :

۱ - افزایش پنجاه هزار ریال
۲ - کاهش پنجاه هزار ریال
۳ - افزایش صد هزار ریال
۴ - پوچ
",
'reply_markup'=>$kop,
'parse_mode'=>"Markdown",
    ]);
}
}
#-----------------------------#
elseif($text == "🔔ارسال شانس"){
$datech = file_get_contents ("data/user/$from_id/datesh");
if($datech == $date){
sendmessage ($chat_id , "👻شما شانس خود را وارد کردید فردا مجددا تست کنید ." , $back);
file_put_contents ("data/user/$from_id/step.txt","none");
}else{
$rand = rand (1,4);
if($rand == "4"){
sendmessage ($chat_id , "
😁 شانس شما پوچ شد .
" , $back);
file_put_contents ("data/user/$from_id/step.txt","none");
}
if($rand == "3"){
sendmessage ($chat_id , "
😁 صد هزار ریال برای شما واریز شد .
" , $back);
$b = "100000";
$a = $coin + $b;
file_put_contents ("data/user/$from_id/coin.txt","$a");
file_put_contents ("data/user/$from_id/step.txt","none");
}
if($rand == "2"){
sendmessage ($chat_id , "
😁 پنجاه هزار ریال از شما کسر شد .
" , $back);
$b = "50000";
$a = $coin - $b;
file_put_contents ("data/user/$from_id/coin.txt","$a");
file_put_contents ("data/user/$from_id/step.txt","none");
}
if($rand == "1"){
sendmessage ($chat_id , "
😁 پنجاه هزار ریال برای شما واریز شد .
" , $back);
$b = "50000";
$a = $coin + $b;
file_put_contents ("data/user/$from_id/coin.txt","$a");
file_put_contents ("data/user/$from_id/step.txt","none");
}
file_put_contents ("data/user/$from_id/datesh","$date");
file_put_contents ("data/user/$from_id/step.txt","none");
}
}
#-----------------------------#
if($text == "💫 اطلاعات کاربری"){
$scan = scandir ("data/user/$from_id/vpn/v2ray");
$scan1 = scandir ("data/user/$from_id/vpn/iran");
$v2raybuy = count ($scan) - 2;
$exbuy = count ($scan1) - 2;
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "
📌 وضعیت کاربری شما در ربات ما :

🔢 شناسه عددی شما : `$chat_id`
💳 موجودی کل شما : *$coin ریال*
🔑 کانفیگ های همراه اول خریده شده : *$v2raybuy*
🎴 کانفیگ های ایرانسل خریده شده: *$exbuy*
",
'reply_markup'=>$key1,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "➕ افزایش موجودی"){
$rand  = rand (1,9);
$rand1 = rand (1,9);
$a = $rand + $rand1;
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "
♻️ لطفا جهت احراز هویت حاصل جمع زیر را وارد کنید :
$rand + $rand1 = ?
",
'reply_markup'=>$back,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/rand","$a");
file_put_contents ("data/user/$from_id/step.txt","rand");
}
elseif($step == "rand" and $text != $o){
$b = file_get_contents ("data/user/$from_id/rand");
if($text != $b){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "❌ حاصل وارد شده اشتباه است . لطفا دوباره تلاش کنید و از اعداد انگلیسی استفاده کنید .",
'reply_markup'=>$back,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","rand");
}
else{
$keycart = json_encode(['inline_keyboard' => [
[['text' =>"ارسال رسید",'callback_data'=>"sendres"]],
[['text' =>"خرید مستقیم از طریق زرین پال",'callback_data'=>"zarin"]],
]]);
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "
✅ احراز هویت با موفقیت انجام شد.

💳 برای شارژ حساب خود ابتدا مبلغ مورد نظر خود را به کارت زیر واریز کنید سپس از طریق دکمه ارسال رسید ، رسید بانکی را ارسال کنید .

شماره کارت :
`$cart`

با کلیک روی شماره کارت به صورت خودکار برای شما کپی می شود .
",
'reply_markup'=>$keycart,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","card");
}
}
#-----------------------------#
if($data == "sendres"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "✅ لطفا عکس رسید را برای من ارسال کنید :",
'reply_markup'=>$back,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","zitactm");
}
elseif($step == "zitactm" and $text != $o){
$photo = $update->message->photo;
$file_id = $update->message->photo[count($update->message->photo) - 1]->file_id;
bot ('sendphoto',[
'chat_id'=>$dev,
'photo'=>"$file_id",
'caption'=>"
✅ فرستاده شده توسط کاربر `$chat_id`
",
'parse_mode'=>"Markdown",

]);
sendmessage ($chat_id,"رسید یا موفقیت ارسال شد ."  , $key1);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($data == "zarin"){
$ok = json_encode(['inline_keyboard' => [
[['text' =>"💥خرید 100000 ریال💥",'url'=>"$pay/pay/index.php?id=$from_id&amount=100000"]],
[['text' =>"💥خرید 200000 ریال💥",'url'=>"$pay/pay/index.php?id=$from_id&amount=200000"]],
[['text' =>"💥خرید 500000 ریال💥",'url'=>"$pay/pay/index.php?id=$from_id&amount=500000"]],
[['text' =>"💥خرید 1000000 ریال💥",'url'=>"$pay/pay/index.php?id=$from_id&amount=1000000"]],
]]);
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "📌 لطفا یکی از بسته های زیر را انتخاب کنید :",
'reply_markup'=>$ok,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
#-----------------------------#
#-----------------------------#
elseif($from_id == $dev){
$key3 = json_encode(['keyboard'=>[
[['text'=>"➕ افزودن وی پی ان"],['text'=>"📊 وضعیت ربات"]],
[['text'=>"🔑 خدمات ارسال"],['text'=>"❌ حذف کل اکانتها"]],
[['text'=>"💳 تنظیمات مالی"],['text'=>"⚙ تنظیمات مدیریتی"]],
[['text'=>"🐣[خاموش|روشن] گردونه شانس"]],
],
'input_field_placeholder'=>"@zitactm",
'resize_keyboard' =>true]);
if($text == "/panel" || $text == $oo || $text == "پنل"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "👍 سلام ادمین عزیز خوش آمدی :",
'reply_markup'=>$key3,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "➕ افزودن وی پی ان"){
$key4 = json_encode(['keyboard'=>[
[['text'=>"+ کانفیگ ایرانسل"],['text'=>"+ کانفیگ همراه اول"]],
[['text'=>"$oo"]],
],
'input_field_placeholder'=>"@zitactm",
'resize_keyboard' =>true]);
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "✅ یکی از سرویس های موجود را انتخاب کنید :",
'reply_markup'=>$key4,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "+ کانفیگ همراه اول"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "🔑 لطفا کد کانکشن کانفیگ v2ray را وارد کنید :",
'reply_markup'=>$bk,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","cratev2ray");
}
if($step == "cratev2ray" and $text != $oo){
$rand = rand (1000,100000);
file_put_contents ("data/vpn/v2ray/$rand",$text);
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "✅🔑 کانکشن v2ray با موفقیت ذخیره شد و برای فروش اماده شد .",
'reply_markup'=>$key3,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "+ کانفیگ ایرانسل"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "🔑 لطفا کد کانکشن کانفیگ v2ray را وارد کنید :",
'reply_markup'=>$bk,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","cratev2ray1");
}
if($step == "cratev2ray1" and $text != $oo){
$rand = rand (1000,100000);
file_put_contents ("data/vpn/iran/$rand",$text);
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "✅🔑 کانکشن v2ray با موفقیت ذخیره شد و برای فروش اماده شد .",
'reply_markup'=>$key3,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "ℹ سایر خدمات"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "🙂 لطفا یکی از دسته های موجود را انتخاب کنید :",
'reply_markup'=>$key5,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "💳ثبت شماره کارت"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "
✅ شماره کارت خود را با اعداد انگلیسی وارد کنید :


شماره کارت فعلی : $cart
",
'reply_markup'=>$bk,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","pooya");
}
if($step == "pooya" and $text != $oo){
file_put_contents ("data/cart",$text);
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "👍 شماره کارت با موفقیت ثبت شد .",
'reply_markup'=>$key3,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "♧ تنظیم متن راهنمای اتصال"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "
✅ متن راهنمای اتصال را وارد کنید : انگلیسی یا فارسی یا تلفیقی یا ... مشکلی ندارد .

متن فعلی : $helpcont
",
'reply_markup'=>$bk,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","helpo");
}
if($step == "helpo" and $text != $oo){
file_put_contents ("data/helpcont",$text);
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "✅ با موفقیت ثبت شد",
'reply_markup'=>$key3,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "💰 تعیین قیمت"){
$moni = json_encode(['inline_keyboard' => [
[['text' =>"💫سرویس همراه اول",'callback_data'=>"d1"]],
[['text' =>"💫سرویس ایرانسل",'callback_data'=>"d2"]],
]]);
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "🙂 قصد تغییر دادن قیمت کدام سرویس را دارید ؟",
'reply_markup'=>$moni,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "📊 وضعیت ربات"){
$scan = scandir ("data/user");
$alluser = count ($scan) - 2;
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "
• نوع ربات : اختصاصی 💳
• وضعیت ربات : $online
• تعداد کاربران : $alluser کاربر
",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "➕ افزایش پول"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "💳 لطفا مبلغ مورد نظرتون رو با اعداد انگلیسی و به ریال وارد کنید :",
'reply_markup'=>$bk,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","plus");
}
if($step == "plus" and $text != $oo){
file_put_contents ("data/plus",$text);
sendmessage ($chat_id , "🔢 اکنون ایدی عددی کاربر مورد نظر را وارد کنید ." , $bk);
file_put_contents ("data/user/$from_id/step.txt","plus1"); 
}
if($step == "plus1" and $text != $o){
$coink = file_get_contents ("data/user/$text/coin.txt");
$a = file_get_contents ("data/plus");
$b = $coink + $a;
sendmessage ($chat_id , "✅ با موفقیت انجام شد .");
file_put_contents ("data/user/$text/coin.txt",$b);
sendmessage ($text , "
💳 از طرف مدیریت مبلغ $a تومان برای ما فرستاده شد .
");
file_put_contents ("data/user/$from_id/step.txt","none"); 
}
#-----------------------------#
if($text == "➖ کاهش پول"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "💳 لطفا مبلغ مورد نظرتون رو با اعداد انگلیسی و به ریال وارد کنید :",
'reply_markup'=>$bk,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","pluss");
}
if($step == "pluss" and $text != $oo){
file_put_contents ("data/plus",$text);
sendmessage ($chat_id , "🔢 اکنون ایدی عددی کاربر مورد نظر را وارد کنید ." , $bk);
file_put_contents ("data/user/$from_id/step.txt","pluss1"); 
}
if($step == "pluss1" and $text != $o){
$coink = file_get_contents ("data/user/$text/coin.txt");
$a = file_get_contents ("data/plus");
$b = $coink - $a;
sendmessage ($chat_id , "✅ با موفقیت انجام شد .");
file_put_contents ("data/user/$text/coin.txt",$b);
sendmessage ($text , "
💳 از طرف مدیریت مبلغ $a تومان از ما کم شد .
");
file_put_contents ("data/user/$from_id/step.txt","none"); 
}
#-----------------------------#
if($data == "d1"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "
💳 قیمت مد نظرتون رو برای این سرویس با یک عدد انگلیسی و به ریال وارد کنید .
مثال : 5000

قیمت فعلی این سرویس : $v2ray
",
'reply_markup'=>$bk,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","hala");
}
if($step == "hala" and $text != $oo){
file_put_contents ("data/v2ray",$text);
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "قیمت سرویس با موفقیت عوض شد .",
'reply_markup'=>$key3,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($data == "d2"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "
💳 قیمت مد نظرتون رو برای این سرویس با یک عدد انگلیسی و به ریال وارد کنید .
مثال : 5000

قیمت فعلی این سرویس : $ex
",
'reply_markup'=>$bk,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","halaa");
}
if($step == "halaa" and $text != $oo){
file_put_contents ("data/ex",$text);
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "قیمت سرویس با موفقیت عوض شد .",
'reply_markup'=>$key3,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "🔑 خدمات ارسال"){
$key6 = json_encode(['keyboard'=>[
[['text'=>"📥 فوروارد همگانی"],['text'=>"📤 ارسال همگانی"]],
[['text'=>"$oo"]],
],'resize_keyboard' =>true]);
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "
🛡 یکی از خدمات موجود را انتخاب کنید :
",
'reply_markup'=>$key6,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "💳 تنظیمات مالی"){
$key7 = json_encode(['keyboard'=>[
[['text'=>"💳ثبت شماره کارت"],['text'=>"💰 تعیین قیمت"]],
[['text'=>"➖ کاهش پول"],['text'=>"➕ افزایش پول"]],
[['text'=>"$oo"]],
],'resize_keyboard' =>true]);
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "🔑 یکی از خدمات موجود را انتخاب کنید :",
'reply_markup'=>$key7,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "📤 ارسال همگانی"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "📣 متن مورد نظرتون رو برای من ارسال کنید :",
'reply_markup'=>$bk,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","senall");
}
elseif($step == "senall" and $text != $oo){
if($text){
$allmmber = scandir ("data/user");
foreach ($allmmber as $sendall){
sendmessage ($sendall , $text);
}
sendmessage ($chat_id , "✅ پیام شما با موفقیت ارسال شد ‌.");
}else{
sendmessage ($chat_id , "🖊 شما فقط میتوانید متن ارسال کنید .");
}
}
#-----------------------------#
if($text == "📥 فوروارد همگانی"){
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "📣 رسانه مورد نظرتون رو برای من ارسال کنید :",
'reply_markup'=>$bk,
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","senalll");
}
elseif($step == "senalll" and $text != $oo){
$allmmber = scandir ("data/user");
foreach ($allmmber as $sendall){
bot('forwardMessage',[
'from_chat_id'=> $from_id,
'message_id'=> $message_id,
'chat_id'=> $sendall,
]);
}
sendmessage ($chat_id , "✅ پیام شما با موفقیت ارسال شد ‌.");
}
#-----------------------------#
if($text == "🎺 تنظیمات کانال"){
$keykhoda = json_encode(['keyboard'=>[
[['text'=>"خاموش|روشن قفل"],['text'=>"ست کانال"]],
[['text'=>"$oo"]],
],'resize_keyboard' =>true]);
sendmessage ($chat_id , "⚙ یکی از وضعیت های موجود را انتخاب کنید :" , $keykhoda);
}
elseif($text == "خاموش|روشن قفل"){
if ($pooyaosm == "خاموش"){
file_put_contents ("data/osm","روشن");
sendmessage ($chat_id , "🔑قفل جوین اجباری کانال فعال شد .");
file_put_contents ("data/user/$from_id/step.txt","none"); 
}else{
file_put_contents ("data/osm","خاموش");
sendmessage ($chat_id , "🔑قفل جوین اجباری کانال غیر فعال شد .");
file_put_contents ("data/user/$from_id/step.txt","none"); 
}
}
#-----------------------------#
if($text == "❌ حذف کل اکانتها"){
DeleteDirectory ("data/vpn");
bot('sendmessage',[
'chat_id'=> $chat_id,
'text'=> "✅ تمام اکانت های ثبت شده برای فروش از سرور ربات پاک شدند ‌.",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message_id,
]);
file_put_contents ("data/user/$from_id/step.txt","none");
}
#-----------------------------#
if($text == "⚙ تنظیمات مدیریتی"){
$key8 = json_encode(['keyboard'=>[
[['text'=>"💵 پول همگانی"],['text'=>"✂️خاموش|روشن"]],
[['text'=>"🏵ساخت کد هدیه"],['text'=>"🧑‍💻پشتیبان"]],
[['text'=>"🎺 تنظیمات کانال"],['text'=>"📖راهنما"]],
[['text'=>"♧ تنظیم متن راهنمای اتصال"]],
[['text'=>"$oo"]],
],'resize_keyboard' =>true]);
sendmessage ($chat_id , "👑 یکی از تنظیمات موجود را انتخاب کنید :" , $key8);
file_put_contents ("data/user/$from_id/step.txt","none"); 
}

if($text == "💵 پول همگانی"){
sendmessage ($chat_id , "🪙 لطفا مبلغ را به ریال و با اعداد انگلیسی وارد کنید :" , $bk);
file_put_contents ("data/user/$from_id/step.txt","cow"); 
}
if($step == "cow" and $text != $oo){
$allmmber = scandir ("data/user");
foreach ($allmmber as $alluser){
$a = file_get_contents ("data/user/$alluser/coin.txt");
$b = $a + $text;
file_put_contents ("data/user/$alluser/coin.txt",$b);
sendmessage ($alluser , "💸 از طرف مدیریت مبلغ $text ریال به صورت #همگانی به ما تعلق گرفت .");
}
sendmessage ($chat_id , "📤 مبلغ $text ریال به همه ی کاربران ربات ارسال شد ." );
file_put_contents ("data/user/$from_id/step.txt","none");
}

#-----------------------------#
if($text == "🏵ساخت کد هدیه"){
sendmessage ($chat_id , "🫠مبلغ کد هدیه را وارد کنید .

عدد انگلیسی و به ریال
"  , $bk);
file_put_contents ("data/user/$from_id/step.txt","okpooya"); 
}
if($step == "okpooya" and $text != $oo){
    $rand = rand (10000,100000);
    file_put_contents ("data/code/$rand",$text);
    sendmessage ($chat_id , "کد هدیه با موفقیت ساخته شد و به کانال مورد نظر ارسال گردید . n کد هدیه : $rand");
file_put_contents ("data/user/$from_id/step.txt","none"); 
}
#-----------------------------#

if ($text == "ست کانال"){
    
    bot ('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"آیدی کانال خود را بدون @ ارسال کنید .",
    'reply_markup'=>$bk,
    ]);
    
    file_put_contents ("data/user/$from_id/step.txt","setidok");

}

if ($step == "setidok" and $text != $oo){
    bot ('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"کانال @$text با موفقیت ذخیره شد",
    'reply_markup'=>$bk,
    ]);
    file_put_contents ("data/channel","$text");
    file_put_contents ("data/user/$from_id/step.txt","none");
}

#-----------------------------#
elseif ($text == "✂️خاموش|روشن"){
if ($online == "🟢روشن"){
sendmessage ($chat_id , "🔴ربات با موفقیت خاموش شد");
if(!is_dir("data/setting")){
mkdir ("data/setting");
}
file_put_contents ("data/setting/online.txt","🔴خاموش");
}else{
sendmessage ($chat_id , "🟢ربات با موفقیت روشن شد.");
if(!is_dir("data/setting")){
mkdir ("data/setting");
}
file_put_contents ("data/setting/online.txt","🟢روشن");
}
}
#-----------------------------#
elseif ($text == "🐣[خاموش|روشن] گردونه شانس"){
if ($gar == "on"){
sendmessage ($chat_id , "🏷گردونه شانس خاموش شد .");
file_put_contents ("data/setting/gar.txt","off");
}else{
sendmessage ($chat_id , "🥷گردونه شانس روشن شد .");
file_put_contents ("data/setting/gar.txt","on");
}
}
#-----------------------------#
if($text == "🧑‍💻پشتیبان"){
sendmessage ($chat_id , "اپدیت اینده اضافه می شود .");
}
#-----------------------------#
if($text == "📖راهنما"){
sendmessage ($chat_id , "اپدیت اینده اضافه می شود .");
}
#-----------------------------#

} //

