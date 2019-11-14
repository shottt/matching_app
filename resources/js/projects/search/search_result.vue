<script>
import person_card from '../../components/card/person_card.vue';
export default {

  data: function () {
    return {
      search_query: ""
    }
  },
  components: {
    person_card,
  },
  template: `
  <main class="u-container-y">
    <div class="container-fluid">
      <ul class="table mb-0">
          <person_card></person_card>
      </ul>
    </div>
  </main>`
}
</script>