<script>
  import { mapGetters } from 'vuex';
  //import action_btn from '/components/action-btn_follow.vue';

  export default {
    props: {
      pattern: String
    },
    components: {
      
    },
    computed: {
      ...mapGetters([
      'page_displaying/getPattern_Vuex',
      'user_info/getUser_id',
      ]),
    },
    methods: {
      change_Page_Pattern: function (pattern) {
        console.log("change_Page_Pattern");
        this.$store.dispatch('page_displaying/pattern_set_' + pattern);
      },
    },
    template: `
    <div class="u-bt-border-grey px-4 pt-5 pb-3">
      <dt class="d-inline-block w-auto">
        <figure class="d-inline-block post-Main-Img  w-auto">
          <img class="img- w-100" src="/images/posts/post_images/landscape-1.png" alt="">
        </figure>
      </dt>
      <dd class="post-Detail pl-4">
        <p class="u-txt-b text-left">絶景だー！</p>
        <div class="post-Icons c-opition-icon pt-2">
          <figure><img src="/images/posts/heart-line-icon.png" alt="" class="img-fluid mr-1"></figure>
          <figure><img src="/images/posts/options-icon.png" alt=""class="img-fluid"  data-toggle="modal" data-target="#myModal"></figure>

        </div>
      </dd>
      <!-- モーダルの設定 -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">

          <div class="modal-content">

            <div class="modal-body">
              
              <form>
                <textarea class="u-txt-b w-100" id="" name="post-text" rows="10" cols="33"></textarea>
              </form>
              
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
              <button type="button" class="btn btn-primary">コメントを投稿する</button>
            </div><!-- /.modal-footer -->

          </div><!-- /.modal-content -->

        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    </div>
    `
  }

</script>

<style lang="scss" scoped>
.c-PsnCard__img {
  border-radius: 10px;
  overflow: hidden;
}
.c-PsnCard__text {
  vertical-align: middle;
  position: relative;
}
.c-PsnCard__text:after {
  background:  url('/images/options-icon.png');
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
.post-Icons {
  text-align: left;
}
.post-Icons figure  {
  display: inline-block;
}
.post-Main-Img {
  //width: 400px;
}
.post-Detail {
  
}
.w-auto {
  width:auto;
}
.post-Icons figure {
  margin-bottom: 0;
}
.c-opition-icon {
  position: relative;
}

.c-opition-icon:after {
  background:  url('/images/options-icon.png');
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
.modal-dialog {
  margin-top: 70vh;
}
.modal-dialog textarea {
  height: 100px;
  font-size: 20px;
}
.modal-body {
  padding: 0;
}

</style>