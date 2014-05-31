<script type="text/javascript">
	function onChange(Obj) {
		index_nub = Obj.selectedIndex; // 選択された項目番号を取得する
		O_value = Obj.options[Obj.selectedIndex].value; // 選択された項目の値を取得する
		if (O_value === "jisen") {
			// 自薦が選択されたなら自己推薦文を表示して活動実績を隠す
			document.getElementById("textarea_jisen").style.display = "block";
			document.getElementById("textarea_tasen").style.display = "none";
		} else {
			// 他薦が選択されたなら自己推薦文を隠して活動実績を表示する
			document.getElementById("textarea_jisen").style.display = "none";
			document.getElementById("textarea_tasen").style.display = "block";
		}
	};
</script>
<form method="post" action="">

	<p>氏名<br>
		<input type="text" name="shimei"></p>

	<p>大学・学部・学科<br>
		<input type="text" name="shozoku" size="50"></p>

	<p>学年<br>
		<input type="text" name="gakunen" size="1" maxlength="1">年</p>

	<p>連絡先(TEL)<br>
		<input type="text" name="tel" size="50" value=""></p>

	<p>連絡先(E-mail)<br>
		<input type="text" name="email" size="50" value=""></p>

	<p>SNSアカウント(facebook等)<br>
		<input type="text" name="sns" size="50" value=""></p>

	<p>自薦・他薦<br>
		<select name="suisen" onchange="onChange(this)">
			<option value="jisen" selected>自薦</option>
			<option value="tasen">他薦</option>
		</select></p>

	<div id="textarea_jisen">
		<p>自己推薦文<br>
			<textarea name="suisenbun" cols="50" rows="10"></textarea>
	</div>
	<div id="textarea_tasen" style="display: none;">
		<p>活動実績<br>
			<textarea name="jisseki" cols="50" rows="10"></textarea>
	</div>
	<p><input type="submit" value="送信する"></p>
	<div></div>
</form>
