<?php
require_once 'db.php';
require_once 'user.php';

// edit.phpから送られてきた値を代入する
$id = $_POST['id'];
$data = [
    'name' => $_POST['name'],
    'kana' => $_POST['kana'],
    'tel' => $_POST['tel'],
    'email' => $_POST['email'],
    'gender' => $_POST['gender']
];

$user = new User($pdo);
$user->update($id, $data);
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
        <h2>更新完了画面</h2>
    </div>
    <div>
        <div>
            <h1>更新完了</h1>
            <p>
                更新しました。<br>
            </p>
            <a href="index.php">
                <button type="button">TOPに戻る</button>
            </a>
        </div>
    </div>
</body>

</html>