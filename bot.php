<?php
include 'headbot.php';
include 'functionbot.php';

// Get POST body content
$content = file_get_contents('php://input');
$events = json_decode($content, true);

if (!is_null($events['events'])) {
  foreach ($events['events'] as $event) {
    // Reply only when Follow me.
		if (($event['type'] == 'follow') or ($event['type'] == 'join')) {
			// Get user follow or join me
			$touserid = $event['source']['userId'];
			$toroomid = $event['source']['roomId'];
			$togroupid = $event['source']['groupId'];
			// Gen Text Reply
			$gentext = "ขอบคุณที่ติดตามเรา";
			// Get Replytoken
			$replyToken = $event['replyToken'];
			//Make a POST Request to Messaging API to reply to follower
			$messages = t1($gentext);
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = data1($replyToken,$messages);
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
			
			// Find User Data
			$url = 'https://api.line.me/v2/bot/profile/'.$touserid;
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$result = curl_exec($ch);
			curl_close($ch);
			//echo $result . "\r\n";
			$events = json_decode($result, true);
			// Make Push Messageing
			$displayName = $events['displayName'];
			$userId = $events['userId'];
			$text = $displayName." User\n".$userId;
			$messages = [
				'type' => 'text',
				'text' => $text
				//.'\nRequest '.$reqtext
			];
			$url = 'https://api.line.me/v2/bot/message/push';
			$data = [
				'to' => 'U554a18dbd36996fdb3dd95c218cf6db0',
				'messages' => [$messages]
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
			
			// To group Mac Share
			$data = [
				'to' => 'Cc7ac9ccc51f05b2a60a1abed8cf85723',
				'messages' => [$messages]
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
			
			// Find Group Data
			$text = "Group\n".$togroupid;
			$messages = [
				'type' => 'text',
				'text' => $text
				//.'\nRequest '.$reqtext
			];
			$url = 'https://api.line.me/v2/bot/message/push';
			$data = [
				'to' => 'U554a18dbd36996fdb3dd95c218cf6db0',
				'messages' => [$messages]
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
    // Reply only when MacShare.
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			$touserid = $event['source']['userId'];
			$toroomid = $event['source']['roomId'];
			$togroupid = $event['source']['groupId'];
			$replyToken = $event['replyToken'];
			$text = $event['message']['text'];			
			//Select Group
			if (($text == 'MacShare') and (($togroupid == 'Cd90b89c39f5a695f6d6996c80829e269') or ($togroupid == 'Cc7ac9ccc51f05b2a60a1abed8cf85723') or ($touserid == 'U554a18dbd36996fdb3dd95c218cf6db0'))) {
				$url = 'https://api.line.me/v2/bot/message/reply';
				$data = temp2imgcol3($replyToken);
								
				//$messages = t1($text);
				//$url = 'https://api.line.me/v2/bot/message/reply';
				//$data = data1($replyToken,$messages);
				
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
    // Action Postback only when MacShare.
	  	if ($event['type'] == 'postback') {
			$touserid = $event['source']['userId'];
			$toroomid = $event['source']['roomId'];
			$togroupid = $event['source']['groupId'];
			$replyToken = $event['replyToken'];
			$timedata = $event['timestamp'];
			
			//$timedata = substr($timedata,0,strlen($timedata)-3)

			
			//$timedata = $timedata. "\n" . strtotime("now") . "\n" . ((strtotime("now") * 1000) - $timedata) . "\n" . mktime ( $hour, $minute, $second, $month, $day, $year, $is_dst ). "\n" . date(DATE_RFC3339) . "\n";
			
			$postbackdata = $event['postback']['data'];
			$postbackdata = $postbackdata;
			//$postbackdata = "Test Postback";
			if (($togroupid == 'Cd90b89c39f5a695f6d6996c80829e269') or ($togroupid == 'Cc7ac9ccc51f05b2a60a1abed8cf85723') or ($touserid == 'U554a18dbd36996fdb3dd95c218cf6db0')) {
				$url = 'https://api.line.me/v2/bot/message/reply';
				$postbackdata = t1($postbackdata);
				$data = data1($replyToken,$postbackdata);
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
  }
}

?>
