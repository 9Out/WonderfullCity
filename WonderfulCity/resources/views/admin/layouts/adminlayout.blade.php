<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @hasSection('title')
        <title>
            @if (trim($__env->yieldContent('title')) !== 'Dashboard') 
            {{ config('app.name') }} |
            @endif

            @yield('title') 

        </title>
    @endif
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    @stack('links')

</head>

<body>
    @include('admin.components.header')

    @include('admin.components.sidebar')

    <main class="main">
        <div class="content">

            @yield('content')
            
        </div>
    </main>

    @include('admin.components.footer')


    @section('content-js')
        <script src="{{ asset('js/admin.js') }}"></script>
    @show
</body>

</html>