<!-- Jigsaw. (2019). Blade Templates & Partials [Contains examples for structuring the blade template.].
Retrieved from https://jigsaw.tighten.co/docs/content-blade/ -->
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
                @if (session('status'))
                    <div class="alert alert-success " role="alert">
                        {{session('status')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
        @include('layouts.partials.footer')
    </body>
</html>
