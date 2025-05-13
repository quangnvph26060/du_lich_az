<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('frontends/assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontends/assets/css/style.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="icon" type="image/png" href="https://cdn6.aptoide.com/imgs/d/0/9/d0942da58c977cd77bda5e5d228dbd8a_icon.png">

</head>

<body>
    <header
        class="header-mobile dt-relative dt-container dt-h-20 dt-flex dt-items-center dt-justify-between background before:dt-bg-white before:dt-border-b before:dt-border-ce6e6e6">
        @include('frontend.partials.header-mobile')
    </header>

    <header class="header-pc container bg-wrap">
        @include('frontend.partials.header-destop')

    </header>

    <nav role="navigation" aria-label="menu" class="nav-pc container bg-wrap">
        @include('frontend.partials.nav')

    </nav>

    <main class="body container">
        @yield('content')
    </main>
    <div id="desktop-bottom-sticky-right" class="mdbl"></div>

    <footer class="footer container bg-wrap">
        @include('frontend.partials.footer')
    </footer>

    <nav id="menuWrapMobile" class="menu-wrap-mobile">
        <div class="menu-close-mobile" id="menuCloseMobile">×</div>
        @include('frontend.partials.menu-wrap-mobile')
    </nav>


    <script src="{{ asset('frontends/assets/js/script.js') }}"></script>
</body>

</html>
