<script>
export default {
  data: function () {
    return {
      prof_data: {
        name: "",
        occupation: "",
        birthday: "",
        profile_header: "",
        profile_detail: "",
        picture: '',
        picture_name: '',
      },

    }
  },

  methods: {
    selectedFile: function(e) {
        // 選択された File の情報を保存しておく
        e.preventDefault();
        let files = e.target.files;
        this.prof_data.picture = files[0];
        this.prof_data.picture_name = files[0].name;
    },

    upload: function() {
        // FormData を利用して File を POST する
        let formData = new FormData();
        formData.append('yourFileKey', this.uploadFile);
        let config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
        };
        axios
            .post('yourUploadUrl', formData, config)
            .then(function(response) {
                // response 処理
            })
            .catch(function(error) {
                // error 処理
            })
    }
  },
  template: `
  <main class="u-container-y container text-center">
      <form class="text-left mt-3 Prof-Set">

        <label for="name">お名前</label>
        <input v-model="prof_data.name" class="u-bt-border-grey w-100 text-dark" type="text" id="name">

        <label class="mt-2" for="occupation">ご職業</label>
        <input v-model="prof_data.occupation" class="u-bt-border-grey w-100 text-dark" type="text" id="occupation">
               
        <label class="mt-2" for="birthday">お誕生日</label>
        <input v-model="prof_data.birthday" class="u-bt-border-grey w-100 text-dark" type="text" id="birthday">

        <label class="mt-2" for="profile_header">プロフィールのタイトル</label>
        <input v-model="prof_data.profile_header" class="u-bt-border-grey w-100 text-dark" type="text" id="profile_header">
         
        <label class="mt-2" for="profile_detail">プロフィールの説明</label>
        <textarea v-model="prof_data.profile_detail" class="u-bt-border-grey w-100 text-dark" type="text" id="profile_detail"></textarea>

        <p class="mt-2">プロフィール写真</p>
        <label class="Prof-Set__image u-text-pink p-2" for="image">
          写真を選択してください
          <input @change="selectedFile" mulitple="multiple" class="text-dark" type="file" id="image">
        </label>
        <action_btn btn_text="プロフィールを更新する" v-bind:button_obj="prof_data"></action_btn>
      </form>

  </main>`
}
</script>

<style lang="scss" scoped>
.Prof-Set {
  > p, > label {
  }
}
.Prof-Set__image {
  display: inline-block;
  border-radius: 4px;
  background-color: #f1f1f1;
  box-shadow:  0 2px 6px rgba(146, 146, 146, 0.8);
  cursor: pointer;
  input {
    //display: none;
  }
}
</style>