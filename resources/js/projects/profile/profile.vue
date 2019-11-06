<script>
  import { mapGetters } from 'vuex';
  import action_btn from '../../components/action-btn_follow.vue';
  export default {
    props: {
      pattern: String
    },
    components: {
      action_btn,
    },
    template: `
    <main class="text-center u-bg-w u-pb-180">
      <div class="c-Card-Hero">
        <img class="w-100" src="/images/avator1.png" alt="">
        <dl class="c-Card-Hero__detail text-center">
          <dt class="">鈴木 花子</dt>
          <dd style="opacity: 0.5;">写真家,大阪</dd>
          <dd class="mt-2 mb-4">ほし</dd>
        </dl>
      </div>
      <action_btn btn_text="フォローする" pattern="follow"></action_btn>
      <div class="container-fluid p">
        <ul class="row l-Simple__list">

          <div class="col">
            <div class="u-wrapper">
              <div class="u-wrapper-text d-position-relative">
                <figure class="profile-Thumb">
                  <img src="/images/avator1.png" class="img-fluid">
                </figure>
                <p class="profile-Me">私について</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="u-wrapper">
              <div class="u-wrapper-text">
                <router-link to="/profile_followers">
                  <p>111</p>
                  <p>友達</p>
                </router-link>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="u-wrapper">
              <div class="u-wrapper-text">
                <p>333</p>
                <p>友達の声</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="u-wrapper">
              <div class="u-wrapper-text">
                <p>2232</p>
                <p>投稿</p>
              </div>
            </div>
          </div>
        </ul>
      </div>

      <article>
        <section class="container profile-Detail text-left">
          <h1 class="profile-Detail__head u-txt-b pt-4">aaa</h1>
          <p class="profile-Detail__text pt-3">
          text text text texttext text text texttext text text texttext text text texttext text text text
          text text text texttext text text texttext text text texttext text text texttext text text text
          text text text texttext text text texttext text text texttext text text texttext text text text
          </p>
        </section>

        
      </article>
    </main>
    `
  }

</script>

<style lang="scss" scoped>

.top_Hero {
  background: url("/images/avator1.png") center no-repeat;
}

.u-wrapper {

}

.u-wrapper:hover {
  cursor: pointer;
}
.u-wrapper:hover > .u-wrapper-text {
  border-bottom: solid 2px #F271A8;
  transition: border-bottom 1s;
}

.u-wrapper-text {
  text-align: center;
  width: 100%;
  padding: 1rem 0;
}

.u-wrapper-text p {
  color: #343a40;
}

.js-border {
  border-bottom: solid 2px #F271A8;
}

.profile-Thumb {
  margin-bottom: 0;
  position: absolute;
  top: -15px;
  left: 0;
  right: 0;
  display: inline-block;
  margin: 0 auto;
  width: 70px;
  border-radius: 4px;
  border: solid #fff 2px;
}
.profile-Me {
  margin-top: 30px;
}
.profile-Detail__head {
  color: #343a40;
}
.profile-Detail__text {
  color: #343a40;
}
</style>