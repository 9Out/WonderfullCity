<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>

        @yield('title')

    </title>
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('links')

</head>

<body>
    @include('admin.components.header', ['main' => false])

    <main class="main-crud">
        <div class="content">

            @yield('content')

        </div>
    </main>

    @include('admin.components.footer')


    @stack('scripts')
    <script>
        // Reset form
        const resetFormBtn = document.getElementById('resetFormBtn');
        const inputForm = document.getElementById('inputForm');
        resetFormBtn.addEventListener('click', () => {
            inputForm.reset();
            resetPreview();
        });

        // Reset before back
        document.getElementById('backButton').addEventListener('click', function (event) {
            event.preventDefault(); // Mencegah redirect langsung
            const form = document.getElementById('inputForm');
            form.reset(); // Reset isi form
            resetPreview();
            window.location.href = this.getAttribute('href'); // Arahkan ke halaman index
        });
    </script>
</body>

</html>