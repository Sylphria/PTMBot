<?php
/*
app url: https://citcdbbot.herokuapp.com/botpush.php

Channel ID
1571626777

Your user ID
U018cd1e5f1005fb928801b8d96cdef12

Channel access token (long-lived)

Channel secret
de9906fa3052f06ceaffca0a9a8f3f6e
*/
?>

<?php
/*
a:5:{s:4:"type";s:7:"message";s:10:"replyToken"
;s:32:"66a1180fd111483daa9b7546c99565aa"
;s:6:"source";a:2:{s:6:"userId"
;s:33:"U018cd1e5f1005fb928801b8d96cdef12"
;s:4:"type";s:4:"user";}s:9:"timestamp";i:1522515688532;s:7:"message"
;a:3:{s:4:"type";s:4:"text";s:2:"id";s:13:"7718613839544";s:4:"text";s:18:"สวัสดี";}}
*/

/*
get messege from controller
*/
//$jsonStr = file_get_contents("php://input"); //read the HTTP body.
ini_set('always_populate_raw_post_data', '-1');
$chanel_id='1571626777';
$chanel_secret='5c1b8ec178x68f419c55c049b73dd7eb7';

$access_token='oYv/DN7Iy0kKFacM6OKbyZ2mvc4h5WQfHsOvxBV12mw9jaF42DVD2XpHEVZSe3m4bxaSEWQXgbzEFKswtad9FH3iK4hiStJeRsmtMR3oQNSNQFunTq0sX3AU2fX7NBOPIJYE+YTjhM5sXidr4btKPzQdB04t89/1O/w1cDnyilFU=';
$uid='U018cd1e5f1005fb92880x1b8d96cdef12';
$content = file_get_contents('php://input');
$events = json_decode($content, true);

function wh_log($log_msg)
{
    $log_filename = "log";
    if (!file_exists($log_filename)) 
    {
        // create directory/folder uploads.
        mkdir($log_filename, 0777, true);
    }
    $log_file_data = $log_filename.'/log_' . date('d-M-Y') . '.log';
    file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
}
//wh_log(implode($data));//write log to file

function get_user_id(){
	
}

function get_bot_join_group(){
	
}

function mts_answer($text){
	global $chanel_id ,$chanel_secret ,$access_token ,$uid ,$event;
	while(true){
		$regex = '/what is my uid/i';
		if(preg_match($regex ,$text)){	
			$hint = "";
			
			break;
		}
		
		$regex = '/(list group you join)/i';
		if(preg_match($regex ,$text)){	
			$hint = "";
			break;
		}		

		break;
	}
	return $hint;
}//fn

function mts_push(){
	$data = json_decode(file_get_contents('php://input'), true);
	global $access_token;
	$strUrl = "https://api.line.me/v2/bot/message/push";
	$arrHeader = array();
	$arrHeader[] = "Content-Type: application/json";
	$arrHeader[] = "Authorization: Bearer {$access_token}";
	
	$arrPostData = array();
	if(isset($data['to'])){
		$arrPostData['to'] = $data['to'];
		$arrPostData['messages'][0]['type'] = "text";
		$arrPostData['messages'][0]['text'] = $data['text'];

		//CURL PROCESS
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$strUrl);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close ($ch);	
	}
}//fn
mts_push();

function mts_getuserdetail($userId){
	global $access_token;
	$url="https://api.line.me/v2/bot/profile/$userId";
	$arrHeader = array();
	$arrHeader[] = "Content-Type: application/json";
	$arrHeader[] = "Authorization: Bearer {$access_token}";	
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	//curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$result = curl_exec($ch);
	curl_close($ch);
	//echo $result . "\r\n";
	return $result;
}
/*********************************************************************
*
*
MAIN
*
*
*********************************************************************/
function mts_send($to,$text){	
	global $access_token;
	$strUrl = "https://api.line.me/v2/bot/message/push";
	$arrHeader = array();
	$arrHeader[] = "Content-Type: application/json";
	$arrHeader[] = "Authorization: Bearer {$access_token}";

	$arrPostData = array();

	$arrPostData['to'] =$to;
	$arrPostData['messages'][0]['type'] = "text";
	$arrPostData['messages'][0]['text'] = $text;

	//CURL PROCESS
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$strUrl);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$result = curl_exec($ch);
	curl_close ($ch);	
}//fn


