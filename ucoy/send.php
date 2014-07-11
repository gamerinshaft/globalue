
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
		die('MySQL接続エラー' . mysql_error());
	}

	// DBに接続
	$db_selected = mysql_select_db('goty', $link);
	if (!$db_selected) {
		die('MySQLデータベース接続エラー' . mysql_error());
	}

	// 文字コード設定
	mysql_set_charset('utf8');
	$sql = "";

	if (filter_input(INPUT_POST, 'type') == "自薦") {
		// POSTデータのインプット
		$sei = filter_input(INPUT_POST, '姓');
		$mei = filter_input(INPUT_POST, '名');
		$huri_sei = filter_input(INPUT_POST, 'セイ');
		$huri_mei = filter_input(INPUT_POST, 'メイ');
		$shozoku = filter_input(INPUT_POST, '所属');
		$gakunen = filter_input(INPUT_POST, '学年');
		$tel = filter_input(INPUT_POST, 'tel');
		$email = filter_input(INPUT_POST, 'email');
		$sns = filter_input(INPUT_POST, 'SNS');
		$bumon = filter_input(INPUT_POST, '部門');
		$comment = filter_input(INPUT_POST, 'コメント');
		$date = filter_input(INPUT_POST, 'date');

		$sql = "INSERT INTO tbl_jisen (sei, mei, huri_sei, huri_mei, shozoku, gakunen, tel, email, sns, bumon, comment, date)"
				. " VALUES ("
				. htmlspecialchars(quote_smart($sei)) . ","
				. htmlspecialchars(quote_smart($mei)) . ","
				. htmlspecialchars(quote_smart($huri_sei)) . ","
				. htmlspecialchars(quote_smart($huri_mei)) . ","
				. htmlspecialchars(quote_smart($shozoku)) . ","
				. htmlspecialchars(quote_smart($gakunen)) . ","
				. htmlspecialchars(quote_smart($tel)) . ","
				. htmlspecialchars(quote_smart($email)) . ","
				. htmlspecialchars(quote_smart($sns)) . ","
				. htmlspecialchars(quote_smart($bumon)) . ","
				. htmlspecialchars(quote_smart($comment)) . ","
				. htmlspecialchars(quote_smart($date)) . ")";

		$mailto = $email;
		$subject = "プレエントリーありがとうございます！(自己PR文提出〆切：10/31)";
		$message = <<<EOM
\n
{$sei} {$mei}さん\n
\n
\n
こんにちは。大学生 OF THE YEAR 2014実行委員会です。\n
\n
この度は、大学生 OF THE YEAR 2014へのプレエントリーありがとうございます。\n
\n
今回、既成概念や枠に捉われず、新たな価値創造を行おうとしている大学生が集結する場所を創り、\n
大学生の力を結集して社会にインパクトを与えたいという想いからイベントの開催に至りました。\n
\n
{$sei}さんのご応募、とても嬉しく思います。\n
\n
つきましては、自己PR文の提出をお願いしたいと思っております。\n
(自己PR文の提出をもって、正式エントリーとさせていただきます）\n
\n
以下の自己PR文提出フォームより提出をお願いします。\n
\n
\n
＜エントリーフォーム＞\n
\n
以下、提出フォームより、10月31日(金)12:00までに提出をお願いします。\n
\n
http://goo.gl/OvooBE \n
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

		$from = "大学生 OF THE YEAR 2014実行委員会<d.oftheyear14@gmail.com>";

		mb_language('ja');
		mb_internal_encoding('utf-8');

		if (mb_send_mail($mailto, $subject, $message, "From: " . $from, '-f ' . $from)) {
			echo 'ok';
		} else {
			echo 'failure';
		}
	} else {
		// POSTデータのインプット
		$your_sei = filter_input(INPUT_POST, 'あなたの姓');
		$your_mei = filter_input(INPUT_POST, 'あなたの名');
		$your_huri_sei = filter_input(INPUT_POST, 'あなたのセイ');
		$your_huri_mei = filter_input(INPUT_POST, 'あなたのメイ');
		$your_shozoku = filter_input(INPUT_POST, 'あなたの所属');
		$your_gakunen = filter_input(INPUT_POST, 'あなたの学年');
		$your_tel = filter_input(INPUT_POST, 'あなたのTEL');
		$your_email = filter_input(INPUT_POST, 'あなたのEMAIL');
		$your_sns = filter_input(INPUT_POST, 'あなたのSNS');
		$hi_sei = filter_input(INPUT_POST, '被推薦者の姓');
		$hi_mei = filter_input(INPUT_POST, '被推薦者の名');
		$hi_huri_sei = filter_input(INPUT_POST, '被推薦者のセイ');
		$hi_huri_mei = filter_input(INPUT_POST, '被推薦者のメイ');
		$bumon = filter_input(INPUT_POST, '部門');
		$reason = filter_input(INPUT_POST, '推薦理由');
		$date = filter_input(INPUT_POST, 'date');

		$sql = "INSERT INTO tbl_tasen (your_sei, your_mei, your_huri_sei, your_huri_mei, your_shozoku, your_gakunen, your_tel, your_email, your_sns, hi_sei, hi_mei, hi_huri_sei, hi_huri_mei, bumon, reason ,date)"
				. " VALUES ("
				. htmlspecialchars(quote_smart($your_sei)) . ","
				. htmlspecialchars(quote_smart($your_mei)) . ","
				. htmlspecialchars(quote_smart($your_huri_sei)) . ","
				. htmlspecialchars(quote_smart($your_huri_mei)) . ","
				. htmlspecialchars(quote_smart($your_shozoku)) . ","
				. htmlspecialchars(quote_smart($your_gakunen)) . ","
				. htmlspecialchars(quote_smart($your_tel)) . ","
				. htmlspecialchars(quote_smart($your_email)) . ","
				. htmlspecialchars(quote_smart($your_sns)) . ","
				. htmlspecialchars(quote_smart($hi_sei)) . ","
				. htmlspecialchars(quote_smart($hi_mei)) . ","
				. htmlspecialchars(quote_smart($hi_huri_sei)) . ","
				. htmlspecialchars(quote_smart($hi_huri_mei)) . ","
				. htmlspecialchars(quote_smart($bumon)) . ","
				. htmlspecialchars(quote_smart($reason)) . ","
				. htmlspecialchars(quote_smart($date)) . ")";

		$mailto = $your_email;
		$subject = "推薦ありがとうございます！(推薦文提出〆切：10/31)";
		$message = <<<EOM
\n
{$sei} {$mei}さん\n
\n
\n
こんにちは。大学生 OF THE YEAR 2014実行委員会です。\n
\n
この度は、大学生 OF THE YEAR 2014へのお知り合いの推薦をいただき、ありがとうございます。\n
\n
今回、既成概念や枠に捉われず、新たな価値創造を行おうとしている大学生が集結する場所を創り、\n
大学生の力を結集して社会にインパクトを与えたいという想いからイベントの開催に至りました。\n
\n
{$sei}さんのご推薦、とても嬉しく思います。\n
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
http://goo.gl/gFgpXU \n
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
\n
▽12月17日(水) 午前　　　　　  二次予選会(ピッチ形式)\n
\n
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

		$from = "大学生 OF THE YEAR 2014実行委員会<d.oftheyear14@gmail.com>";

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
