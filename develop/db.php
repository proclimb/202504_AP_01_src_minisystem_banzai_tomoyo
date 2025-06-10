<?php
// データベース接続設定
$host = "localhost"; // ホスト名
$dbname = "minisystem"; // データベース名
$user = "root"; // アカウント名
$pass = "proclimb"; // パスワード
$charset = "utf8mb4"; // 文字コード

// データソース名を変数に代入
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

// エラー時のオプション設定
$options = [
    /* エラーが起きた時の設定　　　　　　エラーが発生した時に例外を投げてくれる */
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    /* データ取得モードの設定　　　　　　　　　　連想配列としてデータを取得する */
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try { // エラーが発生する可能性のあるコード(データベースの接続コード)
    $pdo = new PDO($dsn, $user, $pass, $options);
    // データに接続できなければ、データ接続を中止してメッセージを表示する
} catch (PDOException $e) {
    die("DB接続に失敗しました: " . $e->getMessage());
}
