<?php
// セッションを開始する
session_cache_limiter("none");
session_start();

// $_SESSIONがNULLのとき
if (!isset($_SESSION["input_data"])) {
    // input.phpに移動する
    header("Location:input.php");
    // プログラムを終了する
    exit();
}

// このページはheader関数で遷移してきたページので$POSTに値が入っていない
$_POST = $_SESSION["input_data"];
// セッションを終了する
session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">

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
        <!-- submit.phpにPOST形式で送る -->
        <form action="submit.php" method="post">
            <!-- 画面には表示されない　$POSTの入力データを持っている -->
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
                    <!-- 受け取ったデータをpタグで囲むことでテキストとして表示させる -->
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
                    <p>
                        <?php
                        if ($_POST["gender"] == 1) {
                            echo "男性";
                        } elseif ($_POST["gender"] == 2) {
                            echo "女性";
                        }
                        ?>
                    </p>
                </div>
            </div>
            <!-- 内容を修正するボタンを押したら1つ前のページに戻る -->
            <input type="button" value="内容を修正する" onclick="history.back(-1)">
            <!-- 登録するボタンを押したらsubmit.phpにフォームを送信し移動する -->
            <button type="submit" name="submit">登録する</button>
        </form>
    </div>
</body>

</html>