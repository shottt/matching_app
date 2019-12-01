<script>
export default {
  template: `
  <form action="" class="u-top-border-grey Chat-Form container-fluid">

    <fieldset class="u-f-l u-child-ib py-3">

      <label for="file" class="u-w-15 Chat-Form__file">
        <i class="fas fa-paperclip"></i>
        <input type="file" name="file" id="file" class="u-none">
      </label>

      <textarea name="comment" class="u-w-70 Chat-Form__comment" placeholder="Write your message…"></textarea>
      <div class="u-w-15 Chat-Form__btn">
        <button type="button">
        <i class="far fa-comment"></i>
        </button>
      </div>
      

    </fieldset>
  </form>`
}
</script>

<style lang="scss" scoped>

.Chat-Form {
  position: fixed;
  bottom: 0;
  background: #fff;
  > fieldset > * {
    height: 60px;
    padding-top: 10px;
    padding-bottom: 10px;

  }
@at-root {
  .Chat-Form__file {
    display: flex;
    align-items: center;
    justify-content: center;
    i {
      &:before {
        font-size: 24px;
        color: #BCC5D3;
      }

    }
  }
  .Chat-Form__comment {
    border: solid 1px #BCC5D3;
    border-radius: 10px;
    color: #4C5264;
  }
  .Chat-Form__btn {
    display: flex;
    align-items: center;
    justify-content: center;

    button {
      border: 0;
      width: 70%;
      height: 70%;

      > i {
        width: 100%;

        &:before {
          color: #BCC5D3;
          font-size: 24px;
        }
        
      }
    }
  }
}}
</style>

