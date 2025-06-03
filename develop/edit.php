<?php
require_once 'db.php';
require_once 'user.php';

$id = $_GET['id'];

$user = new User($pdo);
$result = $user->findById($id);
$_POST = $result;
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>mini System</title>
    <link rel="stylesheet" href="style_new.css">
    <script src="contact.js"></script>
</head>

<body>
    <div>
        <h1>mini System</h1>
    </div>
    <div>
        <h2>更新・削除画面</h2>
    </div>
    <div>
        <form action="update.php" method="post" name="edit">
            <input type="hidden" name="id" value="<?php echo $_POST['id'] ?>">
            <h1 class="contact-title">更新内容を入力</h1>
            <p>更新内容をご入力の上、「更新」ボタンをクリックしてください。</p>
            <p>削除する場合は「削除」ボタンをクリックしてください。</p>
            <div>
                <div>
                    <label>お名前<span>必須</span></label>
                    <input type="text" name="name" value="<?php echo $_POST['name'] ?>">
                </div>
                <div>
                    <label>ふりがな<span>必須</span></label>
                    <input type="text" name="kana" value="<?php echo $_POST['kana'] ?>">
                </div>
                <div>
                    <label>メールアドレス<span>必須</span></label>
                    <input type="text" name="email" value="<?php echo $_POST['email'] ?>">
                </div>
                <div>
                    <label>電話番号<span>必須</span></label>
                    <input type="text" name="tel" value="<?php echo $_POST['tel'] ?>">
                </div>
                <div>
                    <label>性別<span>必須</span></label>
                    <?php if (empty($_POST['gender'])) { ?>
                        <input type="radio" name="gender" value="男性" checked> 男性
                        <input type="radio" name="gender" value="女性"> 女性
                    <?php } ?>
                    <?php if ($_POST['gender'] == "男性") { ?>
                        <input type="radio" name="gender" value="男性" checked> 男性
                        <input type="radio" name="gender" value="女性"> 女性
                    <?php } elseif ($_POST['gender'] == "女性") { ?>
                        <input type="radio" name="gender" value="男性"> 男性
                        <input type="radio" name="gender" value="女性" checked> 女性
                    <?php } ?>
                </div>
            </div>
            <button type="button" onclick="validate()">更新</button>
            <input type="button" value="ダッシュボードに戻る" onclick="history.back(-1)">
        </form>
        <form action="delete.php" method="post" name="delete">
            <input type="hidden" name="id" value="<?php echo $_POST['id'] ?>">
            <button type="submit">削除</button>
        </form>
    </div>
</body>

</html>