<script>
  export default {
    data: function () { return {
    
      frends: this.$store.getters['user_info/getFrends_Vuex'],

      /*↑に↓がvuex経由できます。この中身をv-forを使って気合いで表示してください！
      　それができたら、画像は置いといて、実際にテーブルに登録したユーザー情報を表示してください。
      "frend1": { id: 1, picture: 11, name: 12,occupation: 13},
      "frend2": { id: 2, picture: 21, name: 22,occupation: 23},
      */
      }
    },
    template: `
    <li class="container bg-white" v-for="frend in frends">
      <dl class="row align-items-center c-PsnCard u-bt-border-grey mb-0">
        <dt class="col-4 d-inline-block">
          <figure class="c-PsnCard__img my-3 mx-2">
            <img src="/images/avator2.png" class="img-fluid" alt="">
          </figure>
        </dt>
        <dd class="col-8 pl-0 text-left u-txt-b c-PsnCard__text">
          {{ frend.id }}<br>
          {{ frend.picture }}<br>
          {{ frend.name }}<br><span class="u-txt-grey">{{ frend.occupation }}</span>

            <i class="u-icon__detail"></i>

        </dd>
      </dl>
    </li>
    `
  }

</script>

<style lang="scss" scoped>

.c-PsnCard__img {
  border-radius: 10px;
  overflow: hidden;
}
.c-PsnCard__text {
  //vertical-align: middle;
  position: relative;
  margin-bottom: 0;
}
.u-icon__detail:after {
  background:  url('/images/options-icon.png') no-repeat;
  content: "";
  display: inline-block;
  width: 20px;
  height: 5px;
  text-align: right;
  position: absolute;
  right: 15px;
  top: 0;
  bottom: 0;
  margin-top: auto;
  margin-bottom: auto;
}
</style>