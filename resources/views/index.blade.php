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


        <head></header>

        <main class="container u-conainer-y text-center" id="main">

          <sign-register></sign-register>
          
          
          <a class="mt-3 u-txt-w3 d-inline-block w-100 text-center">パスワード忘れましたか？</a>
          
          
          <button-sign-register></button-sign-register>

        </main>

        <footer></footer>


      </div>
      <script src=" {{ mix('js/app.js') }} "></script>
    </body>
</html>


  