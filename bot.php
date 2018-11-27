<?php
$chanel_id='1554124381';
$chanel_secret='4dcaf6dcf554a105cf64aaaf966cf7c7';
$access_token='3dpztB8bJVB0oLtKLyOQuuKAz+0kwImsk7qzUdI1d3cyp81lis9JeaqN/pMzQD9jIkULSUOFFJy8kbdBil3LJLeHMzsBMjhWqZe9MqLtOmiVW6Q5nLKsqnM5C2RjA+4Uw46Ojcm8crZFHd5Eb3/sIAdB04t89/1O/w1cDnyilFU=';
$uid='U276b787d18de24f2979a0fefd7cb1457';


$thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
$thai_month_arr=array(
    "0"=>"",
    "1"=>"มกราคม",
    "2"=>"กุมภาพันธ์",
    "3"=>"มีนาคม",
    "4"=>"เมษายน",
    "5"=>"พฤษภาคม",
    "6"=>"มิถุนายน", 
    "7"=>"กรกฎาคม",
    "8"=>"สิงหาคม",
    "9"=>"กันยายน",
    "10"=>"ตุลาคม",
    "11"=>"พฤศจิกายน",
    "12"=>"ธันวาคม"                 
);
function thai_date($time){
    global $thai_day_arr,$thai_month_arr;
    $thai_date_return="วัน".$thai_day_arr[date("w",$time)];
    $thai_date_return.= "ที่ ".date("j",$time);
    $thai_date_return.=" เดือน".$thai_month_arr[date("n",$time)];
    $thai_date_return.= " พ.ศ.".(date("Yํ",$time)+543);
    $thai_date_return.= "  ".date("H:i",$time)." น.";
    return $thai_date_return;
}


