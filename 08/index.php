<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>読書の記録</title>
	<link href="css/xxx.css" rel="stylesheet">
</head>
<body>

	<h1>会員登録</h1>
	<form method="post" action="user_insert.php">
		<fieldset>
			<legend>会員情報を入力してください。</legend>
			<label>名前：<input type="text" name="name"></label><br>
			<label>ID：<input type="text" name="lid"></label><br>
			<label>パスワード：<input type="text" name="lpw"></label><br>
			<input type="submit" value="登録！">
		</fieldset>
	</form>
	<p><a href="user_select.php">会員一覧を見る</a></p>

	<h1>読書の記録</h1>
	<form method="post" action="insert.php">
		<fieldset>
			<legend>読んだ本のことを留めておきましょう。</legend>
			<label>本のタイトル：<input type="text" name="book_title"></label><br>
			<label>本の関連URL：<input type="text" name="book_url"></label><br>
			<label>感想：<br><textarea name="kansou" rows="5" cols="50"></textarea></label><br>
			<input type="submit" value="登録！">
		</fieldset>
	</form>
	<p><a href="select.php">記録一覧を見る</a></p>
</body>
</html>