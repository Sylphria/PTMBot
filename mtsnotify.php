<?php
ini_set('always_populate_raw_post_data', '-1');
$chanel_id = '1571895102';
$chanel_secret = '5fcfe1c09cfb6c15e6dbb7fd7e98f5ca';
$access_token = '7PRaC0tYDFlCekUDlZTZaOSGtEGCocGLif88F3LPg2bHj597/m6KVoFPyqXUeMAsesjSrrChVA3bHLoqXoUvGP2gQsCRQAmGyWMStJfCfo3pt4tziWj7hjJsFLPA35c8WKJ6jD4IYsUS/0Xf9UqjSQdB04t89/1O/w1cDnyilFU=';
$bot_userid = 'U72463cc16e5223af5f846258dc83e590';
$uid = 'U72463cc16e5223af5f846258dc83e590';
$content = file_get_contents('php://input');
$events = json_decode($content, true);

/*******************************************************************
FUNCTION
********************************************************************/
function wh_log($log_msg){
    $log_filename = "log";
    if (!file_exists($log_filename)) 
    {
        // create directory/folder uploads.
        mkdir($log_filename, 0777, true);
    }
    $log_file_data = $log_filename.'/log_' . date('d-M-Y') . '.log';
    file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
}

function mts_answer($text,$userId){
	global $chanel_id ,$chanel_secret ,$access_token ,$uid ,$event;
	while(true){
		$hint='';
		$regex = '/your name\?/i';
		if(preg_match($regex ,$text)){	
			$hint = "I'm MTSNotify.";			
			break;
		}
		
		$regex = '/what is my uid/i';
		if(preg_match($regex ,$text)){	
			$hint = "Your user id is $userId";
			
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




/*******************************************************************
CALL FUNCTION
********************************************************************/
mts_push();







//main logic
if (!is_null($events['events'])){
	foreach ($events['events'] as $event){
		if ($event['type'] == 'message' && $event['message']['type'] == 'text'){
			$text = $event['message']['text'];
			$replyToken = $event['replyToken'];		
			$userId = $event['source']['userId'];
			$user_detail  = array();
			$user_detail_json = mts_getuserdetail($userId);			
			$user_detail = json_decode($user_detail_json,true);
			$displayName = $user_detail['displayName'];		
			if($text == 'my uid'){
				$hint = $userId;
			}
			if($hint != ''){
				$text = "ตอบคำถามของคุณ $displayName : " . $hint;			
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
		}
		elseif ($event['type'] == 'leave' && $event['source']['type'] == 'group'){
			$groupId = $event['source']['groupId'];	
			$text = "ผมถูกเตะออกจากกลุ่ม";
			mts_send($uid,$text);
		}
		else{
			
		}
	}
}//if
?>