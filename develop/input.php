<?php
// セッションを開始する
session_cache_limiter("none");
session_start();

// 入力項目の確認

// $_POSTに値が入っている　かつ　$_SESSIONの値が空の場合
if (!empty($_POST) && empty($_SESSION["input_data"])) {
    // 名前の入力確認
    // 入力欄に値が入力されていない場合
    if (empty($_POST["name"])) {
        // エラーメッセージを表示する
        $error_message["name"] = "名前が入力されていません";
    }

    // ふりがなの入力確認
    // 入力欄に値が入力されていない場合
    if (empty($_POST["kana"])) {
        // エラーメッセージを表示する
        $error_message["kana"] = "ふりがなが入力されていません";
        // 入力した値が指定した正規表現とマッチしていない場合
    } elseif (preg_match('/[^ぁ-んー]/u', $_POST["kana"])) {
        // エラーメッセージを表示する
        $error_message["kana"] = "ひらがなを入れて下さい";
    }
    // メールアドレスの入力確認
    // メールアドレスの書式を変数に代入
    $reg_str = "/^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@[A-Za-z0-9_-]+.[A-Za-z0-9]+$/";
    // 入力欄に値が入力されていない場合
    if (empty($_POST["email"])) {
        // エラーメッセージを表示する
        $error_message["email"] = "メールアドレスが入力されていません";
        // 入力した値が指定した正規表現とマッチしていない場合
    } elseif (!preg_match($reg_str, $_POST["email"])) {
        // エラーメッセージを表示する
        $error_message["email"] = "メールアドレスが正しくありません";
    }

    // 電話番号の入力確認
    // 電話番号の書式を変数に代入
    $reg_str = "/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/";
    // 入力欄に値が入力されていない場合
    if (empty($_POST["tel"])) {
        // エラーメッセージを表示する
        $error_message["tel"] = "電話番号が入力されていません";
        // 入力した値が指定した正規表現とマッチしていない場合
    } elseif (!preg_match($reg_str, $_POST["tel"])) {
        // エラーメッセージを表示する
        $error_message["tel"] = "電話番号が違います";
    }

    // エラーメッセージの確認
    // エラーメッセージの値が空であれば(表示されなければ)
    if (empty($error_message)) {
        // $_SESSION(データ)に$_POST(入力した値)を代入
        $_SESSION["input_data"] = $_POST;
        // confirm.phpに移動する
        header("Location:confirm.php");
        // プログラムを終了する
        exit();
    }
}

// セッションを破棄する
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
        <h2>登録画面</h2>
    </div>
    <div>
        <!-- input.php(現在のファイル)にPOST形式で送る -->
        <form action="input.php" method="post" name="form">
            <h1 class="contact-title">登録内容入力</h1>
            <p>登録内容をご入力の上、「確認画面へ」ボタンをクリックしてください。</p>
            <div>
                <div>
                    <label>お名前<span>必須</span></label>
                    <!-- テキストボックス　このテキストボックスの名前　未入力の時の入力例　読み込んだ値 -->
                    <input type="text" name="name" placeholder="例）山田太郎" value="<?php echo $_POST["name"] ?>">
                    <!-- $error_messageがNULLではないとき(エラーが出ているとき) -->
                    <?php if (isset($error_message["name"])) { ?>
                        <!-- エラーメッセージを表示する -->
                        <div class="error-msg"><?php echo $error_message["name"] ?></div>
                    <?php } ?>
                </div>
                <div>
                    <label>ふりがな<span>必須</span></label>
                    <input type="text" name="kana" placeholder="例）やまだたろう" value="<?php echo $_POST["kana"] ?>">
                    <?php if (isset($error_message["kana"])) { ?>
                        <div class="error-msg"><?php echo $error_message["kana"] ?></div>
                    <?php } ?>
                </div>
                <div>
                    <label>メールアドレス<span>必須</span></label>
                    <input type="text" name="email" placeholder="例）guest@example.com" value="<?php echo $_POST["email"] ?>">
                    <?php if (isset($error_message["email"])) { ?>
                        <div class="error-msg"><?php echo $error_message["email"] ?></div>
                    <?php } ?>
                </div>
                <div>
                    <label>電話番号<span>必須</span></label>
                    <input type="text" name="tel" placeholder="例）000-000-0000" value="<?php echo $_POST["tel"] ?>">
                    <?php if (isset($error_message["email"])) { ?>
                        <div class="error-msg"><?php echo $error_message["tel"] ?></div>
                    <?php } ?>
                </div>
                <div>
                    <label>性別<span>必須</span></label>
                    <!-- デフォルト値の指定(何も触っていない時) -->
                    <?php if (empty($_POST["gender"])) { ?>
                        <!-- ラジオボタン　このラジオボタンの名前　データを読み込んだ時の名前　チェックする -->
                        <input type="radio" name="gender" value=1 checked> 男性
                        <input type="radio" name="gender" value=2> 女性
                    <?php } ?> <!-- データの中身が男性だった時 -->
                    <?php if ($_POST["gender"] == 1) { ?>
                        <input type="radio" name="gender" value=1 checked> 男性
                        <input type="radio" name="gender" value=2> 女性
                        <!-- データの中身が女性だったとき -->
                    <?php } elseif ($_POST["gender"] == 2) { ?>
                        <input type="radio" name="gender" value=1> 男性
                        <input type="radio" name="gender" value=2 checked> 女性
                    <?php } ?>
                </div>
            </div>
            <!-- 確認画面ボタンを押したらinput.phpにフォームが送信される -->
            <button type="submit">確認画面へ</button>
            <a href="index.php"> <!-- TOPに戻るボタンを押したらindex.phpに移動する -->
                <button type="button">TOPに戻る</button>
            </a>
        </form>
    </div>
</body>

</html>