<script>
import person_card from '../../components/card/person_card.vue';
export default {

  data: function () {
    return {
      search_query: "",
    }
  },
  components: {
    person_card,
  },
  template: `
  <main class="u-container-y">
    <person_card></person_card>
  </main>`
}
</script>