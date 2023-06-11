<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <x-adminlte-input name="iUser" wire:model="search" wire:click="clearSearch"
                                    id="search" placeholder="Search" label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-search text-lightblue" wire:click="render()"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                            </div>
                            <div class="col-md-2">
                                <select wire:model="selectedMonthID" onchange="resetGroups()" class="form-control"
                                    id="selectedMonthID"
                                    style="background-color: #17a2b8; color: rgb(255, 255, 255); font-size: 15px;">
                                    <option value="">Select Month</option>
                                    @foreach ($monthIDs as $monthID)
                                        <option value="{{ $monthID }}">{{ $monthID }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex h-full justify-center items-center w-1/3 text-red-500 text-xl">
                                <h5>Bookkeeping</h5>
                            </div>
                            <div class="col-md-2">
                                <button wire:click="confirmDelete('removeWorksheet', '{{ $selectedMonthID }}')"
                                    class="btn w-full px-3 py-2 border bg-gradient-primary rounded-lg">Remove
                                    Worksheet</button>
                            </div>
                            <div class="col-md-2">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#newWorksheetModal"
                                    class="btn w-full px-3 py-2 border rounded-md bg-amber-600 text-white">New
                                    Worksheet</button>
                            </div>


                        </div>
                        {{-- <hr class="my-2"> --}}
                        <div class="card-body">
                            <div class="flex flex-col">
                                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                        <div class="overflow-hidden">
                                            <table name="accountsTable" class="w-full border-spacing-1">
                                                <thead>
                                                    <tr class="h-12 border-b">
                                                        {{-- <th>Index and ID</th> --}}

                                                        <th class="w-1/6 px-4 py-2 border-r"
                                                            wire:click="sortBy('name')">
                                                            Name
                                                            @if ($sortField == 'name')
                                                                @if ($sortDirection == 'asc')
                                                                    <i class="fas fa-sort-up"></i>
                                                                @else
                                                                    <i class="fas fa-sort-down"></i>
                                                                @endif
                                                            @endif
                                                        </th>
                                                        <th class="w-1/6 px-4 py-2 border-r"
                                                            wire:click="sortBy('frequency')">
                                                            Frequency
                                                            @if ($sortField == 'frequency')
                                                                @if ($sortDirection == 'asc')
                                                                    <i class="fas fa-sort-up"></i>
                                                                @else
                                                                    <i class="fas fa-sort-down"></i>
                                                                @endif
                                                            @endif
                                                        </th>
                                                        <th class="w-1/6 px-4 py-2 border-r"
                                                            wire:click="sortBy('status')">
                                                            status
                                                            @if ($sortField == 'status')
                                                                @if ($sortDirection == 'asc')
                                                                    <i class="fas fa-sort-up"></i>
                                                                @else
                                                                    <i class="fas fa-sort-down"></i>
                                                                @endif
                                                            @endif
                                                        </th>
                                                        <th class="w-1/6 px-4 py-2 border-r"
                                                            wire:click="sortBy('pending')">
                                                            pending
                                                            @if ($sortField == 'pending')
                                                                @if ($sortDirection == 'asc')
                                                                    <i class="fas fa-sort-up"></i>
                                                                @else
                                                                    <i class="fas fa-sort-down"></i>
                                                                @endif
                                                            @endif
                                                        </th>
                                                        <th class="w-1/6 px-4 py-2 border-r"
                                                            wire:click="sortBy('name')">
                                                            last_recon_month
                                                            @if ($sortField == 'last_recon_month')
                                                                @if ($sortDirection == 'asc')
                                                                    <i class="fas fa-sort-up"></i>
                                                                @else
                                                                    <i class="fas fa-sort-down"></i>
                                                                @endif
                                                            @endif
                                                        </th>
                                                        <button type="button" data-bs-toggle="modal"
                                                            data-bs-target="#newClient"
                                                            class="btn px-3 py-2 border rounded-md bg-green-600 text-white">New
                                                            Accounting
                                                            Client</button>
                                                        <th class="w-1/6 px-4 py-2 border-r">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($allaccounts)
                                                        @foreach ($allaccounts->groupBy('customer.name') as $customerName => $accountsByCustomer)
                                                            <tr>
                                                                <td onclick="toggleGroups('{{ $customerName }}')"
                                                                    class="w-1/3 px-4 py-4 border-b bg-slate-500 text-white font-bold"
                                                                    colspan="8">
                                                                    <span class="mr-4">{{ $customerName }}</span>
                                                                </td>
                                                            </tr>
                                                            @foreach ($accountsByCustomer as $account)
                                                                <tr data-customer-name="{{ $customerName }}"
                                                                    class="border border-dashed border-gray-500">
                                                                    <td class="w-1/6 px-4 py-2 border border-gray-500">
                                                                        @if ($editIndex !== $account->id)
                                                                            {{ $account->account_name }}
                                                                        @else
                                                                            <input type="text"
                                                                                name="account[{{ $account->id }}][account_name]"
                                                                                class="form-control text-primary"
                                                                                value="{{ $account->account_name }}"
                                                                                id="account_name_{{ $account->id }}"
                                                                                onchange="passChangedValue('{{ $account->id }}', 'account_name')" />
                                                                        @endif
                                                                    </td>

                                                                    <td class="w-1/6 px-4 py-2 border-r">
                                                                        @if ($editIndex !== $account->id)
                                                                            {{ $account->frequency }}
                                                                        @else
                                                                            <select
                                                                                name="account.{{ $account->id }}.frequency"
                                                                                id="frequency_{{ $account->id }}"
                                                                                style="background-color: #17a2b8; color: white; font-size: 15px;"
                                                                                class="form-control"
                                                                                onchange="passChangedValue('{{ $account->id }}', 'frequency')">
                                                                                <option
                                                                                    value=" {{ $account->frequency }}">
                                                                                    {{ $account->frequency }}
                                                                                </option>
                                                                                <option value="M">M</option>
                                                                                <option value="Q">Q</option>
                                                                                <option value="Y">Y</option>
                                                                                <option value="OTHER">OTHER</option>
                                                                            </select>
                                                                        @endif
                                                                    </td>
                                                                    <td class="w-1/6 px-4 py-2 border-r">
                                                                        @if ($editIndex !== $account->id)
                                                                            {{ $account->status }}
                                                                        @else
                                                                            <select
                                                                                name="account.{{ $account->id }}.status"
                                                                                id="status_{{ $account->id }}"
                                                                                style="background-color: #17a2b8; color: white; font-size: 15px;"
                                                                                class="form-control"
                                                                                onchange="passChangedValue('{{ $account->id }}', 'status')">
                                                                                <option value="{{ $account->status }}">
                                                                                    {{ $account->status }}
                                                                                </option>
                                                                                <option
                                                                                    value="To download bank statements">
                                                                                    To download bank statements</option>
                                                                                <option value="To do bank recon">To do
                                                                                    bank
                                                                                    recon</option>
                                                                                <option value="To send financials">To
                                                                                    send
                                                                                    financials</option>
                                                                                <option value="OTHER">OTHER</option>
                                                                            </select>
                                                                        @endif

                                                                    </td>
                                                                    <td class="w-1/6 px-4 py-2 border-r">
                                                                        @if ($editIndex !== $account->id)
                                                                            {{ $account->pending }}
                                                                        @else
                                                                            <select
                                                                                name="account.{{ $account->id }}.pending"
                                                                                id="pending_{{ $account->id }}"
                                                                                style="background-color: #17a2b8; color: white; font-size: 15px;"
                                                                                class="form-control"
                                                                                onchange="passChangedValue('{{ $account->id }}', 'pending')">
                                                                                <option
                                                                                    value=" {{ $account->pending }}">
                                                                                    {{ $account->pending }}
                                                                                </option>
                                                                                <option value="YES"
                                                                                    {{ $account->pending == 'YES' ? 'selected' : '' }}>
                                                                                    YES</option>
                                                                                <option value="NO"
                                                                                    {{ $account->pending == 'NO' ? 'selected' : '' }}>
                                                                                    NO</option>
                                                                            </select>
                                                                        @endif

                                                                    </td>
                                                                    <td class="w-1/6 px-4 py-2 border-r">
                                                                        @if ($editIndex !== $account->id)
                                                                            {{ $account->last_recon_month }}
                                                                        @else
                                                                            <input type="text"
                                                                                name="account[{{ $account->id }}][last_recon_month]"
                                                                                class="form-control text-primary"
                                                                                value="{{ $account->last_recon_month }}"
                                                                                id="last_recon_month_{{ $account->id }}"
                                                                                onchange="passChangedValue('{{ $account->id }}', 'last_recon_month')" />
                                                                        @endif
                                                                    </td>
                                                                    <td class="w-1/6 px-4 py-2 border-r">
                                                                        @if ($editIndex !== $account->id)
                                                                            <button
                                                                                wire:click.stop="edit({{ $account->id }})"
                                                                                class="btn btn-sm btn-primary">Edit</button>
                                                                        @else
                                                                            <button
                                                                                wire:click.stop="save({{ $account }})"
                                                                                class="btn btn-sm btn-success">Save</button>
                                                                        @endif
                                                                        <button
                                                                            wire:click="addNew({{ $account->customer_id }})"
                                                                            class="btn btn-sm bg-gray-500 text-white">New</button>
                                                                        <button
                                                                            wire:click="confirmDelete('deleteAccount', '{{ $account->id }}')"
                                                                            class="btn btn-sm bg-red-500 text-white">Delete</button>
                                                                    </td>
                                                                </tr>
                                                                <tr data-customer-name="{{ $customerName }}"
                                                                    class="border-b-4">
                                                                    <td class="w-1/3 px-4 py-2 border border-blue-300"
                                                                        colspan="2">
                                                                        @if ($editIndex !== $account->id)
                                                                            QL: {{ $account->comment1 }}
                                                                        @else
                                                                            <textarea name="account[{{ $account->id }}][comment1]" class="form-control text-primary text-left"
                                                                                id="comment1_{{ $account->id }}" onchange="passChangedValue('{{ $account->id }}', 'comment1')">
                                                                            {{ $account->comment1 }}
                                                                            </textarea>
                                                                        @endif
                                                                    </td>

                                                                    <td class="w-1/3 px-4 py-2 border border-blue-300"
                                                                        colspan="2">
                                                                        @if ($editIndex !== $account->id)
                                                                            BB: {{ $account->comment2 }}
                                                                        @else
                                                                            <textarea name="account[{{ $account->id }}][comment2]"
                                                                                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-primary text-left"
                                                                                id="comment2_{{ $account->id }}" onchange="passChangedValue('{{ $account->id }}', 'comment2')">
                                                                                {{ $account->comment2 }} </textarea>
                                                                        @endif
                                                                    </td>
                                                                    <td class="w-1/3 px-4 py-2 border border-blue-300"
                                                                        colspan="2">
                                                                        @if ($editIndex !== $account->id)
                                                                            GT: {{ $account->comment3 }}
                                                                        @else
                                                                            <textarea name="account[{{ $account->id }}][comment3]" class="form-control text-primary text-left"
                                                                                id="comment3_{{ $account->id }}" onchange="passChangedValue('{{ $account->id }}', 'comment3')">
                                                                        {{ $account->comment3 }}
                                                                        </textarea>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                            <div>
                                                @if ($allaccounts)
                                                    {{ $allaccounts->links() }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function passChangedValue(accountId, $fieldname) {
            var inputField = document.getElementById($fieldname + '_' + accountId);
            var changedValue = inputField.value;

            Livewire.emit('changedValue', changedValue, $fieldname, accountId);
        }
    </script>
    <script>
        function toggleGroups(customerName) {
            var rows = document.querySelectorAll("[data-customer-name='" + customerName + "']");
            rows.forEach(function(row) {
                if (!row.hasAttribute('data-initial-display')) {
                    row.setAttribute('data-initial-display', row.style.display);
                }

                if (row.style.display === "none") {
                    row.style.display = row.getAttribute('data-initial-display');
                    row.removeAttribute('wire:ignore'); // Remove the wire:ignore directive
                } else {
                    row.style.display = "none";
                    row.setAttribute('wire:ignore', ''); // Add the wire:ignore directive
                }
            });
        }
    </script>
    <script>
        function resetGroups() {
            var rows = document.querySelectorAll('table[name="accountsTable"] tbody tr');
            rows.forEach(function(row) {
                row.removeAttribute('wire:ignore');
                row.removeAttribute('style');
                row.removeAttribute('data-initial-display');
            });
        }
    </script>

    <script>
        function promptNewWorksheet() {
            var selectedMonthID = document.getElementById('selectedMonthID').value;
            var newWorksheet = document.getElementById('newWorksheetid').value;
            if (selectedMonthID === '' || (newWorksheet !== null && newWorksheet === '')) {
                Swal.fire({
                    title: 'Error',
                    text: 'Please select the month that you want to duplicate and also the NAME of the worksheet',
                    icon: 'error'
                });
                return;
            }
            Livewire.emit('duplicateWorksheet', newWorksheet);

        }
    </script>
    <script>
        function removeWorksheet() {
            var selectedMonthID = document.getElementById('selectedMonthID').value;

            if (selectedMonthID === '') {
                alert('Please select a month first.');
                return;
            }

            var Worksheet = selectedMonthID;
            if (Worksheet !== null) {
                Livewire.emit('removeWorksheet', Worksheet);
            }
        }
    </script>


    <!-- Duplicate Worksheet Modal -->
    <div wire:ignore.self class="modal fade" id="newWorksheetModal" tabindex="-1"
        aria-labelledby="ndwWorksheetModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-green-600 text-white text-bold text-3xl text-center">
                    <h5 class="modal-title" id="newWorksheetModalLabel">Create New Worksheet</h5>
                </div>
                <form>
                    <div class="modal-body" style="height: 100px;">
                        <h1 class="text-gray-800 italic text-lg">Please enter the new worksheet name below: </h1>
                        <input type="text" id="newWorksheetid" class="form-control bg-slate-200" maxlength="30">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-small bg-gray-600 text-white"
                            data-bs-dismiss="modal">Close</button>
                        <button type="button" onclick="promptNewWorksheet()"
                            class="btn btn-small bg-red-800 text-white">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- New Accounting Client -->
    <div wire:ignore.self class="modal fade" id="newClient" tabindex="-1" aria-labelledby="newClientModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-dialog-size60">
            <div class="modal-content">
                <div class="modal-header bg-gray-600 text-white text-bold text-2xl text-center">
                    <h5 class="modal-title" id="newWorksheetModalLabel">Create New Client Account</h5>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row mb-1 mt-1">
                            <div class="col-6">
                                <label for="email" class="form-label text-success">Customer
                                    Name:</label>
                                <select wire:model="selectedClientID" class="form-control" id="selectedClientID"
                                    style="background-color: #17a2b8; color: rgb(255, 255, 255); font-size: 15px;">
                                    <option value="">Select Client</option>
                                    @foreach ($clientIDs->sortBy(function ($code, $id) {
                                        return $code;
                                    }) as $id => $code)
                                        <option value="{{ $id }}">
                                            {{ $code }}</option>
                                        {{-- <option value="{{ $id }}">{{ $id }} -
                                            {{ $code }}</option> --}}
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-6 mb-1 mt-1">
                                <label for="email" class="form-label text-success">Customer
                                    Account:</label>
                                <input type="email" wire:model.defer="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="frequency" class="form-label text-success">Frequency:</label>
                                <select name="nfrequency" id="nfrequency" wire:model="frequency"
                                    style="background-color: #17a2b8; color: white; font-size: 15px;"
                                    class="form-control">
                                    <option value="{{ $frequency }}">
                                        Frequency
                                    </option>
                                    <option value="M">M</option>
                                    <option value="Q">Q</option>
                                    <option value="Y">Y</option>
                                    <option value="OTHER">OTHER</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="nstatus" class="form-label text-success">Status:</label>
                                <select name="nstatus" id="nstatus" wire:model="status"
                                    style="background-color: #17a2b8; color: white; font-size: 15px;"
                                    class="form-control">
                                    <option value="{{ $status }}">
                                        Status
                                    </option>
                                    <option value="To download bank statements">
                                        To download bank statements</option>
                                    <option value="To do bank recon">To do
                                        bank
                                        recon</option>
                                    <option value="To send financials">To
                                        send
                                        financials</option>
                                    <option value="OTHER">OTHER</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="email" class="form-label text-success">Last_recon_month:</label>
                                <input type="email" wire:model.defer="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-1 mt-1">
                            <div class="col-4">
                                <label for="Comment1" class="form-label text-success text-center">Comment1:</label>
                                <textarea wire:model.defer="mailing_address" id="mailing_address"
                                    class="form-control @error('mailing_address') is-invalid @enderror">{{ old('mailing_address') }}</textarea>
                                @error('mailing_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="Comment2" class="form-label text-success text-center">Comment2:</label>
                                <textarea wire:model.defer="mailing_address" id="mailing_address"
                                    class="form-control @error('mailing_address') is-invalid @enderror">{{ old('mailing_address') }}</textarea>
                                @error('mailing_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="Comment3" class="form-label text-success text-center">Comment3:</label>
                                <textarea wire:model.defer="comment3" id="ncomment3" class="form-control @error('comment3') is-invalid @enderror">{{ old('comment3') }}</textarea>
                                @error('comment3')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-small bg-gray-600 text-white"
                                data-bs-dismiss="modal">Close</button>
                            <button type="button" onclick="promptNewWorksheet()"
                                class="btn btn-small bg-red-800 text-white">Create</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

</div>
