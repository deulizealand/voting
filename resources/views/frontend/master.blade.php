<html lang="en">
    <head>
        @yield('head')
    </head>
    <body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
        <div class="wrapper">
            @if(auth()->user()->role_id!=3)
            @include('frontend.nav')
            @endif
            <div class="main">
                @include('frontend.header')
                <main class="content">
                    <div class="container-fluid p-0">
                        @yield('content')
                    </div>
                </main>
                @include('frontend.footer')
            </div>
        </div>
        @yield('footer')
        @stack('scripts')
        <script type="text/javascript">
            @if(Session::has('message'))
                var type = "{{ Session::get('alert-type', 'info') }}";
                switch(type){
                    case 'info':
                        toastr.info("{{ Session::get('message') }}",{positionClass:'toast-bottom-right',containerId:'toast-bottom-right'});
                        break;

                    case 'warning':
                        toastr.warning("{{ Session::get('message') }}",{positionClass:'toast-bottom-right',containerId:'toast-bottom-right'});
                        break;

                    case 'success':
                        toastr.success("{{ Session::get('message') }}",{positionClass:'toast-bottom-right',containerId:'toast-bottom-right'});
                        break;

                    case 'error':
                        toastr.error("{{ Session::get('message') }}",{positionClass:'toast-bottom-right',containerId:'toast-bottom-right'});
                        break;
                }
            @endif
        </script>
    </body>
</html>