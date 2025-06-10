<?php
// ファイルを読み込む
require_once 'db.php';
require_once 'user.php';

// ユーザークラスをインスタンス化
$user = new User($pdo);
// searchメソッドをにアクセスして、その結果をを$resultに代入する
$result = $user->search($keyword);
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
        <h2>ダッシュボード</h2>
    </div>
    <?php if ($result) { ?>
        <table border="1" width="100%">
            <tr>
                <th></th>
                <th>お名前</th>
                <th>ふりがな</th>
                <th>メールアドレス</th>
                <th>電話番号</th>
                <th>性別</th>
            </tr>
            <?php foreach ($result as $val) { ?> <!-- $resultから取り出した値を$valに格納する -->
                <tr> <!-- ユーザー情報を表示する -->
                    <td><a href="edit.php?id=<?php echo $val['id'] ?>">編集</a></td>
                    <td><?php echo ($val['name']); ?></td>
                    <td><?php echo ($val['kana']); ?></td>
                    <td><?php echo ($val['email']); ?></td>
                    <td><?php echo ($val['tel']); ?></td>
                    <td>
                        <?php
                        if ($val["gender"] == 1) {
                            echo "男性";
                        } elseif ($val["gender"] == 2) {
                            echo "女性";
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>
    <a href="index.php">
        <button type="button">TOPに戻る</button>
    </a>
</body>

</html>