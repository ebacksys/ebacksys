<!DOCTYPE html>
<html lang="en">

<head>

    @extends('adminlte::page')

    @section('title', 'Customer')

    @section('content_header')
    @vite('resources/css/app.css')

    @stop
</head>

<body class="antialiased font-sans bg-gray-200">
    @section('content')
    <div class="container-fluid">
        <livewire:customer-show />
    </div>
    @endsection

    @section('css')
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('vendor/customcss/custom.css') }}">
    @stop


    @section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        window.addEventListener('close-modal', event => {
            $('#customerModal').modal('hide');
            $('#updateCustomerModal').modal('hide');
            $('#deleteCustomerModal').modal('hide');
        })
    </script>
    <script src="{{ asset('vendor/customjs/custom.js') }}"></script>
    @stop

</body>
</html>