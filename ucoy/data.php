<?php
if (filter_input(INPUT_POST, 'mode') === 'download') {

	ini_set('auto_detect_line_endings', true);
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

	$csv_data = "";

	// 自薦者テーブルのタイトル追加
	$csv_data .= "\n ,自薦者一覧\n\n";
	$data_title_jisen = ['id', '氏名', 'フリガナ', '所属', '学年', 'TEL', 'E-mail', 'SNSアカウント', 'コメント', '申請日付'];
	for ($i = 0; $i < count($data_title_jisen); $i ++) {
		if ($i === count($data_title_jisen) - 1) {
			$csv_data .= $data_title_jisen[$i] . ',';
			$csv_data .="\n";
			break;
		}
		$csv_data .= $data_title_jisen[$i] . ',';
	}

	$result = mysql_query('SELECT id, shimei, hurigana, shozoku, gakunen, tel,'
			. 'email, sns, comment,date from tbl_jisen');
	while ($row = mysql_fetch_assoc($result)) {
		$csv_data .= $row['id'] . ',';
		$csv_data .= $row['shimei'] . ',';
		$csv_data .= $row['hurigana'] . ',';
		$csv_data .= $row['shozoku'] . ',';
		$csv_data .= $row['gakunen'] . ',';
		$csv_data .= $row['tel'] . ',';
		$csv_data .= $row['email'] . ',';
		$csv_data .= $row['sns'] . ',';
		$csv_data .= $row['comment'] . ',';
		$csv_data .= $row['date'] . ',';
		$csv_data .= "\n";
	}
/*
	// 他薦者テーブルのタイトル追加
	$csv_data .= "\n\n ,他薦者一覧\n\n";
	$data_title_tasen = ['id', 'あなたの氏名', 'あなたのフリガナ', 'あなたの所属', 'あなたの学年', 'TEL', 'E-mail', 'SNSアカウント', '被推薦者氏名','被推薦者フリガナ' ,'推薦理由','申請日付'];
	for ($i = 0; $i < count($data_title_tasen); $i ++) {
		if ($i === count($data_title_tasen) - 1) {
			$csv_data .= $data_title_tasen[$i] . ',';
			$csv_data .="\n";
			break;
		}
		$csv_data .= $data_title_tasen[$i] . ',';
	}

	$result = mysql_query('SELECT id, shimei, hurigana, shozoku, gakunen, tel,'
			. 'email, sns, comment,date from tbl_jisen');
	while ($row = mysql_fetch_assoc($result)) {
		$csv_data .= $row['id'] . ',';
		$csv_data .= $row['shimei'] . ',';
		$csv_data .= $row['hurigana'] . ',';
		$csv_data .= $row['shozoku'] . ',';
		$csv_data .= $row['gakunen'] . ',';
		$csv_data .= $row['tel'] . ',';
		$csv_data .= $row['email'] . ',';
		$csv_data .= $row['sns'] . ',';
		$csv_data .= $row['comment'] . ',';
		$csv_data .= $row['date'] . ',';
		$csv_data .= "\n";
	}
*/

	//出力ファイル名の作成
	$csv_file = "goty_" . date("Ymd") . '.csv';

	//文字化けを防ぐ
	$csv_data = mb_convert_encoding($csv_data, "sjis-win", 'utf-8');

	//MIMEタイプの設定
	header("Content-Type: application/octet-stream");
	//名前を付けて保存のダイアログボックスのファイル名の初期値
	header("Content-Disposition: attachment; filename={$csv_file}");

	// データの出力
	echo($csv_data);
	exit();
}
?>
<html>
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
		<form action="" method="post">
			<input type="submit" value="csvダウンロード"><br />
			<input type="hidden" name="mode" value="download">
		</form>
	</body>
</html>
