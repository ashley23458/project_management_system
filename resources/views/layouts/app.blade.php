<!-- Jigsaw. (2019). Blade Templates & Partials [Contains examples for structuring the blade template.].
Retrieved from https://jigsaw.tighten.co/docs/content-blade/ -->
<!--Bootstrap. (2019). Introduction [Contains an introduction template for setting up the css file and scripts].
(4.3.1). Retrieved from https://getbootstrap.com/docs/4.4/getting-started/introduction/-->
<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
    <head>
        @include('layouts.partials.head')
    </head>
    <body>
        <div class="wrapper">
            @include('layouts.partials.sidebar')
            <div id="content" class="container-fluid">
                @include('layouts.partials.navigation')
                @yield('content')
            </div>
        </div>
        @include('layouts.partials.footer') 
    </body>
</html>
