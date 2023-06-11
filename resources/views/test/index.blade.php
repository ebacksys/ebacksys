<div>
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
                            <div class="col-md-4 text-center text-danger" style="height: 50%;">
                                <h2>Bookkeeping</h2>
                            </div>

                            <div class="col-md-2">
                                <button type="button"
                                    class="form-control btn bg-gradient-secondary btn-sm rounded-lg float-end"
                                    data-bs-toggle="modal" data-bs-target="#accountModalDuplicate">
                                    Duplicate Worksheet
                                </button>
                            </div>
                            <div class="col-md-2">
                                <button type="button"
                                    class="form-control btn bg-gradient-info btn-sm rounded-lg float-end"
                                    data-bs-toggle="modal" data-bs-target="#accountModalAdd">
                                    Add New Account
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
                            <table class="table table-responsive table-borderd table-striped">
                                <thead>
                                    <tr>
                                        <th wire:click="sortBy('id')">
                                            ID
                                            @if ($sortField == 'id')
                                                @if ($sortDirection == 'asc')
                                                    <i class="fas fa-sort-up"></i>
                                                @else
                                                    <i class="fas fa-sort-down"></i>
                                                @endif
                                            @endif
                                        </th>
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
                                        <th wire:click="sortBy('account_name')">
                                            account_name
                                            @if ($sortField == 'account_name')
                                                @if ($sortDirection == 'asc')
                                                    <i class="fas fa-sort-up"></i>
                                                @else
                                                    <i class="fas fa-sort-down"></i>
                                                @endif
                                            @endif
                                        </th>
                                        <th wire:click="sortBy('status')">
                                            status
                                            @if ($sortField == 'status')
                                                @if ($sortDirection == 'asc')
                                                    <i class="fas fa-sort-up"></i>
                                                @else
                                                    <i class="fas fa-sort-down"></i>
                                                @endif
                                            @endif
                                        </th>
                                        <th wire:click="sortBy('pending')">
                                            pending
                                            @if ($sortField == 'pending')
                                                @if ($sortDirection == 'asc')
                                                    <i class="fas fa-sort-up"></i>
                                                @else
                                                    <i class="fas fa-sort-down"></i>
                                                @endif
                                            @endif
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($accounts as $index => $account)
                                        <tr wire:key="row-{{ $index }}">>
                                            <td>
                                                @if ($editIndex !== $index)
                                                    {{ $account->id }}
                                                @else
                                                    <input type="text" name="account[{{ $index }}][id]"
                                                        class="form-control text-primary" value={{ $account->id }} />
                                                @endif
                                            </td>
                                            <td>
                                                @if ($editIndex !== $index)
                                                    {{ $account->customer->name }}
                                                @else
                                                    <input type="text"
                                                        name="account[{{ $index }}][customer->name]"
                                                        class="form-control text-primary"
                                                        value={{ $account->customer->name }} />
                                                @endif
                                            </td>
                                            <td>
                                                @if ($editIndex !== $index)
                                                    {{ $account->account_name }}
                                                @else
                                                    <input type="text"
                                                        name="account[{{ $index }}][account_name]"
                                                        class="form-control text-primary"
                                                        value={{ $account->account_name }} />
                                                @endif
                                            </td>
                                            <td>
                                                @if ($editIndex !== $index)
                                                    {{ $account->status }}
                                                @else
                                                    <input type="text" name="account[{{ $index }}][status]"
                                                        class="form-control text-primary"
                                                        value={{ $account->status }} />
                                                @endif
                                            </td>
                                            <td>
                                                @if ($editIndex !== $index)
                                                    {{ $account->pending }}
                                                @else
                                                    <input type="text" name="account[{{ $index }}][pending]"
                                                        class="form-control text-primary"
                                                        value={{ $account->pending }} />
                                                @endif
                                            </td>
                                            <td class="col-1">
                                                @if ($editIndex !== $index)
                                                    <button wire:click="edit({{ $index }})"
                                                        class="btn btn-sm btn-primary">Edit</button>
                                                @else
                                                    <button wire:click="save({{ $index }})"
                                                        class="btn btn-sm btn-success">Save</button>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="row bg-gradient">
                                            <td class="col-4">
                                                @if ($editIndex !== $index)
                                                    {{ $account->comment1 }}
                                                @else
                                                    <input type="text" name="account[{{ $index }}][comment1]"
                                                        class=" text-primary" value={{ $account->comment1 }} />
                                                @endif
                                            </td>
                                            <td class="col-4">
                                                <input type="text" name="account[{{$index}}][comment2]" class="form-control" wire:model="account.{{$index}}.comment2" />
                                              </td>
                                            <td class="col-4">
                                                @if ($editIndex !== $index)
                                                {{ $account->comment3 }}
                                                @else
                                                    <input type="text"
                                                        wire:model='accounts.{{ $index }}.comment3'
                                                        id="comment3">
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">No Record Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
