<?php
// db.phpとuser.phpのファイルを1度だけ読み込む（レクワイヤワンス））
require_once "db.php";
require_once "user.php";

// POSTかGET、どちらからフォームが届いたか確認する(POSTの場合)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //data配列を作り、入力データを格納する
    $data = [
        "name" => $_POST["name"],
        "kana" => $_POST["kana"],
        "tel" => $_POST["tel"],
        "email" => $_POST["email"],
        "birthday" => $_POST["birthday"],
        "gender" => $_POST["gender"]
    ];
}
// Userクラスをインスタンス化する
$user = new User($pdo);
// createメソッドを呼び出す
$user->create($data);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>完了画面</title>
    <link rel="stylesheet" href="style_new.css">
</head>

<body>
    <div>
        <h1>mini System</h1>
    </div>
    <div>
        <h2>完了画面</h2>
    </div>
    <div>
        <div>
            <h1>登録完了</h1>
            <p>
                登録ありがとうございました。<br>
            </p>
            <a href="index.php"><!-- TOPに戻るボタンを押すとindex.phpにページが移る -->
                <button type="button">TOPに戻る</button>
            </a>
        </div>
    </div>
</body>

</html>