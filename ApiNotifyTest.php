<?php 

define('LINE_API',"https://notify-api.line.me/api/notify");
$token = ""; //ใส่Token ที่copy เอาไว้
$text =" ทดสอบ Line Notify";//ใส่Text ที่ต้องการให้แสดง

$res = notify_message($text,$token);
print_r($res);
function notify_message($message,$token){
 $queryData = array('message' => $message);
 $queryData = http_build_query($queryData,'','&');
 $headerOptions = array( 
         'http'=>array(
            'method'=>'POST',
            'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                      ."Authorization: Bearer ".$token."\r\n"
                      ."Content-Length: ".strlen($queryData)."\r\n",
            'content' => $queryData
         ),
		  'ssl'=>array(
			  'vertify_peer'=>false,
			  'vertify_peer_name'=>false,
         ),
	
 );
 $context = stream_context_create($headerOptions);
 $result = file_get_contents(LINE_API,FALSE,$context);
 $res = json_decode($result);
 return $res;
}
?>
