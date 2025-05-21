    <header class="header">
        <div class="box1">
            <div class="menu-toggle" onclick="toggleSidebar()"><i id="menu-toggle" class="fa-solid fa-bars"></i></div>
            <div class="logo"><a href="">{{ config('app.name') }}</a></div>
        </div>
        @if (Auth::check())
        <div class="user">
            {{ Auth::user()->name }}
            <div class="profile-picture">
                <img src="{{ asset('default-profile.png') }}">
            </div>
        </div>
        @endif
    </header>