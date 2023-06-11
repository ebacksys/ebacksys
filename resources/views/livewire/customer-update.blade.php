<!-- Update Customer Modal -->
<div wire:ignore.self class="modal fade" id="updateCustomerModal" tabindex="-1" aria-labelledby="updateCustomerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-dialog-size90">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateCustomerModalLabel">Edit Customer {{ $customer_id }}</h5>
            </div>
            <form wire:submit.prevent="saveCustomer">
                @csrf
                <div class="container-fluid my-4">
                    <div class="row mb-1 mt-1">
                        <div class="col-4">
                            <label for="code" class="form-label text-success">Customer ID:</label>
                            <input type="text" wire:model.defer="code" id="code"
                                class="form-control mb-2 @error('code') is-invalid @enderror"
                                value="{{ old('code') }}" required>
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="name" class="form-label text-success">Customer Name:</label>
                            <input type="text" wire:model.defer="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="contact_person" class="form-label text-success">Customer Contact:</label>
                            <input type="text" wire:model.defer="contact_person" id="contact_person"
                                class="form-control mb-2  @error('contact_person') is-invalid @enderror"
                                value="{{ old('contact_person') }}">
                            @error('contact_person')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <h2>
                            <button
                                class="form-control rounded bg-info py-4 d-flex align-items-center justify-content-center"
                                type="button" aria-expanded="true" aria-controls="collapseTwo">
                                <h3 class="center text-white m-0">Customer Detail</h3>
                            </button>
                        </h2>

                        <div class="modal-body">

                            <div class="row mb-1 mt-1">

                                <div class="col-4">
                                    <label for="email" class="form-label text-success">Customer
                                        Email:</label>
                                    <input type="email" wire:model.defer="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <label for="telephone" class="form-label text-success">Customer
                                        Phone:</label>
                                    <input type="text" wire:model.defer="telephone" id="telephone"
                                        class="form-control mb-2  @error('telephone') is-invalid @enderror"
                                        value="{{ old('telephone') }}">
                                    @error('telephone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <label for="fax" class="form-label text-success">Customer
                                        Fax:</label>
                                    <input type="text" wire:model.defer="fax" id="fax"
                                        class="form-control @error('fax') is-invalid @enderror"
                                        value="{{ old('fax') }}">
                                    @error('customer_fax')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-2">
                                    <label for="service" class="form-label text-success">Customer
                                        Services:</label>
                                    <select wire:model.defer="service" id="service"
                                        style="background-color: #17a2b8; color: white; font-size: 15px;"
                                        class="form-select form-control mb-2 @error('service') is-invalid @enderror">
                                        <option value="">Service Type...</option>
                                        <option value="Accounting"
                                            {{ old('service') == 'Accounting' ? 'selected' : '' }}>
                                            Accounting</option>
                                        <option value="Tax" {{ old('service') == 'Tax' ? 'selected' : '' }}>
                                            Tax</option>
                                        <option value="Other" {{ old('service') == 'Other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                    @error('service')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-2">
                                    <label for="year_end" class="form-label text-success ">Customer Year
                                        End:</label>
                                    <select wire:model.defer="year_end" id="year_end"
                                        style="background-color: #17a2b8; color: white; font-size: 15px;"
                                        class="form-select form-control @error('year_end') is-invalid @enderror">
                                        <option value="">Fiscal Month End...</option>
                                        <option value="January" {{ old('year_end') == 'January' ? 'selected' : '' }}>
                                            January
                                        </option>
                                        <option value="February" {{ old('year_end') == 'February' ? 'selected' : '' }}>
                                            February
                                        </option>
                                        <option value="March" {{ old('year_end') == 'March' ? 'selected' : '' }}>March
                                        </option>
                                        <option value="April" {{ old('year_end') == 'April' ? 'selected' : '' }}>April
                                        </option>
                                        <option value="May" {{ old('year_end') == 'May' ? 'selected' : '' }}>May
                                        </option>
                                        <option value="June" {{ old('year_end') == 'June' ? 'selected' : '' }}>June
                                        </option>
                                        <option value="July" {{ old('year_end') == 'July' ? 'selected' : '' }}>July
                                        </option>
                                        <option value="August" {{ old('year_end') == 'August' ? 'selected' : '' }}>
                                            August
                                        </option>
                                        <option value="September"
                                            {{ old('year_end') == 'September' ? 'selected' : '' }}>
                                            September</option>
                                        <option value="October" {{ old('year_end') == 'October' ? 'selected' : '' }}>
                                            October
                                        </option>
                                        <option value="November"
                                            {{ old('year_end') == 'November' ? 'selected' : '' }}>November
                                        </option>
                                        <option value="December"
                                            {{ old('year_end') == 'December' ? 'selected' : '' }}>December
                                        </option>
                                    </select>
                                    @error('year_end')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-2">
                                    <label for="accounting_period" class="form-label text-success">Accounting
                                        Period:</label>
                                    <select wire:model.defer="accounting_period" id="accounting_period"
                                        style="background-color: #17a2b8; color: white; font-size: 15px;"
                                        class="form-select form-control mb-2 @error('accounting_period') is-invalid @enderror">
                                        <option value="">Accounting Period...</option>
                                        <option value="Monthly"
                                            {{ old('accounting_period') == 'Monthly' ? 'selected' : '' }}>
                                            Monthly</option>
                                        <option value="Quarterly"
                                            {{ old('accounting_period') == 'Quarterly' ? 'selected' : '' }}>
                                            Quarterly</option>
                                        <option value="Yearly"
                                            {{ old('accounting_period') == 'Yearly' ? 'selected' : '' }}>
                                            Yearly</option>
                                        <option value="Other"
                                            {{ old('accounting_period') == 'Other' ? 'selected' : '' }}>
                                            Other
                                        </option>
                                    </select>
                                    @error('service')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-3">
                                    <label for="company_group" class="form-label text-success">Customer
                                        Group Name:</label>
                                    <input type="text" wire:model.defer="company_group" id="company_group"
                                        class="form-control @error('company_group') is-invalid @enderror"
                                        value="{{ old('company_group') }}">
                                    @error('company_group')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-3">
                                    <label for="ein" class="form-label text-success">Customer
                                        EIN:</label>
                                    <input type="text" wire:model.defer="ein" id="ein"
                                        class="form-control @error('ein') is-invalid @enderror"
                                        value="{{ old('ein') }}">
                                    @error('ein')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="business_address" class="form-label text-success text-center">Customer
                                        Address:</label>
                                    <textarea wire:model.defer="business_address" id="business_address"
                                        class="form-control @error('business_address') is-invalid @enderror">{{ old('business_address') }}</textarea>
                                    @error('business_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="mailing_address" class="form-label text-success text-center">Customer
                                        Mailing
                                        Address:</label>
                                    <textarea wire:model.defer="mailing_address" id="mailing_address"
                                        class="form-control @error('mailing_address') is-invalid @enderror">{{ old('mailing_address') }}</textarea>
                                    @error('mailing_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12" hidden>
                                    <label for="remark" class="form-label text-success text-center">Remarks:</label>
                                    <textarea wire:model.defer="remark" id="remark" class="form-control @error('remark') is-invalid @enderror">{{ old('remark') }}</textarea>
                                    @error('remark')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="container-fluid">
                        <div wire:ignore class="col-12">
                            <label for="description" class="form-label text-success text-center">Description:</label>
                            <textarea wire:model="description" name="description" id="description-update"
                                class="form-control @error('description') is-invalid @enderror description"></textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="container-fluid">
                            <livewire:credentials :customer_id="$customer_id" :wire:key="'credentials-'.$customer_id" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm bg-pink-900 text-white" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm bg-red-500 text-white">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Wait for the DOM to load
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize the accordion component
            var accordions = document.querySelectorAll('.accordion');
            accordions.forEach(function(accordion) {
                new bootstrap.Collapse(accordion);
            });
        });
    </script>
</div>


<!-- Delete Customer Modal -->
<div wire:ignore.self class="modal fade" id="deleteCustomerModal" tabindex="-1"
    aria-labelledby="deleteCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gray-600 text-white text-bold text-3xl text-center">
                <h5 class="modal-title" id="deleteCustomerModalLabel">Delete Customer</h5>
            </div>
            <form wire:submit.prevent="destroyCustomer">
                <div class="modal-body" style="height: 100px;">
                    <h1 class="text-red-500 italic text-bold text-lg">Are you sure you want to delete this data?</h1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-small bg-gray-800 text-white" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-small bg-red-800 text-white">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
