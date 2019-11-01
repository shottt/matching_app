<script>
//親
import child from "";
export default {
  props: {

  },
  data: function () {
    return {

    }
  },
  componens: {
    child
  },
  template: `
    <child></child>
  `
}
</script>
<script>
export default {
  props: {

  },
  data: function () {
    return {

    }
  },
  componens: {
    child
  },
  template: `
    <div>
      <router-view name="aaa"></router-view>
    </div>
  `
}
</script>