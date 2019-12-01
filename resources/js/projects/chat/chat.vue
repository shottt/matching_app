<script>
//実装のポイント
//自分と相手のIDをどうってくるか？
//
//相手が自分かの判定
// 相手なら <li class="Chat__friend">
//自分なら<li class="Chat__me">
//という風にCSSクラスを切り替える
import person_card from '../../components/card/person_card.vue';
export default {

  data: function () {
    return {
      search_query: "",
    }
  },

  template: `
  <main class="u-container-y--short">
    <div class="container">

      <ul class="table mb-0 py-5 Chat">

        <li class="Chat__me">
          <p class="text-left p-2 u-txt-b">
            me me me me me me me me me me me me
          </p>
        </li>

        <li class="Chat__friend">
          <i class="fas fa-male"></i>
          <p class="text-left p-2 u-txt-b">
            friend friend friend friend friend friend friend friend friend friend 
          </p> 
        </li>
        


        <li class="Chat__me">
          <p class="text-left p-2 u-txt-b">
            me me me me me me me me me me me me
          </p>
        </li>

        <li class="Chat__friend">
          <i class="fas fa-male"></i>
          <p class="text-left p-2 u-txt-b">
            friend friend friend friend friend friend friend friend friend friend 
          </p> 
        </li>

        <li class="Chat__friend">
          <i class="fas fa-male"></i>
          <p class="text-left p-2 u-txt-b">
            friend friend friend friend friend friend friend friend friend friend 
          </p> 
        </li>

        <li class="Chat__me">
          <p class="text-left p-2 u-txt-b">
            me me me me me me me me me me me me
          </p>
        </li>       
        
        <li class="Chat__me">
          <p class="text-left p-2 u-txt-b">
            me me me me me me me me me me me me
          </p>
        </li>

      </ul>
    </div>
  </main>`
}
</script>

<style lang="scss" scoped>

li {
  position: relative;
  display: block;
  margin-bottom: 32px;
  > p {
    background: #fff;
    border-radius: 10px;
    min-height: 60px;
  }
}

.Chat__me {

    &:before {
    content: '';
    position: absolute;
    display: block;
    width: 0;
    height: 0;
    right: -10px;
    top: 2px;
    border-left: 20px solid #fff;
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    transform: rotate(-45deg);
    }
}

.Chat__friend {
  padding-left: 40px!important;

  &:after {
    content: '';
    position: absolute;
    display: block;
    width: 0;
    height: 0;
    left: 30px;
    top: 2px;
    border-left: 20px solid #fff;
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    transform: rotate(225deg);
  }

  i {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    width: 30px;
    overflow: hidden;
    &:before {
      font-size: 60px;
    }
  }

}

.Chat-Form {
@at-root {
  .Chat-Form__file {
    i {
      &:before {
        font-size: 24px;
      }
    }
  }
  .Chat-Form__comment {
    
  }
  .Chat-Form__btn {
    
  }
}}
</style>

