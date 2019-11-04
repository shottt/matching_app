//エラーメッセージ
//グローバルから呼び出す
let regexp_email =  new RegExp("^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$");

export default {

  msg: {
    required : "入力必須項目です。",//required attr
    min8: "8文字以上の文字を入力してください。",//minlength attr
    email: "メール形式で入力してください。",//email attr
    full_letters: "全角で入力してください。",
    half_letters: "半角で入力してください。",
    space: "空白は含めずに入力してください。",
    f_type: "正しいファイルを選択してください。",
    f_size: "ファイルサイズがオーバーしています。",
    //ハッキング対策
    null_byte: "不正な文字が検出されました。",
    xss: "不正なスクリプトが検出されました。",
  },

  //各ファンクションは、input値とvueオブジェクトを引数にしている。
  //vueオブジェクトのエラーメッセージdataにエラーメッセージを格納するため。

  required: (value, vue) => {
    //必要ならこれで呼び出す
    //vue.$vali.default.required(value);

    if (value == "") {
      vue.errors.required = vue.$vali.default.msg.required;
      return false;

    } else {
      delete vue.errors.required;
      return true;
    }
  },

  min8: (value, vue) => {
  },

  email: (value, vue) => {

    //メール形式判定
    var result = value.match(regexp_email);

    if (result == null) {
      vue.errors.eamil = vue.$vali.default.msg.email;
      return false;

    } else {
      delete vue.errors.eamil;
      return true;
    }
  },
}
