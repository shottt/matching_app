<script>

export default {
  props: {
    txt_data: String,
  },
  methods: {
    set_Prog__txt: function () {

    },
    set_Prog__img: function () {

    },
  },
 template: `
 
 `,
}
</script>

<style lang="scss" scoped>
i {
  font-size: 24px;
}
i:hover {
  cursor: pointer;
}

.modal-margin {
  margin-top: 35vh;
}

</style>



<!--

  <div class="modal fade" id="modal_txt" tabindex="-1" role="dialog" aria-labelledby="modal_txtLabel">
    <div class="modal-dialog modal-margin" role="document">
      <div class="modal-content w-75 u-mx-a p-4 text-center">
        <dl>
          <dt id="exampleModalLabel" class="modal-title u-txt-b">サインアウトしますか？</dt>
          <dd class="u-txt-b">Are you sure you wish to sign out?</dd>
        </dl>

        <div class="sing_out_button">
          <a @click.prevent="doSign_out" class="u-txt-p p-3 u-bg-grey3 d-inline-block u-w-40" data-dismiss="modal">はい</a>
          <a class="u-txt-grey p-3 u-bg-grey3 d-inline-block u-w-40" data-dismiss="modal">いいえ</a>
        </div>

      </div>
    </div>
  </div>


-->