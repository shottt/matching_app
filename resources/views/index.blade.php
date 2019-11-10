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
        
        <router-view name="c_header"></router-view>
        
        <router-view name="c_main"></router-view>

        <router-view name="c_footer"></router-view>

      </div><!--end vue_body-->
      <script src=" {{ mix('js/app.js') }} "></script>
    </body>
</html>


  