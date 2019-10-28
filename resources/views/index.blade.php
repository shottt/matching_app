<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <script>
        window.Laravel = { csrfToken: '{{ csrf_token() }}' }
      </script>
      <title>Document</title>
      <link rel='stylesheet' href='/css/app.css'>
    </head>
    
    <body id="sign" class="bg-main">
      <div id="vue_body">

      

        
        <!--header-->
        
        <router-view name="c_header"></router-view>
        
        <!--main-->
        <router-view name="c_main"></router-view>



        <router-view name="c_footer"></router-view>
     <!--
     
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
            
          </ul>
        </footer>
  -->
       

      </div><!--end vue_body-->
      <script src=" {{ mix('js/app.js') }} "></script>
    </body>
</html>


  