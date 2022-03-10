<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" type="text/css">
    <title>Alerty - SQL Query Checker</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.27.0/themes/prism.min.css" integrity="sha512-tN7Ec6zAFaVSG3TpNAKtk4DOHNpSwKHxxrsiw4GHKESGPs5njn/0sMCUMl2svV4wo4BK/rCP7juYz+zx+l6oeQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100 font-mono">

<h1 class="mt-12 text-center text-gray-700 text-2xl">
    Alerty - SQL Query Checker
</h1>

<div class="flex justify-center">
    <div class="container mt-10">
        {{ $slot }}

        <div class="mt-12 mb-4 text-center font-light text-xs text-gray-700">
            <a class="text-decoration-none text-indigo-500" target="_blank" href="https://github.com/rezaamini-ir/migrator">Alerty</a> is a bad query identifier for Laravel.
        </div>
    </div>
</div>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.addEventListener('show-message', (event) => {
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: event.detail.type,
            title: event.detail.message
        })
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.27.0/components/prism-core.min.js" integrity="sha512-LCKPTo0gtJ74zCNMbWw04ltmujpzSR4oW+fgN+Y1YclhM5ZrHCZQAJE4quEodcI/G122sRhSGU2BsSRUZ2Gu3w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.27.0/plugins/autoloader/prism-autoloader.min.js" integrity="sha512-GP4x8UWxWyh4BMbyJGOGneiTbkrWEF5izsVJByzVLodP8CuJH/n936+yQDMJJrOPUHLgyPbLiGw2rXmdvGdXHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.27.0/plugins/normalize-whitespace/prism-normalize-whitespace.min.js" integrity="sha512-jkelqcQ/rwCw36MumZ5fWlgs+aZEMLrgGt51ParMK7Tyam7kB5ZG+mB5R0NSeoGVr/4N+q3oGpLaFR/vXgzjTA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    Prism.plugins.NormalizeWhitespace.setDefaults({
        'remove-trailing': true,
        'remove-indent': true,
        'left-trim': true,
        'right-trim': true,
    });
</script>
</body>
</html>
