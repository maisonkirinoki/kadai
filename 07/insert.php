<?php
//1. POSTデータ取得
$book_title = $_POST["book_title"];
$book_url = $_POST["book_url"];
$kansou = $_POST["kansou"];


//2. DB接続します(テンプレ)
try {
  $pdo = new PDO('mysql:dbname=gs_db38;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//３．データ登録SQL作成(テンプレ)
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, book_title, book_url, kansou,
indate )VALUES(NULL, :book_title, :book_url, :kansou, sysdate())");
$stmt->bindValue(':book_title', $book_title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':book_url', $book_url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kansou', $kansou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php"); //コロンの後ろに半角スペース必須
  exit;

}
?>
