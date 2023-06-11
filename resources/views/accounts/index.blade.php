<!DOCTYPE html>
<html lang="en">

<head>

    @extends('adminlte::page')

    @section('title', 'Bookkeeping')

    @section('content_header')
    @vite('resources/css/app.css')
    @stop

</head>

<body class="antialiased font-sans bg-gray-200">
    @section('content')
    <div>
        <livewire:accounts />
    </div>
    @endsection

    @section('css')
    <!-- <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('vendor/customcss/custom.css') }}">
    @stop


    @section('js')
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vendor/customjs/custom.js') }}"></script>

    <script>
        document.addEventListener('confirmDelete', function(event) {
            var confirmationType = event.detail[0];
            var itemId = event.detail[1];
            var confirmationMessage = '';
            switch (confirmationType) {
                case 'deleteAccount':
                    confirmationMessage = 'Are you sure you want to delete this account?';
                    break;
                case 'removeWorksheet':
                    var selectedMonthID = document.getElementById('selectedMonthID').value;
                    if (selectedMonthID === '') {
                        Swal.fire({
                            title: 'Error',
                            text: 'Please select the month that you want to remove',
                            icon: 'error'
                        });
                        return;
                    }
                    confirmationMessage = 'Are you sure you want to delete the worksheet?';
                    break;
            }

            Swal.fire({
                title: 'Confirmation',
                text: confirmationMessage,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    switch (confirmationType) {
                        case 'deleteAccount':
                            Livewire.emit('deleteAccount', itemId);
                            break;
                        case 'removeWorksheet':
                            Livewire.emit('removeWorksheet', itemId);
                            break;
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener('successDelete', function() {
            Swal.fire({
                title: 'Deleted',
                text: 'You have succesfully deleted the item',
                icon: 'success'

            });
        });
    </script>
    <script>
        document.addEventListener('failedEvent', function(event) {
            var failed = event.detail[0];
            Swal.fire({
                title: 'Failed',
                text: 'The attempt to process has failed due to: '.failed,
                icon: 'failed'

            });
        });
    </script>
    <script>
        document.addEventListener('successSaved', function() {
            Swal.fire({
                title: 'Saved',
                text: 'You have succesfully saved/created the item',
                icon: 'success'
            });
        });
    </script>
    <script>

        window.addEventListener('close-modal', event => {
            document.getElementById('newWorksheetid').value ='';
            $('#newWorksheetModal').modal('hide');
        })

    </script>

    @stop

</body>

</html>