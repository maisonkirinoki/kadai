<?php

//GETでidの値を取得
$id = $_GET["id"];

//DB接続
try {
  $pdo = new PDO('mysql:dbname=gs_db38;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//指定のテーブルからデータを取得
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//データ表示
$view="";
if($status==false){
	$error = $stmt->errorInfo();
	exit("ErrorQuery:".$error[2]);
}else{
	$row = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>読書の記録</title>
	<link href="css/xxx.css" rel="stylesheet">
</head>
<body>
	<h1>読書の記録</h1>
	<form method="post" action="update.php">
		<input type="hidden" name="id" value="<?=$id?>">
		<fieldset>
			<legend>読んだ本のことを留めておきましょう。</legend>
			<label>本のタイトル：<input type="text" name="book_title" value="<?=$row["book_title"]?>"></label><br>
			<label>本の関連URL：<input type="text" name="book_url" value="<?=$row["book_url"]?>"></label><br>
			<label>感想：<br><textarea name="kansou" rows="5" cols="50"><?=$row["kansou"]?></textarea></label><br>
			<input type="submit" value="更新！">
		</fieldset>
	</form>
	<p><a href="select.php">記録一覧を見る</a></p>
</body>
</html>