if (!is_null($events['events'])) {
	foreach ($events['events'] as $event) {
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			$text = $event['message']['text'];
			$replyToken = $event['replyToken'];		
			$userId = $event['source']['userId'];
			$user_detail  = array();
			$user_detail_json = mts_getuserdetail($userId);			
			$user_detail = json_decode($user_detail_json,true);
			$displayName = $user_detail['displayName'];		
			
			/*
			if(strtolower($text) == 'get_groupid'){
				$url = 'https://api.line.me/v2/bot/message/reply';
				$groupId = $event['source']['groupId'];	
				$text = "current group id: $groupId";
				$messages = ['type' => 'text','text' => $text];
				$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
				];
				$post = json_encode($data);
				$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				$result = curl_exec($ch);
				curl_close($ch);
				echo $result . "\r\n";
				break;
			}
			
			if(strtolower($text) == 'botgo'){
				$groupId = $event['source']['groupId'];
				$url = "https://api.line.me/v2/bot/group/$groupId/leave";	
				$arrHeader = array();
				$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				//curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				$result = curl_exec($ch);
				curl_close($ch);
				//echo $result . "\r\n";
				mts_send($uid,$result);
				break;
			}
			*/
			
			$hint = '';						
			$hint = mts_answer($text);
			$text = "ขอตอบคำถามของคุณ $displayName ($userId) : " . $hint;			
			$messages = [
				'type' => 'text',
				'text' => $text
			];
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			echo $result . "\r\n";
		}
		/*
		elseif ($event['type'] == 'beacon' && $event['source']['type'] == 'user') {
			$userId = $event['source']['userId'];			
			$replyToken = $event['replyToken'];		
			$hwid = $event['beacon']['hwid'];			
			$text = "baecon ยินดีต้อนรับครับคุณ (userId: $userId hwid: $hwid)";
			//push
			mts_send($userId,$text);
		}
		*/
		/*
		elseif ($event['type'] == 'join' && $event['source']['type'] == 'group'){
			$groupId = $event['source']['groupId'];			
			$replyToken = $event['replyToken'];		
			$text = "ขอบคุณที่เชิญเข้ากลุ่มนะครับ(groupId: $groupId)";
			$messages = [
				'type' => 'text',
				'text' => $text
			];
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			echo $result . "\r\n";
		}
		*/
		elseif ($event['type'] == 'leave' && $event['source']['type'] == 'group') {
			$groupId = $event['source']['groupId'];	
			//$arr_groupdetail = json_decode(mts_getuserdetail($groupId),true);	
			//$groupDisplayName = $arr_groupdetail['displayName'];
			$text = "ผมถูกเตะออกจากกลุ่ม(groupId: $groupId)";
			mts_send($uid,$text);
		}
		/*
		elseif ($event['type'] == 'follow' && $event['source']['type'] == 'user') {
			$userId = $event['source']['userId'];			
			$replyToken = $event['replyToken'];		
			$user_detail_json = mts_getuserdetail($userId);			
			$user_detail = json_decode($user_detail_json,true);
			$displayName = $user_detail['displayName'];	
			$text = "ขอบคุณที่เพิ่มผมเป็นเพื่อนะครับ คุณ $displayName (userId: $userId)";
			$messages = [
				'type' => 'text',
				'text' => $text
			];
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			echo $result . "\r\n";
		}
		elseif ($event['type'] == 'unfollow' && $event['source']['type'] == 'user') {
			$userId = $event['source']['userId'];			
			$replyToken = $event['replyToken'];		
			$user_detail_json = mts_getuserdetail($userId);			
			$user_detail = json_decode($user_detail_json,true);
			$displayName = $user_detail['displayName'];	
			$text = "unfollow แล้วพบกันครับคุณ $displayName (userId: $userId)";			
		}
		*/
		else{
			
		}
	}
}
?>