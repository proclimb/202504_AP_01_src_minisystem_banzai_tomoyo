<?php
// Userクラスを作る
class User
{   // プロパティを設定(自クラスからのみアクセス可能)
    private $pdo;
    // インスタンス化された時に自動的に呼び出されるメソッドを設定する(自クラスからのみアクセス可能)
    public function __construct($pdo)
    {   // 呼び出しもとのインスタンス自身のプロパティ（データベース）にアクセスする
        $this->pdo = $pdo;
    }
    // データベース登録のメソッドを設定
    public function create($data)
    {   // usersというテーブルにレコードを挿入する(カラム名=>値　レコードが作成された現在の時刻を保存)
        $sql = "INSERT INTO users (name, kana, email, tel, gender, create_dt, flag)
                /* ユーザーによって値が変わるため:で仮の値を設定する */
                VALUES (:name, :kana, :email, :tel, :gender, now(), 1)";
        // プリペアドステートメント　現在のインスタンスのユーザー情報(値)を挿入して$sqlを実行した結果を$stmtに代入
        $stmt = $this->pdo->prepare($sql);
        // 戻り値はレコードが作成できたかの真偽
        return $stmt->execute([
            ":name" => $data["name"],
            ":kana" => $data["kana"],
            ":email" => $data["email"],
            ":tel" => $data["tel"],
            ":gender" => $data["gender"]
        ]);
    }

    // $idの値に従ってデータベースからデータを取得するメソッドを設定（ファインドバイアイディー）
    public function findById($id)
    {   // usersテーブルの対象のIDに関するすべてのカラムを検索する
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        // 戻り値をカラム名でキーを持つ連想配列形式で返す
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // データを更新するメソッドを設定する
    public function update($id, $data)
    {   // 指定したIDを対象にユーザー情報、レコード作成時刻を更新する
        $sql = "UPDATE users SET name = :name, kana = :kana, tel = :tel,
                email = :email, gender = :gender, update_dt = now(), flag = 1 WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ":name" => $data["name"],
            ":kana" => $data["kana"],
            ":email" => $data["email"],
            ":tel" => $data["tel"],
            ":gender" => $data["gender"],
            ":id" => $id
        ]);
    }

    // 検索を行うメソッドをを設定する
    public function search($keyword = "", $sort = "")
    {
        if ($keyword && ($sort == "up")) {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE flag = 1 AND name LIKE ? ORDER BY kana ASC");
            $stmt->execute(["%{$keyword}%"]);
        } elseif ($keyword && ($sort == "down")) {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE flag = 1 AND name LIKE ? ORDER BY kana DESC");
            $stmt->execute(["%{$keyword}%"]);
        } elseif ($keyword && empty($sort)) {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE flag = 1 AND name LIKE ?");
            $stmt->execute(["%{$keyword}%"]);
        } elseif (empty($keyword) && ($sort == "up")) {
            $stmt = $this->pdo->query("SELECT * FROM users WHERE flag = 1 ORDER BY kana ASC");
        } elseif (empty($keyword) && ($sort == "down")) {
            $stmt = $this->pdo->query("SELECT * FROM users WHERE flag = 1 ORDER BY kana DESC");
        } else {
            $stmt = $this->pdo->query("SELECT * FROM users WHERE flag = 1");
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 削除を行うメソッドを設定する
    public function delete($id)
    { //該当するIDのユーザー情報を物理的に削除する削除する
        $sql = "UPDATE users SET flag = 0 WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([":id" => $id]);
    }
}
