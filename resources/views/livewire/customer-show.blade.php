<div>
    @include('livewire.customer-create')
    @include('livewire.customer-update')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                <x-adminlte-input name="iUser" wire:model="search" wire:click="clearSearch"
                                    id="search" placeholder="Search" label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-search text-lightblue" wire:click="render()"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                            </div>
                            <div class="flex h-full justify-center items-center w-1/3 text-red-500 text-xl">
                                <h5>Customer</h5>
                            </div>

                            <div class="col-md-4 d-flex align-items-center justify-content-end px-5">
                                <button type="button"
                                    class="btn bg-indigo-600 rounded-lg float-end text-white"
                                    data-bs-toggle="modal" data-bs-target="#customerModal">
                                    Add New Customer
                                </button>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="card-body">
                            @if (session()->has('message'))
                                <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: '{{ session('message') }}',
                                    });
                                </script>
                            @endif

                            <table class="table table-borderd table-striped">
                                <thead>
                                    <tr>
                                        {{-- <th wire:click="sortBy('id')">
                                            ID
                                            @if ($sortField == 'id')
                                                @if ($sortDirection == 'asc')
                                                    <i class="fas fa-sort-up"></i>
                                                @else
                                                    <i class="fas fa-sort-down"></i>
                                                @endif
                                            @endif
                                        </th> --}}
                                        <th wire:click="sortBy('name')">
                                            Name
                                            @if ($sortField == 'name')
                                                @if ($sortDirection == 'asc')
                                                    <i class="fas fa-sort-up"></i>
                                                @else
                                                    <i class="fas fa-sort-down"></i>
                                                @endif
                                            @endif
                                        </th>
                                        <th wire:click="sortBy('email')">
                                            Email
                                            @if ($sortField == 'email')
                                                @if ($sortDirection == 'asc')
                                                    <i class="fas fa-sort-up"></i>
                                                @else
                                                    <i class="fas fa-sort-down"></i>
                                                @endif
                                            @endif
                                        </th>
                                        <th wire:click="sortBy('telephone')">
                                            Phone
                                            @if ($sortField == 'telephone')
                                                @if ($sortDirection == 'asc')
                                                    <i class="fas fa-sort-up"></i>
                                                @else
                                                    <i class="fas fa-sort-down"></i>
                                                @endif
                                            @endif
                                        </th>
                                        <th wire:click="sortBy('contact_person')">
                                            Contact
                                            @if ($sortField == 'contact_person')
                                                @if ($sortDirection == 'asc')
                                                    <i class="fas fa-sort-up"></i>
                                                @else
                                                    <i class="fas fa-sort-down"></i>
                                                @endif
                                            @endif
                                        </th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($customers as $customer)
                                        <tr>
                                            {{-- <td>{{ $customer->id }}</td> --}}
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->telephone }}</td>
                                            <td>{{ $customer->contact_person }}</td>
                                            <td>
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#updateCustomerModal"
                                                    wire:click="editCustomer({{ $customer->id }})"
                                                    class="btn bg-gray-600 text-white">
                                                    Edit
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#deleteCustomerModal"
                                                    wire:click="deleteCustomer({{ $customer->id }})"
                                                    class=" btn bg-red-600 text-white">Delete</button>
                                            </td>
                                        </tr>                                     
                                    @empty
                                        <tr>
                                            <td colspan="7">No Record Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div>
                                {{ $customers->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            tinymce.init({
                selector: '.description',
                plugins: 'lists advlist table emoticons insertdatetime autoresize link autolink',
                toolbar: 'numlist bullist table emoticons insertdatetime link',
                min_height: 200,
                advlist_bullet_styles: 'square',
                branding: false,
                setup: function(editor) {
                    editor.on('init change', function() {
                        editor.save();
                    });
                    editor.on('change', function(e) {
                        @this.set('description', editor.getContent());
                    });
                }
            });

            Livewire.on('descriptionUpdate', function(value) {
                if (value == null || typeof value === 'undefined') {
                    value = '';
                }
                tinymce.get('description-update').setContent(value);
            });
        </script>
        <script>
            var headTitle = `
                    <div style="text-align: left; margin-left: 10px">
                    <strong>Welcome!</strong><br>
                    You are now logged in!
                    </div>`;
            window.addEventListener('swal', function(e) {
                Swal.fire({
                    html: true,
                    title: headTitle + e.detail.title,
                    icon: 'success',
                    iconColor: e.detail.iconColor,
                    timer: 3000,
                    position: 'center',
                    showConfirmButton: false,
                    confirmButtonText: 'Cool'
                });
            });
        </script>
        <script>
            $('#customerModal').on('hidden.bs.modal', function() {
                Livewire.emit('modalHidden');
            });
        </script>
        <script>
            $('#updateCustomerModal').on('hidden.bs.modal', function() {
                Livewire.emit('modalHidden');
            });
        </script>
    @endpush

</div>
