<!DOCTYPE html>
<html>
    <head>
        @head
        @endhead

    </head>
    <body id="sign" class="{{ $body_color ?? '' }}">
        @header
        @yield('main')

        
        @footer
        <script src="/js/app.js"></script>
    </body>
</html>