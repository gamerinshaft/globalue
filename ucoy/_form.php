<?php
// 自薦フォーム
$append_jisen = <<< EOF
		<div id="form_content">
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
				<label for="pr" class="col-lg-2 control-label margin7-top">一言コメント</label>
				<div class="col-lg-10">
					<textarea id="pr" name="suisenbun" class="form-control" style="height: 60px;"></textarea>
				</div>
			</div>
		</div>
EOF;

// 他薦フォーム
$append_tasen = <<< EOF
		<div id="form_content">
			<div class="form-group row margin15-top">
				<label for="name" class="col-lg-2 control-label margin7-top">あなたの氏名</label>
				<div class="col-lg-10">
					<input type="text" name="shimei" class="form-control" id="name" placeholder="山田太郎">
				</div>
			</div>
			<div class="form-group row ">
				<label for="belong" class="col-lg-2 control-label margin7-top">あなたの大学/学部/学科</label>
				<div class="col-lg-10">
					<input type="text" name="shozoku" class="form-control" id="belong" placeholder="学生大学/理工学部/情報科学科">
				</div>
			</div>
			<div class="form-group row ">
				<label for="grade" class="col-lg-2 control-label margin7-top">あなたの学年</label>
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
				<label for="phone" class="col-lg-2 control-label margin7-top">あなたの連絡先(TEL)</label>
				<div class="col-lg-10">
					<input type="tel" name="tel" class="form-control" id="phone" maxlength="15" placeholder="090-0000-0000">
				</div>
			</div>
			<div class="form-group row ">
				<label for="mail" class="col-lg-2 control-label margin7-top">あなたの連絡先(EMAIL)</label>
				<div class="col-lg-10">
					<input type="email" name="email" class="form-control" id="mail" placeholder="example@domain.com">
				</div>
			</div>
			<div class="form-group row margin0-bottom">
				<label for="social" class="col-lg-2 control-label margin7-top">あなたのSNSアカウント(facebook等)</label>
				<div class="col-lg-10">
					<input type="text" name="sns" class="form-control" id="social" placeholder="facebook: http://facebook.com/myname, twitter: http://twitter.com/aoucnt_id, etc">
				</div>
			</div>
			<div class="form-group row margin25-top">
				<label for="name" class="col-lg-2 control-label margin7-top">被推薦者の氏名</label>
				<div class="col-lg-10">
					<input type="text" name="shimei" class="form-control" id="name" placeholder="山田太郎">
				</div>
			</div>
			<div class="form-group row ">
				<label for="pr" class="col-lg-2 control-label margin7-top">推薦理由</label>
				<div class="col-lg-10">
					<textarea id="pr" name="suisenbun" class="form-control" style="height: 60px;"></textarea>
				</div>
			</div>
		</div>
EOF;

// javascript用に改行削除
$jisen = str_replace(array("\r\n", "\r", "\n"), '', $append_jisen);
$tasen = str_replace(array("\r\n", "\r", "\n"), '', $append_tasen);


// javascript
$js = <<< EOF
	function onChange(Obj) {
		O_value = Obj.value;
		$("#form_content").remove();
		var appends = '';
		if (O_value === "jisen") {
			appends = '{$jisen}';
		} else {
			appends = '{$tasen}';
		}
		$("#form_content_wrapper").append(appends);
	};
EOF;
?>

<script type="text/javascript">
<?php echo $js; ?>
</script>

<form class="form-horiontal" method="post" action="send.php" role="form" onsubmit="return check()">
	<div class="form-group row ">
		<label for="offer" class="col-lg-2 control-label margin7-top">自薦・他薦</label>
		<div class="col-lg-10">
			<input type="radio" name="suisen" value="jisen" onclick="onChange(this)" checked> 自薦<br/>
			<input type="radio" name="suisen" value="tasen" onclick="onChange(this)"> 他薦
		</div>
	</div>

	<div id="form_content_wrapper">
		<!-- デフォルトで自薦 -->
		<div id="form_content">
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


				<label for="pr" class="col-lg-2 control-label margin7-top">一言コメント</label>
				<div class="col-lg-10">
					<textarea id="pr" name="suisenbun" class="form-control" style="height: 60px;"></textarea>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-9"></div>
		<div class="col-lg-3">
			<input type="checkbox" name="agreement" onclick="this.form.btn.disabled = !this.form.btn.disabled" id="agreement">
			<label for="agreement">利用規約に同意する</label>
			<input type="submit" name="btn" class="btn btn-primary form-control" value="送信する" disabled>
		</div>
</form>
