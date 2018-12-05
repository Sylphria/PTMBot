<?php
$chanel_id='1554124381';
$chanel_secret='4dcaf6dcf554a105cf64aaaf966cf7c7';
$access_token='jgAhX6d4MS4O+oEZrL8xfb12vh6Zq5mKCfIx5F4pjdrBRrlhUaj2HChnWnmC55AAIkULSUOFFJy8kbdBil3LJLeHMzsBMjhWqZe9MqLtOmj1UVewSBSA0TdAC8fAeASRSOlLDZ4xYXW+ECxm+xbvogdB04t89/1O/w1cDnyilFU=';
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
	$footer_txt='';//"\nxxxxxxxxxxxx";
	$regex = $str = '';
	$hint = '';
	while(true){
	$regex = '/(ขอ|ลืม).?(user|ยุสเซอ|ยูสเซอร์|ยุสเซอร์|ยูสเซอ|รหัส).{0,20}polis/i';
		if(preg_match($regex ,$text)){	
			$hint = "ถ้าไม่มี userPOLIS หรือ ลืมรหัส https://drive.google.com/open?id=0B7nTI-InTW94MXBucjc1d1FKSDQ";
			break;
		}
		
		$regex = '/(ช่วยราชการ)/i';
		if(preg_match($regex ,$text)){	
		$hint = "กรณีมาช่วยราชการ แจ้งรายละเอียดที่นี่ https://goo.gl/forms/PCRror9giDgXwidX2
\nตรวจสอบรายการที่แอดมินทำแล้วที่นี่ https://docs.google.com/spreadsheets/d/1J6X6iHQ3SGpJZHhy1CzxWx1jx1qovK1dxR6YL9BlgQo/edit?usp=sharing";
			break;
		}

		$regex = '/(ขอ|ลืม).?(user|ยุสเซอ|ยูสเซอร์|ยุสเซอร์|ยูสเซอ|รหัส).{0,20}ptm/i';
		if(preg_match($regex ,$text)){	
		$hint = "user และ password ของระบบ PTM ใช้รหัสเดียวกับ Polis ดูวิธีขอได้ที่นี่
\n https://drive.google.com/open?id=0B7nTI-InTW94MXBucjc1d1FKSDQ";
			break;
		}
		
		$regex = '/(ดู|ตรวจ).?เลข13หลัก/i'; 
		if(preg_match($regex ,$text)){	
			$hint = "คู่มือการตรวจสอบเลข 13 หลัก 
			\nhttps://drive.google.com/open?id=1QDACQjiiPeENEhzhuCpyJk1Nrkd5ij6w";
			break;

		}
	
		$regex = '/(ขอ|ขอเพิ่ม|เพิ่ม|ขอใช้).{0,10}(สิท|สิทธิ|สิด|สิทธิ์).*PTM/i';
		if(preg_match($regex ,$text)){	
		$hint = "ใครยังไม่มีสิทธิ PTM ขอที่นี่เท่านั้นนะครับ(เฉพาะสิทธิ PTM)👉🏼 https://docs.google.com/forms/d/e/1FAIpQLSf24tN-VSpIG-fakLQjvKdqAPPl3j5GWpbqnU_9FCMVN6d4qw/viewform
\nตรวจสอบรายการที่กำหนดสิทธิ์ 👉🏼 https://docs.google.com/spreadsheets/d/1DzRGXqItzcjZ8APlkOKLX65bnp7oPzQkzuraMcuz4_o/edit?usp=sharing";
			break;
		}
		
		$is_match=false;
		$regex=array('/Portable/i','/(google chrome|googlechrome|กูเกิ้ลโครม){1,1}.{0,20}น้อยกว่า.{0,10}40/i');
		foreach($regex as $reg){
			
			if(preg_match($reg ,$text)){
				$is_match=true;
				$hint = "Q:การติดตั้ง Google Chrome Portable ทำอย่างไรA:หากต้องการติดตั้ง GC ver 40++ \nในกรณีที่นำใส่ Flashdrive แล้ว ทำตามนี้ได้เลย\nhttps://youtu.be/avefA-irJb4 ดาวน์โหลดที่นี่ https://drive.google.com/open?id=1G9-u6aohHKMBZQhWBKFedIurfhKJMb_6";
				break;
			}
					
		}
		if($is_match){
			break;
		}
	
	$is_match=false;
	$regex=array(
	'/กรอก.*(ข้อมูล|ใบสั่ง){1,1}.{0,10}ผิด/i'
	,'/(พิมพ์|พิม)(ข้อมูล|ใบสั่ง){1,1}.{0,10}ผิด/i'
	,'/บันทึก.*(ข้อมูล|ใบสั่ง){1,1}.{0,10}ผิด/i'
	,'/บันทึก.*(ข้อมูล|ใบสั่ง){1,1}.{0,10}ผิด/i'
	,'/แก้ไข.*ใบสั่ง/i'
	);
		foreach($regex as $reg){
			if(preg_match($reg ,$text)){
				$is_match=true;
$hint = "📍การแก้ไขการบันทึกใบสั่ง
\nใช้ user สว. เข้าเมนูค้นหา —> ยกเลิก—->ขอแก้ไขใบสั่งเล่มใหม่—> กดยืนยัน
\nจากนั้นนำเลขที่ใบสั่งนั้นบันทึกใหม่
\n Cr: NuPle Supaporn @KTB
";				
				break;
			}		

	$is_match=false;
	$regex=array(
'/login ล้มเหลว/i'
	);
		foreach($regex as $reg){
			if(preg_match($reg ,$text)){
				$is_match=true;
$hint = "
1.ทดสอบเข้าระบบ POLIS ว่าเข้าได้หรือไม่ หากไม่ได้ให้ขอรหัส POLIS พิมพ์คำว่า ขอรหัส polis
2.ถ้าเข้าระบบ polis ได้ให้โทรแจ้งกำลังพลบก.ของท่านเพื่อตรวจสอบการครองตำแหน่ง ให้จนท.ติ๊กครองตำแหน่ง
";			
				break;
			}		
		}
		if($is_match){
			break;
		}
		
		
	
	
	//
	$is_match=false;
	$regex=array(
	'/กรอก.*(ข้อมูล|ใบสั่ง){1,1}.{0,10}ผิด/i'
	,'/(พิมพ์|พิม)(ข้อมูล|ใบสั่ง){1,1}.{0,10}ผิด/i'
	,'/บันทึก.*(ข้อมูล|ใบสั่ง){1,1}.{0,10}ผิด/i'
	,'/บันทึก.*(ข้อมูล|ใบสั่ง){1,1}.{0,10}ผิด/i'
	,'/แก้ไข.*ใบสั่ง/i'
	);
		foreach($regex as $reg){
			if(preg_match($reg ,$text)){
				$is_match=true;
$hint = "📍การแก้ไขการบันทึกใบสั่ง
\nใช้ user สว. เข้าเมนูค้นหา —> ยกเลิก—->ขอแก้ไขใบสั่งเล่มใหม่—> กดยืนยัน
\nจากนั้นนำเลขที่ใบสั่งนั้นบันทึกใหม่
\n Cr: NuPle Supaporn @KBANK
";				
				break;
			}		
		}
		if($is_match){
			break;
		}
		
		
	/*
ปัญหา : เครื่องคอมพิวเตอร์สามารถเปิดหน้าเว็บระบบ CRIMES ระบบ POLIS ได้ตามปกติ แต่เมื่อเปิดเว็บระบบ PTM ด้วย Google Chrome  ที่ url http://172.17.29.39/ptm/#/login พบว่า เปิดได้บ้างไม่ได้บ้าง ต้องแก้ไขหรือตรวจสอบอย่างไร
ตอบ: ปัญหาเกิดจากมีการนำอุปกรณ์เครือข่ายอื่นๆ มาต่ออินเทอร์เน็ตเข้ากับเครือข่ายของสำนักงานตำรวจแห่งชาติ ให้นำอุปกรณ์นั้นๆออก หรือ ต่อสายเครือข่าย(LAN) จากเครือข่ายโดยตรง เข้ากับเครื่องคอมพิวเตอร์ที่มีปัญหานั้น ก็จะสามารถใช้งานระบบต่างๆของสำนักงานตำรวจแห่งชาติได้ตามปกติ
	*/
	//
	$is_match=false;
	$regex=array(
	'/ตรวจสอบ.{0,10}เครือข่าย.{0,10}ptm/i'	
	,'/เข้า.{0,20}ptm.{0,10}(ได้บ้างไม่ได้บ้าง|ได้บางครั้ง){1}/i'	
	,'บางครั้ง.{0,10}เข้าระบบ.{0,10}ptmได้/i'		
	);
		foreach($regex as $reg){
			if(preg_match($reg ,$text)){
				$is_match=true;
$hint = " 💬ปัญหา : เครื่องคอมพิวเตอร์สามารถเปิดหน้าเว็บระบบ CRIMES ระบบ POLIS ได้ตามปกติ แต่เมื่อเปิดเว็บระบบ PTM ด้วย Google Chrome  ที่ url http://172.17.29.39/ptm/#/login พบว่า เปิดได้บ้างไม่ได้บ้าง ต้องแก้ไขหรือตรวจสอบอย่างไร
\nตอบ: ปัญหาเกิดจากมีการนำอุปกรณ์เครือข่ายอื่นๆ มาต่ออินเทอร์เน็ตเข้ากับเครือข่ายของสำนักงานตำรวจแห่งชาติ􀄃􀄵!􏿿 ให้นำอุปกรณ์นั้นๆออก หรือ ต่อสายเครือข่าย(LAN) จากเครือข่ายโดยตรง เข้ากับเครื่องคอมพิวเตอร์ที่มีปัญหานั้น ก็จะสามารถใช้งานระบบต่างๆของสำนักงานตำรวจแห่งชาติได้ตามปกติ
";				
				break;
			}		
		}
		if($is_match){
			break;
		}
	
	//
	$is_match=false;
	$regex=array(
	'/สมัคร.{0,20}.?(ssl){0,1}.?vpn/i'
	,'/(ssl){1,1}.?vpn.?คือ/i'
	,'/(ขอสิท|ขอสิทธิ|ขอสิทธิ์|ขอใช้งาน|ขอใช้|ขอ).{0,20}SSL.?VPN/i'
	,'/(global protect|globalprotect|GP)/i'
	,'/(connect|เชื่อมต่อ){1,1}.*ssl.*(vpn){0,1}.*ไม่ได้/i'
	,'/ssl.*(vpn){0,1}.*(connect|เชื่อมต่อ){1,1}.*ไม่ได้/i'
	,'/(login|ล็อคอิน|ลอคอิน|ลอกอิน){1,1}.*(globalprotect|global protect|โกลบอล|โกลบอลโพเทค|โกลบอล โพเทค|โกบอล|โกบอนโพเทค|โกบอน โพเทค){1,1}.*ไม่ได้/i'
	,'/(ติดต่อ|เบอร์โทร|เบอโท|สอบถาม){1,1}.*(เครือข่าย|ssl|sslvpn|vpn){1,1}/i'
	,'/(กัลยา|มรกต|วรกร){1,1}/i'
	,'/ใช้(งาน)?ระบบ.*(PTM|POLIS|CRIMES|โปลิส|โพลิส|คราม).*(ที่บ้าน|ผ่านเน็ต|ผ่านอินเทอร์เน็ต|ผ่านเนต)/i'
	,'/(ต่ออายุ|เปลี่ยนรหัส).*VPN/i'
	,'/เข้าระบบ.{0,20}SSLVPN.{0,20}ไม่ได้/i'
	);
		foreach($regex as $reg){
			if(preg_match($reg ,$text)){
				$is_match=true;
$hint = "SSL VPN เป็นช่องทางพิเศษ เพื่อเข้าใช้งานระบบสารสนเทศตร.ผ่านอินเทอร์เน็ต จะทำให้ท่านทำงานได้จากทุกๆที่
\nเนื่องจาก ศทก. ได้เปลี่ยนแปลงระบบการลงทะเบียนขอ Username และ Password
สำหรับใช้งาน SSL-VPN ใหม่ จึงให้ท่านลงทะเบียนใหม่ พร้อมกรอกหมายเลข โทรศัพท์
เพื่อใช้ในการเข้าสู่ระบบในโปรแกรม Global Protect เปิดโปรแกรม Browser เช่น Google Chrome , IE หรือ Firefox และพิมพ์ที่อยู่เว็บไซต์ในช่อง
ด้านบนของโปรแกรม Browser เป็น http://118.175.46.5 หรือ www.sslvpn.police.go.th
\nดาวน์โหลดตัวอย่างเอกสาร https://drive.google.com/open?id=1uoZc-Q3PyR6xcy7Ndk9XqRi8JBTiFUVi
\n่มือการสมัครใช้งาน https://drive.google.com/file/d/1zG_m8NiEsnxBB3WW9r4YyosNW9qdM_M7/
\nหากพบปัญหาในการสมัครใช้งาน สามารถติดต่อได้ที่
\nLine ID : @citc.network
\n*กลุ่มงานเครือข่าย 022052209
\n*TOT ศทก. 02-205-1313 หรือ 1228 กด 1";				
				break;
			}		
		}
		if($is_match){
			break;
		}
		
		$regex = '/^(bot|บอท){1,1}$/i';
		if(preg_match($regex ,$text)){	
			$arr_hint=array('มีอะไรให้ช่วยครับ','ว่าไงครับ','บอทเป็นระบบอัตโนมัติไม่สามรถตอบคำถามตรงๆได้ครับ','สวัสดีครับ บอทรุ่นใหม่ไม่เหวี่ยง แต่กวนๆนิดหน่อย?','สวัสดีครับ ถามมาได้เลย ถามอะไรตอบได้ ถามมากๆตอบไม่ไหวครับ');
			$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];
			break;
		}

		$regex = '/^(อ้อมๆ){1,1}$/i';
		if(preg_match($regex ,$text)){	
			$arr_hint=array('อ้อมๆก็ไม่ไหวครับเปลืองน้ำมัน','อ้อมน้อยหรือ้อมใหญ่ครับ');
			$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];
			break;
		}

		$regex = '/^(บอทเต้น){1,1}$/i';
		if(preg_match($regex ,$text)){	
		$arr_hint=array('♪(┌・。・)┌   ┏(･o･)┛♪┗ (･o･) ┓  ┗(＾0＾)┓  °\(^▿^)/°');
		$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];
		break;
		}
		
		$regex = '/(ptm){1,1}.?คือ/i';
		if(preg_match($regex ,$text)){	
$hint = "PTM(Police Ticket Management) เป็นระบบบริหารจัดการใบสั่งสำนักงานตำรวจแห่งชาติ ร่่วมพัมนาระบบโดยบริษัทกรุงไทยจำกัด ต้องเข้าใช้งานผ่านเครือข่าย POLIS
\nโดยให้เปิดระบบ PTM ด้วย GC(Google Chrome) version 40++ ที่ http://172.17.29.39/ptm/ จะพบหน้า login ให้ใส่ username และ  pasword ที่ท่านใช้เข้าระบบ POLIS 
\nหากไม่มี GC v.40++ ให้ดาวน์โหลดที่นี่ https://drive.google.com/open?id=1G9-u6aohHKMBZQhWBKFedIurfhKJMb_6 นำใส่ Flashdrive และ Extract เพื่อใช้งาน";
			break;
		}
		
	
		/*การเงิน*/
		$regex = '/(เบิกเงินรางวัล|แบ่งเงินรางวัล|ส่วนแบ่งเงินรางวัล)/i';
		if(preg_match($regex ,$text)){	
$hint = "การเบิกเงินรางวัล ให้ทำเหมือนเดิมครับ แต่สิ่งที่มาช่วยการจัดสรรเงินรางวัล หน่วยงานสามารถเปิดดูรายงานการชำระเงิน PTM (มีชื่อ-นามสกุลผู้ออกใบสั่ง)+ statement ของหน่วยงานค่ะ
\nถ้าไม่แน่ใจในเรื่องระเบียบงั้นลองถามท่านรองรำไพตรงกองการเงินนะคะเพราะวันอบรมท่านรองก็มีพูดแล้ว ใช้รายงานจากระบบptm และstatement แทนค่ะ
\nเพิ่มเติมอ่าน https://drive.google.com/open?id=1DjQ9AWg-o3m1bFAGe-6217AhQbYywpJV";
			break;
		}
		
		/*กรุงไทย*/
		$regex = '/(คู่มือ|วิธีใช้งาน){1}.*(ระบบ)*.?PTM/i'; 
		if(preg_match($regex ,$text)){	
			$hint = "คู่มือการใช้งานระะบบ PTM ดาวน์โหลดที่นี่ https://drive.google.com/open?id=1g8dfK58g4_x4k9CKVzbyhGSjWX5uNTIe";
			break;
		}
		
		
	/*
	การแก้ไขการบันทึกใบสั่งเล่ม กรณีที่บันทึกผิด แล้วต้องการบันทึกใหม่
	วิธีการ
	1. เข้าเมนูยกเลิก (ด้วย user ระดับสว. เท่านั้น
	2. เลือกเหตุผลในการยกเลิก “ขอแก้ไขข้อมูลใบสั่งเล่ม” จากนั้นคอนเฟิรมหน้าจะแสดงว่า “สำเร็จ”
	3. สามารถนำเลขที่ใบสั่งดังกล่าว มาบักทึกได้อีกครั้ง
	*/	
		$is_match=false;
		$regex=array(
		'/บันทึกใบสั่งผิด/i'
		,'/ใบสั่งที่บันทึกผิด/i'
		,'/ใบสั่งที่บันทึกผิด.*แก้ไข.*(ยังไง|อย่างไร)/i'
		,'/ใบสั่งที่บันทึกผิด.*แก้ไขได้.*(|มั้ย|มั๊ย|หรือไม่)/i'		
		,'/บันทึกใบสั่งผิด.*แก้ไข.*(ยังไง|อย่างไร)/i'
		,'/บันทึกใบสั่งผิด.*แก้ไขได้.*(|มั้ย|มั๊ย|หรือไม่)/i'
		);
		foreach($regex as $reg){
			if(preg_match($reg ,$text)){
				$is_match=true;
$hint="การแก้ไขการบันทึกใบสั่งเล่ม กรณีที่บันทึกผิด แล้วต้องการบันทึกใหม่ วิธีการ
\n1. เข้าเมนูยกเลิก (ด้วย user ระดับสว. เท่านั้น
\n2. เลือกเหตุผลในการยกเลิก “ขอแก้ไขข้อมูลใบสั่งเล่ม” จากนั้นคอนเฟิรมหน้าจะแสดงว่า “สำเร็จ”
\n3. สามารถนำเลขที่ใบสั่งดังกล่าว มาบักทึกได้อีกครั้ง";
				break;
			}
		}
		if($is_match){
			break;
		}
		
		
		/*
		ส่งหมายเลขบัญชีไปที่ไหนครับ
		หากหน่วยงานใดที่เปิดบัญชีค่าปรับจราจร เป็นที่เรียบร้อยแล้ว สามารถส่งหนังสือแจ้งเลขที่บัญชีได้ที่ E-mail ดังนี้
		1.supaporn.suthamgosol@ktb.co.th
		2.chitra.paisalsutthidej@ktb.co.th
		3.kittisak.supanuch@ktb.co.th
		เพื่อให้ธนาคารนำไปดำเนินการผูกบัญชีในระบบ PTM
		*/
		$is_match=false;
		$regex=array(
		'/(ส่ง|แจ้ง){1,1}.*หมายเลขบัญชี.*/i'
		,'/(email|อีเมล|ติดต่อ).*กรุงไทย/i'		
		);
		foreach($regex as $reg){
			if(preg_match($reg ,$text)){
				$is_match=true;
$hint="
หากหน่วยงานใดที่เปิดบัญชีค่าปรับจราจร เป็นที่เรียบร้อยแล้ว สามารถส่งหนังสือแจ้งเลขที่บัญชีได้ที่ E-mail ดังนี้
\n1.supaporn.suthamgosol@ktb.co.th
\n2.chitra.paisalsutthidej@ktb.co.th
\n3.kittisak.supanuch@ktb.co.th
\nเพื่อให้ธนาคารนำไปดำเนินการผูกบัญชีในระบบ PTM
";
				break;
			}
		}
		if($is_match){
			break;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		

		
//law
/*		
		
		$is_match=false;
		$regex=array('/(รหัสข้อหา)/i'
		,'/ฝ่า.{0,200}ไฟ.{0,10}แดง/i'
		,'/ขับ.{0,150}(หวาดเสียว|ประมาท)/i'
		,'/ขับรถเร็ว/i'
		,'/(ขับ){0,1}(รถ){0,1}.{0,10}ย้อนศร/i'
		,'/(หยุดหลังเส้น|หยุดรถหลังเส้น)/i'
		,'/เข็มขัดนิรภัย/i'
		,'/(คนโดยสาร|ผู้โดยสาร){1,1}.{0,100}(เข็มขัด){1,1}(นิรภัย){0,1}/i'
		,'/(คนโดยสาร|ผู้โดยสาร){1,1}.{0,20}(ไม่คาด|ไม่รัด){1,1}.{0,20}เข็มขัด/i'
		,'/กีดขวางการจราจร/i'
		,'/(ขับ|ขี่){0,1}.{0,100}บนทางเท้า/i'
		,'/(ไม่สวมหมวก|ไม่ใส่หมวก)/i'
		,'/บรรทุกสูง/i'
		,'/(ไม่){1,1}(นำ|พก){1,1}(ใบอนุญาติ|ใบขับขี่){1,1}/i'
		,'/บรรทุก.{0,10}ไม่ปกคลุม/i'
		);
		foreach($regex as $reg){
			if(preg_match($reg ,$text)){
				$is_match=true;
$hint="📍 10040 ขับรถฝ่าฝืนสัญญาณจราจรไฟสีแดง หรือเครื่องหมายจราจรสีแดงที่มีคำว่า หยุด
\n📍 10078 ขับรถโดยประมาทหรือน่าหวาดเสียวอันอาจเกิดอันตรายแก่บุคคลหรือทรัพย์สิน
\n📍 10177 ขับรถเร็ว เกินอัตรากำหนด
\n📍 10052 ขับรถฝ่าฝืนทิศทางเดินรถ (ย้อนศร)
\n📍 10041 ไม่หยุดรถหลังเส้นให้รถหยุด ตามสัญญาณจราจรไฟสีแดงหรือเครื่องหมายจราจรสีแดงที่มีคำว่า หยุด
\n📍 10293 ผู้ขับขี่ไม่รัดเข็มขัดนิรภัยไว้กับที่นั่งในขณะขับขี่
\n📍 10294 ผู้ขับขี่ไม่จัดให้คนโดยสารซึ่งนั่งที่นั่งตอนแถวหน้าเดียวกับผู้ขับขี่ไว้กับที่นั่งด้วยเข็มขัดนิรภัย
\n📍 10295 คนโดยสารไม่รัดร่างกายด้วยเข็มขัดนิรภัยไว้กับที่นั่งขณะโดยสารรถยนต์
\n📍 10077 ขับรถในลักษณะกีดขวางการจราจร
\n📍 10082 ขับรถบนทางเท้าโดยไม่มีเหตุอันสมควร
\n📍 10290 ผู้ขับขี่รถจักรยานยนต์ไม่สวมหมวกนิรภัยที่จัดทำขึ้นโดยเฉพาะ เพื่อป้องกันอันตรายในขณะขับขี่
\n📍 10369 บรรทุกสูงเกินกว่าที่กำหนดไว้ในกฎกระทรวง(ฉบับที่ 4 พ.ศ.2522) ข้อ1(3)
\n📍 20053 ไม่นำใบอนุญาตขับรถติดตัวขณะขับรถ
\n📍 10360 บรรทุกสิ่งของไม่ปกคลุม";
				break;
			}
		}
		if($is_match){
			break;
		}
		
		//2
		$is_match=false;
		$regex=array(
		'/ไม่มั่นคงแข็งแรง/i'
		,'/(รถ)+.{0,150}ไม่จดทะเบียน/i'
		,'/(รถ)+.{0,150}ไม่เสียภาษี/i'
		,'/(รถ)+.{0,150}ไม่มี.{1,10}ทะเบียน/i'
		,'/(จอดรถ)+.{0,150}กีดขวาง/i'
		,'/(รถ)+.{0,150}(ไม่แสดง){1}(เครื่องหมาย|ใบ){1,1}เสียภาษี/i'
		,'/(รถ)+.{0,150}(ส่วนควบ|อุปกรณ์){1,1}ไม่ครบ/i'
		,'/(เปลี่ยนแปลง|ดัดแปลง){1,1}.{0,15}รถ/i'
		,'/(รถ){1,1}.{0,150}(ไม่ติด|มิติด){1,1}(แผ่นป้าย|ป้าย){1,1}/i'
		,'/(รถ){1,1}.{0,150}ป้ายแดง/i'
		,'/(รถ){1,1}.{0,150}(ไม่ได้|ไม่มี){1,1}.?(ใบอนุญาต|ใบอนุญาติ){1,1}/i'
		,'/(รถ){1,1}.{0,150}(ใบอนุญาต|ใบอนุญาติ){1,1}.?(หมดอายุ|สิ้นอายุ){1,1}/i'
		,'/(ผู้ขับขี่|เจ้าของ){1,1}.{0,150}ใบสั่ง.{0,30}ไม่ชำระ/i'
		);
		foreach($regex as $reg){
			if(preg_match($reg ,$text)){
				$is_match=true;
$hint="📍 10001นำรถที่มีสภาพไม่มั่นคงแข็งแรงอาจเกิดอันตรายหรือทำให้เสื่อมเสียสุขภาพอนามัยใช้ในทางเดินรถ
\n📍 40001เจ้าของรถไม่จัดทำประกันความเสียหายสำหรับผู้ประสพภัยโดยประกันภัยกับบริษัท
\n📍 10357ผู้ใดขับรถโดยไม่แสดงใบอนุญาตขับรถและสำเนาภาพถ่ายคู่มือจดทะเบียนรถ
\n📍 20013ใช้รถไม่จดทะเบียน
\n📍 20014ใช้รถไม่เสียภาษีประจำปีในเขตกำหนด
\n📍 20016ใช้รถไม่มีแผ่นป้ายทะเบียนรถ
\n📍 10161จอดรถในลักษณะกีดขวางการจราจร
\n📍 20017ใช้รถไม่แสดงเครื่องหมายเสียภาษีประจำปี
\n📍 20018ใช้รถที่มีส่วนควบหรืออุปกรณ์ไม่ครบถ้วน
\n📍 10002นำรถที่มีเครื่องยนต์หรือเครื่องอุปกรณ์หรือส่วนควบไม่ครบมาใช้ในทางเดินรถ
\n📍 20020เปลี่ยนแปลงสภาพรถ
\n📍 10003นำรถที่มิติดแผ่นป้ายเลขทะเบียนมาใช้ในทางเดินรถ
\n📍 20030ขับรถยนต์ที่มีไว้เพื่อขายหรือซ่อม(ป้ายแดง)โดยไม่ได้รับอนุญาต
\n📍 20031ขับรถยนต์ที่มีไว้เพื่อขายหรือซ่อม(ป้ายแดง)ในเวลากลางคืนโดยไม่ได้รับอนุญาต
\n📍 20032ขับรถยนต์ที่มีไว้เพื่อขายหรือซ่อม(ป้ายแดง)ไม่บันทึกรายการตามที่กฎหมายกำหนด
\n📍 20034ขับรถโดยไม่ได้รับใบอนุญาตขับรถ
\n📍 20044ขับรถเมื่อใบอนุญาตขับรถสิ้นอายุ
\n📍 10347ผู้ขับขี่หรือเจ้าของซึ่งได้รับใบสั่ง ไม่ชำระค่าปรับตามจำนวนที่ระบุไว้ในใบสั่ง";
				break;
			}
		}
		if($is_match){
			break;
		}
		
*/		
		
		
		
		
		/*
		รบกวนสอบถามค่ะการชำระค่าปรับกับธนาคารแล้วใบขับขี่ที่โดนยึดเขาจะส่งมาที่บ้านไหมค่ะ
		*/
		$is_match=false;
		$regex=array(
		'/ใบขับขี่.{0,10}.{0,10}(โดน|ถูก).{0,1}ยึด/i'
		,'/ยึด.{0,10}ใบขับขี่/i'		
		);
		foreach($regex as $reg){			
			if(preg_match($reg ,$text)){
				$is_match=true;
				$arr_hint=array("ใบสั่งที่เรียกเก็บใบขับขี่ จะไม่สามารถชำระทางธนาคารได้ครับ  แนะนำไม่ต้องยึดใบขับขี่");
				$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];	
				break;
			}
		}
		if($is_match){
			break;
		}
		
		/*
		ระเบียบ ตร. ว่าด้วยการชำระค่าปรับทางไปรษณ
		*/
		$is_match=false;
		$regex=array(
		'/ระเบียบ.{0,10}ชำระค่าปรับ.{0,10}(ทาง){0,1}.{0,10}(ไปรษณีย์|ปณ|ปณ\.)/i'
		,'/ชำระค่าปรับ.{0,10}(ทาง){0,1}.{0,10}(ไปรษณีย์|ปณ|ปณ\.){1,1}.{0,10}ระเบียบ/i'
		);
		foreach($regex as $reg){			
			if(preg_match($reg ,$text)){
				$is_match=true;
				$arr_hint=array("อยู่ที่นี่ https://drive.google.com/open?id=1DjQ9AWg-o3m1bFAGe-6217AhQbYywpJV ไฟล์ 
\n📍ตย. แจ้งบัญชีเงินค่าปรับจราจร
\n📍ระเบียบ ตร. ว่าด้วยการชำระค่าปรับทางไปรษณีย์");
				$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];	
				break;
			}
		}
		if($is_match){
			break;
		}
		
		/*
		เขียนใบเหลือง
		*/		
		$is_match=false;
		$regex=array(
		'/(เปรียบเทียบปรับ){0,1}.*เขียนใบเหลือง/i'		
		);
		foreach($regex as $reg){			
			if(preg_match($reg ,$text)){
				$is_match=true;
				$arr_hint=array("กรณีชำระค่าปรับทางธนาคารไม่ต้องเขียนครับ ม141(3) พรบ.จราจร ครับ(เครดิต รองเอกราชฯ)");
				$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];	
				break;
			}
		}
		if($is_match){
			break;
		}
		
		
		//รับข้อเสนอแนะเพื่อแก้ไข ปรับปรุงระบบ PTM
		$is_match=false;
		$regex=array(
		'/(ปัญหา|ปันหา|ข้อเสนอ|ข้อเสนอแนะ)+.*(การใช้งาน)*.*ptm/i'
		,'/(ปรับปรุง|แก้ไข)+ptm/i'
		,'/แจ้ง.*(แอดมิน|admin)+/i'
		,'/เสนอความคิด/i'
		,'/ระบบ.*(ปันหา|ปัญหา|ห่วย)/i'		
		);
		foreach($regex as $reg){			
			if(preg_match($reg ,$text)){
				$is_match=true;
				$arr_hint=array("📢ระบบ PTM(ระบบบริหารจัดการใบสั่งจราจร สำนักงานตำรวจแห่งชาติ) เริ่มใช้งานไปได้สักพักหนึ่งแล้ว หากระบบมีข้อผิดพลาด หรือ ท่านมีข้อเสนอแนะเพื่อปรับปรุงระบบให้ใช้งานสะดวก ตรงตามความต้องการมากขึ้น  กรุณาแจ้งที่นี่ได้เลยครับ
https://goo.gl/forms/yNuTiwdj2lz7bVX43 📢📢📢\nช่วยนำไปประชาสัมพันธ์ในกลุ่มอื่นๆ ด้วยนะครับ");
				$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];	
				break;
			}
		}
		if($is_match){
			break;
		}
	
		//other
		$is_match=false;
		$regex=array('/(สมุดโทรศัพท์|สมุดโทสับ)+/i');
		foreach($regex as $reg){			
			if(preg_match($reg ,$text)){
				$is_match=true;
				$arr_hint=array("☎ สมุดโทรศัพท์ตำรวจ ปี 2559 https://drive.google.com/open?id=1y8cICdGwczsuhoQHs2_kF0uDjxPPoeup");
				$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];	
				break;
			}
		}
		if($is_match){
			break;
		}
		
		
		$is_match=false;
		$regex=array('/กินข้าว.?(ยัง|มั้ย|ด้วยกันมั้ย|\?){1,1}/i', '/หิวข้าว.?(ยัง|มั้ย|\?){1,1}/i');
		foreach($regex as $reg){
			
			if(preg_match($reg ,$text)){
				$is_match=true;
				$arr_hint=array('ยังเลยครับ','กินแล้วครับ','ยังไม่หิวครับ','จะเลี้ยงเหรอ');
				$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];	
				break;
			}
					
		}
		if($is_match){
			break;
		}
		
		//
		$is_match=false;
		$regex=array('/(บอท|bot){1,1}.*สบายดี.*(มั้ย|มั๊ย){1,1}/i'
		,'/(บอท|bot){1,1}.*(เป็น|เป้น){1,1}.*(ไง|อย่างไง|ยังไง).*(มั่ง|บ้าง){0,1}/i'
		,'/(บอท|bot){1,1}.*how are you\?/i'
		);
		foreach($regex as $reg){
			
			if(preg_match($reg ,$text)){
				$is_match=true;
				$arr_hint=array('สบายดีครับ','ไม่ค่อยสบาย ว่าจะลาเปื่อย',"i'm so good.",'รู้สึกเหนื่อยๆ พักนี้ตอบคำถามเยอะครับ');
				$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];	
				break;
			}
					
		}
		if($is_match){
			break;
		}
		
		//
		$is_match=false;
		$regex=array(
		'/กิน.*(เมื่อไร|เมื่อไหร่){1,1}/i'
		,'/(เมื่อไร|เมื่อไหร่){1,1}.*กิน/i'
		);
		foreach($regex as $reg){
			
			if(preg_match($reg ,$text)){
				$is_match=true;
				$arr_hint=array('ถามหลายแท้');
				$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];	
				break;
			}
					
		}
		if($is_match){
			break;
		}
		
		//
		$is_match=false;
		$regex=array('/(กินกับอะไร|กินอะไรดี|กินไรดี|กินอะไรกันดี|กินไรกันดี)/i');
		foreach($regex as $reg){
			
			if(preg_match($reg ,$text)){
				$is_match=true;
				$arr_hint=array('ของฟรีกินหมดล่ะ','จะเลี้ยงเหรอ','อะไรก็ได้ที่ท่านเลี้ยง','ไม่รู้กินไรดี');
				$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];	
				break;
			}
					
		}
		if($is_match){
			break;
		}
		
		//
		$regex = '/บอท.?ชื่อ.?(อะไร|ไร|)/i';
		if( preg_match($regex ,$text) ){
			$arr_hint=array('บอทครับ','Botน้อยครับ','ณเดชครับ อิอิ','ชื่อนั้นสำคัญไฉน');
			$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];	
			break;
		}
		
		
		//
		$regex = '/(dbbot|bot|บอท){1,1}.*(ขอบคุณ|thank|thanks|ขอบใจ)/i';
		if(preg_match($regex ,$text)){	
			$arr_hint=array('ด้วยความยินดี','ไม่เป็นไรครับ','ยินดีครับ');
			$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];		
			break;
		}
		
		//
		$regex = '/^(สวัสดี|hi|hello)$/i';
		if(preg_match($regex ,$text)){	
			$arr_hint=array('สวัสดีครับ','HI','Hello','ดีครับ','What up?');
			$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];
			break;
		}
		
		
		
		//รับข้อเสนอแนะเพื่อแก้ไข ปรับปรุงระบบ PTM
		$is_match=false;
		$regex=array(
		'/ขอ.{0,20}ออกจากกลุ่ม/i'
		);
		foreach($regex as $reg){			
			if(preg_match($reg ,$text)){
				$is_match=true;
				$arr_hint=array("โชคดีครับ","BYE BYE","Goodluck","OK OK","แล้วพบกันใหม่นะ");
				$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];	
				break;
			}
		}
		if($is_match){
			break;
		}
		
		
		
		$regex = '/^(ฝันดี|goodnight)$/i';
		if(preg_match($regex ,$text)){	
			$arr_hint=array("ฝันดีเช่นกัน อย่าแอบคุยกับกิ๊กหล่ะ"
			,'Goodnight'
			,'ฝันดีจ้า'
			,'คืนนี้เธอฝันถึงใคร คืนไหนจะฝันถึงเรา'
			,'นอนจริงปะเนี่ย  เครๆ ฝันดี'
			);
			$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];
			break;
		}
	
		//
		$is_match=false;
		$regex=array('/กินข้าว.?(ยัง|มั้ย|ด้วยกันมั้ย|\?){1,1}/i','/หิวข้าว.?(ยัง|มั้ย|\?){1,1}/i');
		foreach($regex as $reg){
			
			if(preg_match($reg ,$text)){
				$is_match=true;
				$arr_hint=array('ยังเลยครับ','กินแล้วครับ','ยังไม่หิวครับ','จะเลี้ยงเหรอ');
				$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];	
				break;
			}
					
		}
		if($is_match){
			break;
		}
		
		//
		$regex = '/^(วันที่|วันที่เท่าไร|กี่โมงแล้ว|กี่โมง|เวลา|วันนี้วันอะไร)$/i';
		if(preg_match($regex ,$text)){	
			$startTime = date("Y-m-d H:i:s");
			//display the starting time			
			//add 1 hour to time
			$cenvertedTime = date('Y-m-d H:i:s',strtotime('+7 hour',strtotime($startTime)));
			$hint = thai_date(strtotime($cenvertedTime));
			break;
		}
		
		
		
		//
		$is_match=false;
		$regex=array('/เที่ยว(ที่){0,1}ไหน/i');
		foreach($regex as $reg){
			if(preg_match($reg ,$text)){
				$is_match=true;
				$arr_hint=array('ยังไม่ได้คิดเลยครับ','ไม่ได้ไปไหนเลย อยู่ตอบคำถาม PTMครับ','อยู่บ้านกับครอบครับ','แล้วท่านจะไปไหนครับ ผมจะได้ไม่ไป :)','นอนอยู่บ้านดีกว่าครับ');
				$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];	
				break;
			}		
		}
		if($is_match){
			break;
		}
		
		//*************************************************************
		
		//พรบ.
		
		//*************************************************************
		//
		$is_match=false;
		$regex=array('/เจ้าพนักงาน.*(คือ|คือใคร|หมายถึง){1,1}/i');
		foreach($regex as $reg){
			if(preg_match($reg ,$text)){
				$is_match=true;
$arr_hint=array("Q: เจ้าพนักงานคือใคร
\nA: คําสั่งหัวหน้าคณะรักษาความสงบแห่งชาติ
\nที่ ๑๔/๒๕๖๐ เรื่อง มาตรการเพิ่มประสิทธิภาพการบังคับใช้กฎหมายว่าด้วยการจราจรทางบก
\n**เจ้าพนักงานจราจร หรือพนักงานเจ้าหน้าที่ หรือผู้ที่ได้รับมอบหมายจากเจ้าพนักงานจราจร
\nหรือพนักงานเจ้าหน้าที่ภายใต้การควบคุมดูแลของบุคคลดังกล่าว มีอํานาจเคลื่อนย้ายรถที่หยุดหรือจอดอยู่
\nอันเป็นการฝ่าฝืนบทบัญญัติแห่งพระราชบัญญัตินี้ หรือใช้เครื่องมือบังคับไม่ให้เคลื่อนย้ายรถดังกล่าวได้
\nตามหลักเกณฑ์และวิธีการที่ผู้บัญชาการตํารวจแห่งชาติกําหนด
\nอ่านต่อ https://drive.google.com/open?id=181Prz6fwmS-n5fiygIhMfrJin0Wv_ot_");
				$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];	
				break;
			}		
		}
		if($is_match){
			break;
		}
		
		//*************************************************************
		
		//การใช้งานระบบ PTM
		
		//*************************************************************
		//
		$is_match=false;
		$regex=array('/ใคร.*(ลงนาม|เซ็น|เซน|ลงชื่อ){1,1}.*ใบ(แจ้ง)?เตือน.*(PTM){0,1}/i'
		,'/ใบเตือน.*ใคร.*(ลงนาม|เซ็น|เซน|ลงชื่อ){1,1}/i'
		);
		foreach($regex as $reg){
			if(preg_match($reg ,$text)){
				$is_match=true;
$arr_hint=array("Q: ใครเป็นผู้เซ็นในใบเตือน
\nA: **สารวัตรขึ้นไป** ขยายความ--> คําสั่งหัวหน้าคณะรักษาความสงบแห่งชาติ
\nที่ ๑๔/๒๕๖๐ เรื่อง มาตรการเพิ่มประสิทธิภาพการบังคับใช้กฎหมายว่าด้วยการจราจรทางบก
\n**เจ้าพนักงานจราจร หรือพนักงานเจ้าหน้าที่ หรือผู้ที่ได้รับมอบหมายจากเจ้าพนักงานจราจร
\nหรือพนักงานเจ้าหน้าที่ภายใต้การควบคุมดูแลของบุคคลดังกล่าว มีอํานาจเคลื่อนย้ายรถที่หยุดหรือจอดอยู่
\nอันเป็นการฝ่าฝืนบทบัญญัติแห่งพระราชบัญญัตินี้ หรือใช้เครื่องมือบังคับไม่ให้เคลื่อนย้ายรถดังกล่าวได้
\nตามหลักเกณฑ์และวิธีการที่ผู้บัญชาการตํารวจแห่งชาติกําหนด
\nมาตรา ๑๔๑/๑ ในกรณีที่ผู้ขับขี่หรือเจ้าของรถซึ่งได้รับใบสั่งไม่ปฏิบัติตามมาตรา ๑๔๑
\nให้พนักงานเจ้าหน้าที่และนายทะเบียนตามกฎหมายว่าด้วยรถยนต์หรือกฎหมายว่าด้วยการขนส่งทางบก
\nมีหน้าที่และอํานาจ ดังต่อไปนี้
\n(๑) ให้พนักงานเจ้าหน้าที่ตําแหน่งตั้งแต่ **สารวัตรขึ้นไป** มีหนังสือแจ้งการไม่ปฏิบัติตามใบสั่ง
\nและจํานวนค่าปรับที่ค้างชําระให้ผู้ขับขี่หรือเจ้าของรถทราบภายในสิบห้าวันนับแต่วันที่ครบกําหนดชําระ
\nค่าปรับตามที่ระบุในใบสั่ง และให้ผู้ขับขี่หรือเจ้าของรถทําการชําระค่าปรับที่ค้างชําระด้วยวิธีการอย่างใดอย่างหนึ่ง
\nตามมาตรา ๑๔๑ ภายในสิบห้าวันนับแต่วันที่ได้รับแจ้ง
\nการแจ้งตามวรรคหนึ่ง ให้ทําเป็นหนังสือส่งทางไปรษณีย์ลงทะเบียนตอบรับให้ผู้ขับขี่
\nหรือเจ้าของรถ แล้วแต่กรณี ณ ภูมิลําเนาของผู้นั้น ทั้งนี้ ตามแบบที่ผู้บัญชาการตํารวจแห่งชาติกําหนด
\nและให้ถือว่าผู้ขับขี่หรือเจ้าของรถได้รับแจ้งเมื่อพ้นกําหนดสิบห้าวันนับแต่วันที่ส่ง
\nอ่านต่อ https://drive.google.com/open?id=181Prz6fwmS-n5fiygIhMfrJin0Wv_ot_");
$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];	
				break;
			}		
		}
		if($is_match){
			break;
		}
		

		//
		$is_match=false;
		$regex=array(
		'/ใบเตือน.*ครบกำหนด.*(ไม่ออก|พิมไม่ได้|พิมพ์ไม่ได้){1,1}/i'
		,'/ใบเตือน.*(ขั้นตอน)+/i'
		,'/(ขั้นตอน)+.*ใบเตือน/i'
		,'/การออก.*ใบเตือน/i'
		,'/(พิม|พิมพ์)+ใบเตือน.*ครบกำหนด.*ไม่ได้/i'
		,'/(พิม|พิมพ์)+ใบเตือน.*ไม่ได้/i'
		);
		foreach($regex as $reg){
			if(preg_match($reg ,$text)){
				$is_match=true;
				$arr_hint=array("Q: ทำไมใบเตือนครบกำหนดแล้วไม่ออก
\nA: การที่ใบเตือนไม่ออกมีได้หลายปัจจัย แต่หน่วยงานควรไปตรวจสอบที่เมนูจัดการระบบ โดยเพิ่มข้อมูลหน่วยงานให้ครบถ้วน
\nหากแก้ไขเรียบร้อยแล้ว ใบเตือนจะออกวันรุ่งขึ้น โดยไม่ดำเนินการออกย้อนหลัง
\nQ:􀄃􀅱clock􏿿การออกใบเตือน
\nA:ขั้นตอนการออกใบเตือน
\n1. ต้องกรอกข้อมูลหน่วยงาน /ข้อมูลการออกใบเตือนให้ครบระบบถึงดำเนินการออกใบเตือน ถ้าผู้ปฏิบัติกรอกข้อมูลครบวันที่ 1 มกราคม ใบเตือนจะเริ่มออกวันที่ 2 มกราคม และไม่ออกใบเตอนย้อนหลังคะ
\n2. ข้อมูลของใบสั่งครบตามที่กำหนด
\n􀄃􀄵!􏿿 ดังนั้นหากใบเตือนไม่ออก ไปตรวจสอบเมนูจัดการระบบ ตรงข้อมูลหน่วยงานให้ครบถ้วนก่อนนะคะ และหากกรอกครบแล้ว รอกำหนดระยะเวลาพรุ่งนี้ค่อยเรียกรายงานใบเตือนอีกครั้งคะ
");
				$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];	
				break;
			}		
		}
		if($is_match){
			break;
		}
		
		//
		$is_match=false;
		$regex=array('/ยึดใบขับขี่.*ชำระ.*(ธนาคาร|ตู้บุนเติม|ตู้บุญเติม|ที่อื่น){1,1}/i');
		foreach($regex as $reg){
			if(preg_match($reg ,$text)){
				$is_match=true;
$arr_hint=array("Q: ใบสั่งยึดใบขับขี่ไปชำระธนาคารได้มั้ย
\nA: ไม่ได้ ต้องไปชำระหน่วยที่ออกใบสั่งเท่านั้น พระราชกฤษฏีกากำหนดไว้เฉพาะใบสั่งไม่ยึดใบขับขี่ถึงจะสามารถชำระช่องทางอิเลคทรอนิกส์ได้");
				$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];	
				break;
			}		
		}
		if($is_match){
			break;
		}
		

		//ข้อหา
		$is_match=false;
		$regex=array(
		'/ข้อหา.*ระบบ.*PTM/i'
		,'/(ราคา){0,1}.*ค่าปรับ.*จราจร/i'
		,'/(พรบ|กฏหมาย|กดหมาย).*จราจร/i'
		,'/ราคา.*ค่าปรับ.*ptm/i'
		,'/ค่าปรับ.*ptm/i'
		);
		foreach($regex as $reg){
			if(preg_match($reg ,$text)){
				$is_match=true;
				$arr_hint=array('พรบ.จราจร กฏหมายระเบียบที่เกี่ยวข้อง ข้อหา ดูได้ที่นี่เลย https://drive.google.com/open?id=14_yycCUJK55ocbGgZuyrNilRsmL6SigU');
				$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];	
				break;
			}		
		}
		if($is_match){
			break;
		}
		
		
		
		//
		$is_match=false;
		$regex=array('/(ชื่อผู้ครอบครอง){1,1}.*(ชื่อผู้ถูกจับ){1,1}/i'
		);
		foreach($regex as $reg){
			if(preg_match($reg ,$text)){
				$is_match=true;
				$arr_hint=array('ได้ เลือกผู้ถูกจับกุมไม่ใช่ผู้ครอบครองครับ');
				$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];	
				break;
			}		
		}
		if($is_match){
			break;
		}
		
		//
		$is_match=false;
		$regex=array('/ขั้นตอน.*เปิด(บัญชี|บันชี).*(KTB){1,1}.*Corporate Online/i'
		,'KTB Corporate Online/i'
		,'เปิด(บันชี|บัญชี).*KTB/i'
		);
		foreach($regex as $reg){
			if(preg_match($reg ,$text)){
				$is_match=true;
$arr_hint=array("ขั้นตอนการเปิดบัญชีและสมัครใช้บริการ KTB Corporate Online
\n-เข้าไปติดต่อสาขาที่ใช้บริการ ขอเปิดบัญชี ชื่อบัญชี”บัญชีค่าปรับจราจรของ....(ชื่อหน่วยงาน).....และขอใบสมัคร
\nKtb Corporate Online  พร้อมแนบบัตรประชาชนหรือบัตรข้าราชการของผู้ทีอำนาจลงนาม ,หนังสือแต่งตั้งผู้มีอำนาจลงนาม และหนังสือแจ้งความประสงค์ขอเปิดบัญชีและสมัครใช้บริการ Ktb Corporate Online");
				$hint= $arr_hint[mt_rand(0,count($arr_hint)-1)];	
				break;
			}		
		}
		if($is_match){
			break;
		}
		
		break;//while		
	}//while	
	
	if($hint != ''){
		$rnd = mt_rand(1,10);	
		if (in_array($rnd, array(1,5,7,9) )) {
			$hint.=$footer_txt;
		}		
	}
	return $hint;
}//fn



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
//echo answer('วรกร');
?>
