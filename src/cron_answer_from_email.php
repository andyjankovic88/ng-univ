#!/usr/bin/php -q
<?php

/** 25/08/15 - #5236 - Kaushal - Include config.php to get imap user email id*/
define('BASEPATH', '.'); // workaround for using database.php
require __DIR__ . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

// imap server details
$imap_server = 'secure.emailsrvr.com:993/ssl';
$imap_user = $config['imap_user'];
$imap_pass = $config['imap_pass'];

$mail_box = imap_open('{' . $imap_server . '}INBOX', $imap_user, $imap_pass, 0, 1);

if($mail_box !== false) {
	$indexes = imap_search($mail_box,  'UNSEEN');

	if(!empty($indexes)) {
		
		require __DIR__ . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'database.php';
		require __DIR__ . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . 'third_party' . DIRECTORY_SEPARATOR . 'emailparser' . DIRECTORY_SEPARATOR . 'autoload.php';

		$db_dns = 'mysql:host=' . $db[$active_group]['hostname'] . ';dbname=' . $db[$active_group]['database'];
		$db_user = $db[$active_group]['username'];
		$db_pass = $db[$active_group]['password'];

		$pdo = new PDO($db_dns, $db_user, $db_pass);

		$sql = 'INSERT INTO feed_answers (feed_post_id, user_id, answer, is_anonymous, date_created)
			VALUES (?, ?, ?, 0, ?)';
		$stmt = $pdo->prepare($sql);

		foreach($indexes as $i) {
			$header_info = imap_headerinfo($mail_box, $i);

			echo 'Reading: ', $header_info->subject, "\n";

			$body = imap_qprint(imap_fetchbody($mail_box, $i, '1'));
			$body = preg_replace('~\r\n?~', "\n", $body); // normalizing line-endings to UNIX
			$body = strip_tags($body);

			$email = $header_info->from[0]->mailbox . '@' . $header_info->from[0]->host;

			/** 17/08/15 - #5217 - Pratik - If body encoded then decode the body first*/
			$base64_decode =  base64_decode($body,true);
			if($base64_decode){
				$body = $base64_decode;
			}
			
			$answer = extract_answer($body);

			if(empty($answer)) {
				echo 'Skipping: ', $header_info->subject, " (Cound not extract reply from e-mail body)\n";
				continue;
			}

			$feed_post_id = intval(rtrim(substr($header_info->subject, strpos($header_info->subject, '[') + strlen('['), 11), ']'));

			if(empty($feed_post_id)) {
				echo 'Skipping: ', $header_info->subject, " (Feed post ID missing)\n";
				continue;
			}

			$user_id = get_user_id($email, $pdo);

			if(empty($user_id)) {
				echo 'Skipping: ', $header_info->subject, " (User ID not found)\n";
				continue;
			}

			//Check if its auto reply then skip it
			$raw_header = imap_fetchheader($mail_box,$i);
			if (strstr($raw_header,'Auto-Submitted') || strstr($raw_header,'X-Autoreply') || strstr($raw_header,'X-Auto-Response-Suppress') || strstr($raw_header,'X-FC-MachineGenerated')) {
				continue;
			}

			/** 02/09/15 - #5217 - Pratik - Take default timezone of Melbourne */
			$users_timezone = getUserTimeZoneByUserID($user_id,$pdo);
			$current_date = new DateTime('now', new DateTimeZone($users_timezone));
			$stmt->execute(array($feed_post_id, $user_id, $answer, $current_date->format('Y-m-d H:i:s')));

			$answer_id = $pdo->lastInsertId();
			create_notification($user_id, $answer_id, $pdo);
		}
	} else {
		echo "No mail to read!\n";
	}

	imap_close($mail_box);
}

function extract_answer($body) {
	/** 24/08/15 - #5217 - Pratik - Check with diff regex */
	$body = preg_replace('/\nOn(.*?)wrote:(.*?)$/si', '',$body,-1,$match_count);
	//Now Check with a diff regex
	if(!isset($match_count) || $match_count==0){
		$body = preg_replace('/\nFrom(.*?)On Behalf Of(.*?)$/si', '',$body,-1,$match_count2);
	}
	//Now Check with a diff regex
	if(!isset($match_count2) || $match_count2==0){
		$body = preg_replace('/\nFrom(.*?)$/si', '',$body,-1,$match_count3);
	}
	return \EmailReplyParser\EmailReplyParser::parseReply($body);
}

function get_user_id($email, $pdo) {
	$sql = 'SELECT id FROM users WHERE email = ? OR email_secondary = ?';
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array($email, $email));
	$user_id = $stmt->fetchColumn(0);

	return $user_id;
}

function create_notification($user_id, $answer_id, $pdo) {
	$params = array("'feed_answer'", $user_id, $answer_id, "'Feed_answers'", "''", 1, 1);
	$sql = 'CALL sp_ucroo (' . implode(',', $params) . ')';
	echo "Calling SP - $sql\n";
	$pdo->exec($sql);
}

/**
 * 02/09/15 - #5217 - Pratik - Get users timezone by userid
 * @param  [type] $user_id [users id]
 * @param  [type] $pdo     [pdo object]
 * @author Pratik
 */
function getUserTimeZoneByUserID($user_id, $pdo) {

  $sql = 'SELECT timezone_php from users left join campus on users.campus_id = campus.id where users.id = ?';

  $stmt = $pdo->prepare($sql);
  $stmt->execute(array($user_id));

  $timezone = $stmt->fetchColumn(0);
  
  if($timezone)
		return $timezone;
  else
  		return 'Australia/Melbourne';
}