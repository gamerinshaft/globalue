
<meta charset="utf-8">
<?php

function quote_smart($value) {
	// 数値以外をクオートする
	if (!is_numeric($value)) {
		$value = "'" . mysql_real_escape_string($value) . "'";
	}
	return $value;
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {

	$shimei = filter_input(INPUT_POST, 'shimei');
	$shozoku = filter_input(INPUT_POST, 'shozoku');
	$gakunen = filter_input(INPUT_POST, 'gakunen');
	$tel = filter_input(INPUT_POST, 'tel');
	$email = filter_input(INPUT_POST, 'email');
	$sns = filter_input(INPUT_POST, 'sns');
	$suisen = filter_input(INPUT_POST, 'suisen');

	// 以下2つのどちらかはnull
	$suisenbun = filter_input(INPUT_POST, 'suisenbun');
	$jisseki = filter_input(INPUT_POST, 'jisseki');


	$link = mysql_connect('localhost:3307', 'admin', 'MinaMi0319');
	if (!$link) {
		die('MySQL接続エラー(南のローカルサーバー上でしか動かないよ ><;)' . mysql_error());
	}

	$db_selected = mysql_select_db('goty', $link);
	if (!$db_selected) {
		die('MySQLデータベース接続エラー' . mysql_error());
	}

	mysql_set_charset('utf8');

	$sql = "";
	if ($suisen === "jisen") {
		$sql = "INSERT INTO tbl_jisen (shimei, shozoku, gakunen, tel, email, sns, suisenbun)"
				. " VALUES ("
				. quote_smart($shimei) . ","
				. quote_smart($shozoku) . ","
				. quote_smart($gakunen) . ","
				. quote_smart($tel) . ","
				. quote_smart($email) . ","
				. quote_smart($sns) . ","
				. quote_smart($suisenbun) . ")";
	} else if ($suisen === "tasen") {
		$sql = "INSERT INTO tbl_tasen (shimei, shozoku, gakunen, tel, email, sns, jisseki)"
				. " VALUES ("
				. quote_smart($shimei) . ","
				. quote_smart($shozoku) . ","
				. quote_smart($gakunen) . ","
				. quote_smart($tel) . ","
				. quote_smart($email) . ","
				. quote_smart($sns) . ","
				. quote_smart($jisseki) . ")";
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
