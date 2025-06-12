<?php
// ファイルを読み込む
require_once 'db.php';
require_once 'user.php';

/* if (!empty($_POST["keyword"])) {
    $keyword = $_POST["keyword"];
}

if (!empty($_POST["sort"])) {
    $sort = $_POST["sort"];
    $user = new User($pdo);
    $result = $user->sort($sort);
}
*/

$keyword = $_POST["keyword"];
$sort = $_POST["sort"];

// ユーザークラスをインスタンス化
$user = new User($pdo);
// searchメソッドをにアクセスして、その結果をを$resultに代入する
$result = $user->search($keyword, $sort);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>mini System</title>
    <link rel="stylesheet" href="style_new.css">
    <style>
        /* thに余計な幅を取らせない */
        th.sort-header {
            white-space: nowrap;
            padding: 4px 8px;
            text-align: center;
            /* ← ここを center に変更 */
        }

        th.sort-header,
        .sort-container form {
            margin: 0;
            padding: 0;
            border: none;
        }

        /* flexで "お名前" とフォームを横並びに */
        .sort-container {
            display: flex;
            justify-content: center;
            /* ← 横方向中央寄せ */
            align-items: center;
            gap: 6px;
        }

        /* form内のボタンを横並びに */
        .sort-container form {
            display: flex;
            gap: 4px;
        }

        .sort-container button {
            all: unset;
            /* ← すべてのデフォルトを解除 */
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            padding: 2px 6px;
            font-size: 12px;
            cursor: pointer;
        }

        .sort-container button:hover {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <div>
        <h1>mini System</h1>
    </div>
    <div>
        <h2>ダッシュボード</h2>
    </div>
    <div>
        <form action="dashboard.php" method="post" name="dashboard">
            <p>名前を入力してください</p>
            <input type="search" name="keyword" placeholder="例）山田太郎" value="<?php echo $_POST["keyword"] ?>">
            <input type="submit" value="検索">
        </form>
    </div>

    <?php if ($result) { ?>
        <table border="1" width="100%">
            <tr>
                <th></th>
                <th class="sort-header">
                    <div class="sort-container">
                        お名前
                        <form action="dashboard.php" method="post" name="sort">
                            <input type="hidden" name="keyword" value="<?php echo $_POST["keyword"] ?>">
                            <button type="submit" name="sort" value="up">↑</button>
                            <button type="submit" name="sort" value="down">↓</button>
                        </form>
                    </div>
                </th>
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