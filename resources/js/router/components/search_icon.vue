<script>
  export default {
    props: [
       'pattern'
    ],
    template: `
    <router-link class="c-right-icon" to='/search'>
      <img src="/images/search-icon.png" alt="">
    </router-link>
    `
  }
</script>