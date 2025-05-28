<?php
session_cache_limiter("none");
session_start();

if (!isset($_SESSION["input_data"])) {
    header("Location:input/php");
    exit();
}

$_POST = $_SESSION["input_data"];
session_destroy()
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>mini System</title>
    <link rel="stylesheet" href="style_new.css">
</head>

<body>
    <div>
        <h1>mini System</h1>
    </div>
    <div>
        <h2>確認画面</h2>
    </div>
    <div>
        <form action="submit.php" method="post">
            <input type="hidden" name="name" value="<?php echo $_POST["name"] ?>">
            <input type="hidden" name="kana" value="<?php echo $_POST["kana"] ?>">
            <input type="hidden" name="email" value="<?php echo $_POST["email"] ?>">
            <input type="hidden" name="tel" value="<?php echo $_POST["tel"] ?>">
            <input type="hidden" name="gender" value="<?php echo $_POST["gender"] ?>">
            <h1 class="contact-title">登録内容確認入力</h1>
            <p>登録内容をご入力の上、「登録する」ボタンをクリックしてください。</p>
            <div>
                <div>
                    <label>お名前</label>
                    <p><?php echo $_POST["name"] ?></p>
                </div>
                <div>
                    <label>ふりがな</label>
                    <p><?php echo $_POST["kana"] ?></p>
                </div>
                <div>
                    <label>メールアドレス</label>
                    <p><?php echo $_POST["email"] ?></p>
                </div>
                <div>
                    <label>電話番号</label>
                    <p><?php echo $_POST["tel"] ?></p>
                </div>
                <div>
                    <label>性別</label>
                    <p><?php echo $_POST["gender"] ?></p>
                </div>
            </div>
            <input type="button" value="内容を修正する" onclick="history.back(-1)">
            <button type="submit" name="submit">登録する</button>
        </form>
    </div>
</body>

</html>