function answer($text){
	$regex = $str = '';
	$hint = '';
	while(true){
		$regex = '/ขอ.?(user|ยุสเซอ|ยูสเซอร์|ยุสเซอร์|ยูสเซอ|ลืมรหัสผ่าน)/i';
		if(preg_match($regex ,$text)){	
			$hint = "ถ้าไม่มี userPOLIS หรือ ลืมรหัส https://youtu.be/WmDH8G1Swv8";
			break;
		}
		
		$regex = '/(ขอบคุณ|thank|thanks|ขอบใจ)/i';
		if(preg_match($regex ,$text)){	
			$hint = "ยินดีครับ";
			break;
		}
		
		$regex = '/(สวัสดี|hi|hello)/i';
		if(preg_match($regex ,$text)){	
			$hint = "สวัสดีครับ";
			break;
		}
		
		$regex = '/(วันที่?|วันที่เท่าไร|กี่โมงแล้ว|กี่โมง|เวลา?)/i';
		if(preg_match($regex ,$text)){	
			$eng_date=time(); // แสดงวันที่ปัจจุบัน
			$hint = thai_date($eng_date);
			break;
		}
		
		$regex = '/(ฝันดี|goodnight)/i';
		if(preg_match($regex ,$text)){	
			$hint="ฝันดีเช่นกัน อย่าแอบคุยกับกิ๊กหล่ะ";
			break;
		}
		
		$regex = '/(ช่วยราชการ)/i';
		if(preg_match($regex ,$text)){	
			$hint = "กรณีมาช่วยราชการ แจ้งรายละเอียด เช่น 
			ร.ต.อ. จิรัฎฐ์ธรณ์ user 22X102 เลขปชช. 3252522588547 รอง สว.กลุ่มงาน ฯ ฐานข้อมูล ศทก. ไปช่วยราชการ รอง สว. จร. สภ.เมืองเพชรบุรี จว. เพชรบุรี";
			break;
		}
		
		$regex = '/(ขอ|ขอเพิ่ม|เพิ่ม).?(สิท|สิทธิ|สิด|สิทธิ์).?PTM/i';
		if(preg_match($regex ,$text)){	
			$hint = "ใครยังไม่มีสิทธิ PTM ขอที่นี่เท่านั้นนะครับ(เฉพาะสิทธิ PTM)https://docs.google.com/forms/d/e/1FAIpQLSf24tN-VSpIG-fakLQjvKdqAPPl3j5GWpbqnU_9FCMVN6d4qw/viewform";
			break;
		}
		
		$regex = '/ลืมรหัส.?(POLIS|โพลิส|โพริด|โปลิส|โพริส|ผ่าน)/i';
		if(preg_match($regex ,$text)){	
			$hint = "ถ้าไม่มี userPOLIS หรือ ลืมรหัส https://youtu.be/WmDH8G1Swv8";
			break;
		}
		
		$regex = '/Portable/i';
		if(preg_match($regex ,$text)){	
			$hint = "Q:การติดตั้ง Google Chrome Portable ทำอย่างไร
			A:ในกรณีที่นำใส่ Flashdrive แล้ว ทำตามนี้ได้เลย
			https://youtu.be/avefA-irJb4 ดาวน์โหลดที่นี่ https://drive.google.com/open?id=1G9-u6aohHKMBZQhWBKFedIurfhKJMb_6";
			break;
		}
		
		$regex = '/เข้า.?ระบบ{0,1}|.?PTM{0,1}.?ไม่ได้/i';
		if(preg_match($regex ,$text)){	
			$hint = "*** วีดีโอนี้มีทุกอย่าง  การขอ userPOLIS ขอใหม่ ลืมรหัส  การขอสิทธิPTM การเข้าใช้งาน PTM การขอและใช้งาน SSLVPN รีบดูก่อนลบ!! https://youtu.be/dYj-1GQe298";
			break;
		}
		
		
		$regex = '/(ขอสิท|ขอใช้งาน).?SSL.?VPN/i';
		if(preg_match($regex ,$text)){	
			$hint = "เพื่อความเข้าใจที่ดียิ่งขึ้นดูวีดีโอบรรยาย https://youtu.be/dYj-1GQe298
			ดาวน์โหลดไฟล์ SSLVPN https://drive.google.com/open?id=12r2Th4CyXGNs6y5Z_plOVfkR62wkqw0A
			ตัวอย่างเอกสาร https://drive.google.com/open?id=1uoZc-Q3PyR6xcy7Ndk9XqRi8JBTiFUVi
			";
			break;
		}
		
		$regex = '/(ssl){1,1}.?vpn.?คือ/i';
		if(preg_match($regex ,$text)){
			$hint = "SSL VPN เป็นช่่องทางพิเศษ เพื่อเข้าใช้งานระบบสารสนเทศตร.ผ่านอินเทอร์เน็ต จะทำให้ท่านทำงานได้จากทุกๆ ที่ เพื่อความเข้าใจที่ดียิ่งขึ้นดูวีดีโอบรรยาย https://youtu.be/dYj-1GQe298";
			break;
		}	
		
		$regex = '/^(bot|บอท){1,1}$/i';
		if(preg_match($regex ,$text)){	
			$hint = "สวัสดีครับ มีอะไรให้ช่วยครับ";
			break;
		}
		
		$regex = '/(ptm){1,1}.?คือ/i';
		if(preg_match($regex ,$text)){	
			$hint = "PTM(Police Ticket Management) เป็นระบบบริหารจัดการใบสั่งสำนักงานตำรวจแห่งชาติ ร่่วมพัมนาระบบโดยบริษัทกรุงไทยจำกัด ต้องเข้าใช้งานผ่านเครือข่าย POLIS
			โดยให้เปิดระบบ PTM ด้วย GC(Google Chrome) version 40++ ที่ http://172.17.29.39/ptm/ จะพบหน้า login ให้ใส่ username และ  pasword ที่ท่านใช้เข้าระบบ POLIS 
			หากไม่มี GC v.40++ ให้ดาวน์โหลดที่นี่ https://drive.google.com/open?id=1G9-u6aohHKMBZQhWBKFedIurfhKJMb_6 นำใส่ Flashdrive และ Extract เพื่อใช้งาน
			เพื่อความเข้าใจที่ดียิ่งขึ้นดูวีดีโอบรรยาย https://youtu.be/dYj-1GQe298";
			break;
		}
		
		$regex = '/เข้าระบบ.?ไม่ได้/i';
		if(preg_match($regex ,$text)){	
			$hint = "ทดลองเข้าระบบ PTM เงื่อนไข
			1. ต้องใช้ผ่านเครื่องที่เข้าระบบ POLIS ได้ ทดสอบด้วยการเปิดโปรแกรม IE(Internet Explorer)ที่ https://172.17.2.66/polis แล้ว Loginเข้า POLIS
			หากทำข้อ1. ได้ ให้เปิดระบบ PTM ด้วย GC(Google Chrome) version 40++ ที่ http://172.17.29.39/ptm/  
			จะพบหน้า login ให้ใส่ username และ  pasword ที่ท่านใช้เข้าระบบ POLIS ดูวีดีโอบรรยาย https://youtu.be/dYj-1GQe298";
			break;
		}
		
		/*การเงิน*/
		$regex = '/(เบิกเงินรางวัล)/i';
		if(preg_match($regex ,$text)){	
			$hint = "การเบิกเงินรางวัล ให้ทำเหมือนเดิมครับ แต่สิ่งที่มาช่วยการจัดสรรเงินรางวัล หน่วยงานสามารถเปิดดูรายงานการชำระเงิน PTM (มีชื่อ-นามสกุลผู้ออกใบสั่ง)+ statement ของหน่วยงานค่ะ
			ถ้าไม่แน่ใจในเรื่องระเบียบงั้นลองถามท่านรองรำไพตรงกองการเงินนะคะเพราะวันอบรมท่านรองก็มีพูดแล้ว ใช้รายงานจากระบบptm และstatement แทนค่ะ
			เพิ่มเติมอ่าน https://drive.google.com/open?id=1DjQ9AWg-o3m1bFAGe-6217AhQbYywpJV
			";
			break;
		}
		
		/*กรุงไทย*/
		$regex = '/คู่มือ{1}.*(ระบบ)*.?PTM/i';;
		if(preg_match($regex ,$text)){	
			$hint = "คู่มือการใช้งานระะบบ PTM ดาวน์โหลดที่นี่ https://drive.google.com/open?id=1FzBohUtB7lySvbKwLbzmELrHeteE4x1h";
			break;
		}
	
		break;		
	}//while	
	$str = $hint;	
	return $str;
}

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			$text_ex = $text;
			$text = answer($text_ex);
			
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];
			
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json'
			, 'Authorization: Bearer ' . $access_token);

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
}
echo "OK";
?>
