<script>
  export default {
    props: [
       'prop_pattern'
    ],
    template: `
    <router-link class="c-right-icon" to='/search'>
      <img src="/images/search-icon.png" alt="">
    </router-link>
    `,
    beforeCreate: function () {
      console.log("beforeCreate icon: ");
    },
    created: function () {
      console.log("created icon: ");
    },
    beforeMount: function () {
      console.log("beforeMount icon: ");
    },
    mounted: function () {
      console.log("mounted icon: ");
    },
    beforeUpdate: function () {
      console.log("beforeUpdate icon: ");
    },
    updated: function () {
      console.log("updated icon: ");
    },
    activated: function () {
      console.log("activated icon: ");
    },
    deactivated: function () {
      console.log("deactivated icon: ");
    },
    beforeDestroy: function () {
      console.log("beforeDestroy icon: ");
    },
    destroyed: function () {
      console.log("destroyed icon: ");
    },

    
  }
</script>