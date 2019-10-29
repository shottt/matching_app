
<script>
export default {
    props: [
       'pattern'
    ],
    template: `
    <footer class="c-Footer container">
        <ul class="nav">
            <li class="nav-item col">
                <router-link class="nav-link active" to='/home'>
                    <img src="/images/footer/home-icon--active.png" alt="" class="img-fluid">
                </router-link><br>
            </li>
            <li class="nav-item col">
                  <router-link class="nav-link" to="/">
                      <img src="/images/footer/frends-icon.png" alt="" class="img-fluid">
                  </router-link>
            </li>
        </ul>
    </footer>
    `
}

</script>


       <!--
              <li class="nav-item col">
                  <router-link class="nav-link" to="/">
                      <img src="/images/footer/frends-icon.png" alt="" class="img-fluid">
                  </router-link>
              </li>
         
              <li class="nav-item col">
                  <router-link class="nav-link" :to="{name: 'f_messages'}">
                      <img src="/images/footer/messages-icon.png" alt="" class="img-fluid">
                  </router-link>
              </li>
              <li class="nav-item col">
                  <router-link class="nav-link" :to="{name: 'f_settings'}">
                      <img src="/images/footer/settings-icon.png" alt="" class="img-fluid">
                  </router-link>
              </li>
              -->
  