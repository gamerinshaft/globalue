
<meta charset="utf-8">
<?php

// エスケープ関数
function quote_smart($value) {
	// 数値以外をクオートする
	if (!is_numeric($value)) {
		$value = "'" . mysql_real_escape_string($value) . "'";
	}
	return $value;
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {

	// MySQLに接続
	$link = mysql_connect('localhost:3307', 'admin', 'MinaMi0319');
	if (!$link) {
		die('MySQL接続エラー(南のローカルサーバー上でしか動かないよ ><;)' . mysql_error());
	}

	// DBに接続
	$db_selected = mysql_select_db('goty', $link);
	if (!$db_selected) {
		die('MySQLデータベース接続エラー' . mysql_error());
	}

	// 文字コード設定
	mysql_set_charset('utf8');
	$sql = "";

	if (filter_input(INPUT_POST, 'type') == "jisen") {
		// POSTデータのインプット
		$shimei = filter_input(INPUT_POST, 'shimei');
		$hurigana = filter_input(INPUT_POST, 'hurigana');
		$shozoku = filter_input(INPUT_POST, 'shozoku');
		$gakunen = filter_input(INPUT_POST, 'gakunen');
		$tel = filter_input(INPUT_POST, 'tel');
		$email = filter_input(INPUT_POST, 'email');
		$sns = filter_input(INPUT_POST, 'sns');
		$comment = filter_input(INPUT_POST, 'comment');
		$date = filter_input(INPUT_POST, 'date');

		$sql = "INSERT INTO tbl_jisen (shimei, hurigana, shozoku, gakunen, tel, email, sns, comment, date)"
				. " VALUES ("
				. htmlspecialchars(quote_smart($shimei)) . ","
				. htmlspecialchars(quote_smart($hurigana)) . ","
				. htmlspecialchars(quote_smart($shozoku)) . ","
				. htmlspecialchars(quote_smart($gakunen)) . ","
				. htmlspecialchars(quote_smart($tel)) . ","
				. htmlspecialchars(quote_smart($email)) . ","
				. htmlspecialchars(quote_smart($sns)) . ","
				. htmlspecialchars(quote_smart($comment)) . ","
				. htmlspecialchars(quote_smart($date)) . ")";

		$mailto = $email;
		$subject = "ご応募ありがとうございます！(自己PR文提出〆切：10/31)";
		$message = <<<EOM
\n
{$shimei}さん\n
\n
\n
こんにちは。大学生oftheyear実行委員会です。\n
\n
この度は、大学生oftheyear2014に参加表明いただき、ありがとうございます。\n
\n
今回、既成概念や枠に捉われず、新たな価値創造を行おうとしている大学生が集結する場所を創り、
大学生の力を結集して社会にインパクトを与えたいという想いからイベントの開催に至りました。\n
\n
{$shimei}さんのご応募、とても嬉しく思います。\n
\n
つきましては、自己PR文の提出をお願いしたいと思っております。\n
(自己PR文の提出をもって、正式エントリーとさせていただきます）\n
\n
以下の自己PR文提出フォームより提出をお願いします。\n
\n
\n
＜自己PR文提出フォーム＞\n
\n
以下、提出フォームより、10月31日(金)12:00までに提出をお願いします。\n
\n
〜〜〜提出フォームURL挿入〜〜〜\n
\n
\n
\n
＜ファイナルプレゼンテーションまでの流れ＞\n
\n
▽10月31日(金)  12:00        　自己PR文提出〆切 ※上記登録フォームより提出してください。\n
\n
▽11月14日(金)中　　         　一次予選(書類選考)結果発表\n
\n
▽11月15日(土)〜12月16日(火)   プロによるプレゼンテーション講座 (一次予選合格者対象)\n
※日時が確定したら別途連絡します。\n
\n
▽12月17日(水) 午前　　　　　  二次予選会(ピッチ形式)\n
\n
▽12月17日(水) 午後            ファイナルプレゼンテーション\n
\n
\n
\n
\n
以上です。\n
\n
それでは、自己PR文の提出をお待ちしております。\n
\n
不明点ございましたら、下記連絡先へお問い合わせください。\n
\n
よろしくお願いします。\n
\n
\n
EOM;

		$from = "大学生oftheyear実行委員会<info@globalue.com>";

		mb_language('ja');
		mb_internal_encoding('utf-8');

		if (mb_send_mail($mailto, $subject, $message, "From: " . $from, '-f ' . $from)) {
			echo 'ok';
		} else {
			echo 'failure';
		}
	} else {
		// POSTデータのインプット
		$your_shimei = filter_input(INPUT_POST, 'your_shimei');
		$your_hurigana = filter_input(INPUT_POST, 'your_hurigana');
		$your_shozoku = filter_input(INPUT_POST, 'your_shozoku');
		$your_gakunen = filter_input(INPUT_POST, 'your_gakunen');
		$your_tel = filter_input(INPUT_POST, 'your_tel');
		$your_email = filter_input(INPUT_POST, 'your_email');
		$your_sns = filter_input(INPUT_POST, 'your_sns');
		$suisen_shimei = filter_input(INPUT_POST, 'suisen_shimei');
		$suisen_hurigana = filter_input(INPUT_POST, 'suisen_hurigana');
		$reason = filter_input(INPUT_POST, 'reason');
		$date = filter_input(INPUT_POST, 'date');

		$sql = "INSERT INTO tbl_tasen (your_shimei, your_hurigana, your_shozoku, your_gakunen, your_tel, your_email, your_sns, suisen_shimei, suisen_hurigana, reason ,date)"
				. " VALUES ("
				. htmlspecialchars(quote_smart($your_shimei)) . ","
				. htmlspecialchars(quote_smart($your_hurigana)) . ","
				. htmlspecialchars(quote_smart($your_shozoku)) . ","
				. htmlspecialchars(quote_smart($your_gakunen)) . ","
				. htmlspecialchars(quote_smart($your_tel)) . ","
				. htmlspecialchars(quote_smart($your_email)) . ","
				. htmlspecialchars(quote_smart($your_sns)) . ","
				. htmlspecialchars(quote_smart($suisen_shimei)) . ","
				. htmlspecialchars(quote_smart($suisen_hurigana)) . ","
				. htmlspecialchars(quote_smart($reason)) . ","
				. htmlspecialchars(quote_smart($date)) . ")";

		$mailto = $your_email;
		$subject = "推薦ありがとうございます！(推薦文提出〆切：10/31)";
		$message = <<<EOM
\n
{$shimei}さん\n
\n
\n
こんにちは。大学生oftheyear実行委員会です。\n
\n
この度は、大学生oftheyear2014へのお知り合いの推薦をいただき、ありがとうございます。\n
\n
今回、既成概念や枠に捉われず、新たな価値創造を行おうとしている大学生が集結する場所を創り、
大学生の力を結集して社会にインパクトを与えたいという想いからイベントの開催に至りました。\n
\n
{$shimei}さんのご推薦、とても嬉しく思います。\n
\n
つきましては、推薦文の提出をお願いしたいと思っております。\n
(推薦文の提出をもって、正式エントリーとさせていただきます）\n
\n
以下の推薦文提出フォームより提出をお願いします。\n
\n
※推薦者には事前に応募している旨をお伝えくださいね。\n
　書類選考合格の場合、本人に直接連絡をとらせていただきます。\n
\n
\n
＜推薦文提出フォーム＞\n
\n
以下、提出フォームより、10月31日(金)12:00までに提出をお願いします。\n
\n
〜〜〜提出フォームURL挿入〜〜〜\n
\n
\n
\n
＜ファイナルプレゼンテーションまでの流れ＞\n
\n
▽10月31日(金)  12:00        　推薦文提出〆切 ※上記登録フォームより提出してください。\n
\n
▽11月14日(金)中　　         　一次予選(書類選考)結果発表\n
　　　　　　　　　　　　　　　 　※被推薦者本人にも連絡させていただきます。\n
　　　　　　　　　　　　　　　　　 事前に応募している旨を伝えておいてください。\n
\n
▽11月15日(土)〜12月16日(火)   プロによるプレゼンテーション講座 (一次予選合格者対象)\n
※日時が確定したら別途連絡します。\n

▽12月17日(水) 午前　　　　　  二次予選会(ピッチ形式)\n

▽12月17日(水) 午後            ファイナルプレゼンテーション\n
\n
\n
\n
以上です。\n
\n
それでは、推薦文の提出をお待ちしております。\n
\n
不明点ございましたら、下記連絡先へお問い合わせください。\n
\n
よろしくお願いします。\n
\n
\n
EOM;

		$from = "大学生oftheyear実行委員会<info@globalue.com>";

		mb_language('ja');
		mb_internal_encoding('utf-8');

		if (mb_send_mail($mailto, $subject, $message, "From: " . $from, '-f ' . $from)) {
			echo 'ok';
		} else {
			echo 'failure';
		}
	}

	$result_flag = mysql_query($sql);

	if (!$result_flag) {
		die('INSERTクエリーが失敗しました。' . mysql_error());
	}

	mysql_close($link);
}

// 一時的に飛ばす。
header('Location: data.php', true, 303);
exit();
