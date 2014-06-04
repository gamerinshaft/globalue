<script type="text/javascript">
	function onChange(Obj) {
		index_nub = Obj.selectedIndex; // 選択された項目番号を取得する
		O_value = Obj.options[Obj.selectedIndex].value; // 選択された項目の値を取得する

		$("#textarea").remove();
		var appends = '';
		if (O_value === "jisen") {
			appends += '<div id="textarea">';
			appends += '<label for="pr" class="col-lg-2 control-label margin7-top">自己推薦文</label>';
			appends += '<div class="col-lg-10">'
			appends += '<textarea id="pr" name="suisenbun" class="form-control" style="height: 200px;"></textarea>';
			appends += '</div>';
			appends += '</div>';
		} else {
			appends += '<div id="textarea">';
			appends += '<label for="pr" class="col-lg-2 control-label margin7-top">活動実績</label>';
			appends += '<div class="col-lg-10">'
			appends += '<textarea id="pr" name="jisseki" class="form-control" style="height: 200px;"></textarea>';
			appends += '</div>';
			appends += '</div>';
		}
		$("#textarea_wrapper").append(appends);
	}
	;
</script>
<form class="form-horiontal" method="post" action="send.php" role="form">
	<div class="form-group row margin15-top">
		<label for="name" class="col-lg-2 control-label margin7-top">氏名</label>
		<div class="col-lg-10">
			<input type="text" name="shimei" class="form-control" id="name" placeholder="山田太郎">
		</div>
	</div>
	<div class="form-group row ">
		<label for="belong" class="col-lg-2 control-label margin7-top">大学/学部/学科</label>
		<div class="col-lg-10">
			<input type="text" name="shozoku" class="form-control" id="belong" placeholder="学生大学/理工学部/情報科学科">
		</div>
	</div>
	<div class="form-group row ">
		<label for="grade" class="col-lg-2 control-label margin7-top">学年</label>
		<div class="col-lg-10">
			<select name="gakunen" class="form-control" id="grade">
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
				<option>6</option>
			</select>
		</div>
	</div>
	<div class="form-group row ">
		<label for="phone" class="col-lg-2 control-label margin7-top">連絡先(TEL)</label>
		<div class="col-lg-10">
			<input type="tel" name="tel" class="form-control" id="phone" maxlength="15" placeholder="090-0000-0000">
		</div>
	</div>
	<div class="form-group row ">
		<label for="mail" class="col-lg-2 control-label margin7-top">連絡先(EMAIL)</label>
		<div class="col-lg-10">
			<input type="email" name="email" class="form-control" id="mail" placeholder="example@domain.com">
		</div>
	</div>
	<div class="form-group row margin0-bottom">
		<label for="social" class="col-lg-2 control-label margin7-top">SNSアカウント(facebook等)</label>
		<div class="col-lg-10">
			<input type="text" name="sns" class="form-control" id="social" placeholder="facebook: http://facebook.com/myname, twitter: http://twitter.com/aoucnt_id, etc">
		</div>
	</div>

	<div class="form-group row ">
		<label for="offer" class="col-lg-2 control-label margin7-top">自薦・他薦</label>
		<div class="col-lg-10">
			<select name="suisen" class="form-control" onchange="onChange(this)" id="offer">
				<option value="jisen" selected>自薦</option>
				<option value="tasen">他薦</option>
			</select>
		</div>
	</div>

	<div class="form-group row ">
		<div id="textarea_wrapper">
			<div id="textarea">
				<label for="pr" class="col-lg-2 control-label margin7-top">自己推薦文</label>
				<div class="col-lg-10">
					<textarea id="pr" name="suisenbun" class="form-control" style="height: 200px;"></textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-9"></div>
		<div class="col-lg-3">
			<input type="submit" class="btn btn-primary form-control" value="送信する">
		<div>
	</div>
</form>
