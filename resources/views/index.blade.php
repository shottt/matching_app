<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <script>
        window.Laravel = { 
          csrfToken: '{{ csrf_token() }}',}
          // ログインしているかどうかで条件分岐する
        '{{ $user = Auth::user()}}'
        window.Laravel = { 
          my_data: { 
            'id': '{{ $user->id }}',
            'name': '{{ $user->name }}',
            'email': '{{ $user->email }}',
            'occupation': '{{ $user->occupation }}',
            'profile_header': '{{ $user->profile_header }}',
            'profile_detail': '{{ $user->profile_detail }}',
            'birthday': '{{ $user->birthday }}',
            'location': '{{ $user->location }}',
            'picture': '{{ $user->picture }}',
            //'review': '{{ $user->review }}',
          },
          id : '{{ $user->id }}',
        }
      </script>
      <title>Document</title>
      <link rel='stylesheet' href='/css/app.css'>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    </head>
    
    <body id="sign" class="bg-main">
      @guest 
        <script>
          window.location = "/";
        </script>
      @endguest
      @auth
      <form id="logout-form" class="c-logout" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="u-text-pink">logout</button>
      </form>
      @endauth
      <div id="vue_body">
        <router-view name="c_header"></router-view>
        
        <router-view name="c_main"></router-view>

        <router-view name="c_footer"></router-view>

      </div><!--end vue_body-->
      <script src=" {{ mix('js/app.js') }} "></script>
    </body>
</html>


  