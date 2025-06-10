function validate() {

    var flag = true;
    // クラスを削除する（コメント）
    removeElementsByClass("error");
    // クラスを削除する（テキストボックスの赤枠改）
    removeClass("error-form");

    // editというフォーム名のnameというテキストボックスに値が入っていなかったら
    if (document.edit.name.value == "") {
        errorElement(document.edit.name, "お名前が入力されていません");
        flag = false;
    }

    if (document.edit.kana.value == "") {
        errorElement(document.edit.kana, "ふりがなが入力されていません");
        flag = false;
    } else { //正規表現の確認
        if (!validateKana(document.edit.kana.value)) {
            errorElement(document.edit.kana, "ひらがなを入れて下さい");
            flag = false;
        }
    }

    if (document.edit.email.value == "") {
        errorElement(document.edit.email, "メールアドレスが入力されていません");
        flag = false;
    } else {
        if (!validateMail(document.edit.email.value)) {
            errorElement(document.edit.email, "メールアドレスが正しくありません");
            flag = false;
        }
    }

    if (document.edit.tel.value == "") {
        errorElement(document.edit.tel, "電話番号が入力されていません");
        flag = false;
    } else {
        if (!validateTel(document.edit.tel.value)) {
            errorElement(document.edit.tel, "電話番号が違います");
            flag = false;
        }
    }

    if (flag) { // $flagがtrueだったら
        document.edit.submit(); //editファイルを送信する
    }

    return false; //　エラーが出ていた
}

// エラーメッセージを表示する
// 変数errorElementに関数を代入(from:メッセージを表示する対象のinputタグ、msg:表示させるエラーメッセージ)
var errorElement = function (form, msg) {
    // formにerror-formのスタイルを適用させる
    form.className = "error-form";
    // divタグを作成してエラーメッセージの出力部分を作る
    var newElement = document.createElement("div");
    // divタグにerrorのスタイルを適用させる
    newElement.className = "error";
    var newText = document.createTextNode(msg);
    newElement.appendChild(newText);
    form.parentNode.insertBefore(newElement, form.nextSibling);
}

// エラーメッセージの削除
var removeElementsByClass = function (className) {
    var elements = document.getElementsByClassName(className);
    while (elements.length > 0) {
        elements[0].parentNode.removeChild(elements[0]);
    }
}

// 適応スタイルの削除
var removeClass = function (className) {
    var elements = document.getElementsByClassName(className);
    while (elements.length > 0) {
        elements[0].className = "";
    }
}

// メールアドレスの書式のチェック
var validateMail = function (val) {
    if (val.match(/^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@[A-Za-z0-9_.-]+.[A-Za-z0-9]+$/) == null) {
        return false;
    } else {
        return true;
    }
}

// 電話番号のチェック
var validateTel = function (val) {
    if (val.match(/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/) == null) {
        return false;
    } else {
        return true;
    }
}

// ひらがなのチェック
var validateKana = function (val) {
    if (val.match(/^[ぁ-んー]+$/) == null) {
        return false;
    } else {
        return true;
    }
}