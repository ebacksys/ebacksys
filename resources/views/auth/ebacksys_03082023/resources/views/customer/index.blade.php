@extends('adminlte::page')

@section('content')

<div class="container">
    <form action="/customers" method="POST" class="mx-auto">
        @csrf
        <div class="row mb-1 mt-1">
            <div class="col-6">
                <label for="customer_id" class="form-label text-success">Customer ID:</label>
                <input type="text" name="customer_id" id="customer_id" class="form-control mb-2 @error('customer_id') is-invalid @enderror" value="{{ old('customer_id') }}" required>
                @error('customer_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <label for="customer_name" class="form-label text-success">Customer Name:</label>
                <input type="text" name="customer_name" id="customer_name" class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name') }}" required>
                @error('customer_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingTwo" style="background-color: lightgreen">
                    <h5 class="mb-0 text-center">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Client's Detail
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row mb-4 ">
                            <div class="col-6">
                                <label for="customer_contact" class="form-label text-success">Customer Contact:</label>
                                <input type="text" name="customer_contact" id="customer_contact" class="form-control mb-2  @error('customer_contact') is-invalid @enderror" value="{{ old('customer_contact') }}" required>
                                @error('customer_contact')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="customer_email" class="form-label text-success">Customer Email:</label>
                                <input type="email" name="customer_email" id="customer_email" class="form-control @error('customer_email') is-invalid @enderror" value="{{ old('customer_email') }}" required>
                                @error('customer_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="customer_phone" class="form-label text-success">Customer Phone:</label>
                                <input type="text" name="customer_phone" id="customer_phone" class="form-control mb-2  @error('customer_phone') is-invalid @enderror" value="{{ old('customer_phone') }}" required>
                                @error('customer_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="customer_fax" class="form-label text-success">Customer Fax:</label>
                                <input type="text" name="customer_fax" id="customer_fax" class="form-control @error('customer_fax') is-invalid @enderror" value="{{ old('customer_fax') }}">
                                @error('customer_fax')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="customer_services" class="form-label text-success">Customer Services:</label>
                                <select name="customer_services" id="customer_services" style="background-color: lightgreen;" class="form-select form-control mb-2 @error('customer_services') is-invalid @enderror" required>
                                    <option value=""></option>
                                    <option value="Accounting" {{ old('customer_services') == 'Accounting' ? 'selected' : '' }}>Accounting</option>
                                    <option value="Tax" {{ old('customer_services') == 'Tax' ? 'selected' : '' }}>Tax</option>
                                    <option value="Other" {{ old('customer_services') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('customer_services')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label for="customer_year_end" class="form-label text-success ">Customer Year End:</label>
                                <select name="customer_year_end" id="customer_year_end" style="background-color: lightgreen;" class="form-select form-control @error('customer_year_end') is-invalid @enderror" required>
                                    <option value=""></option>
                                    <option value="January" {{ old('customer_year_end') == 'January' ? 'selected' : '' }}>January</option>
                                    <option value="February" {{ old('customer_year_end') == 'February' ? 'selected' : '' }}>February</option>
                                    <option value="March" {{ old('customer_year_end') == 'March' ? 'selected' : '' }}>March</option>
                                    <option value="April" {{ old('customer_year_end') == 'April' ? 'selected' : '' }}>April</option>
                                    <option value="May" {{ old('customer_year_end') == 'May' ? 'selected' : '' }}>May</option>
                                    <option value="June" {{ old('customer_year_end') == 'June' ? 'selected' : '' }}>June</option>
                                    <option value="July" {{ old('customer_year_end') == 'July' ? 'selected' : '' }}>July</option>
                                    <option value="August" {{ old('customer_year_end') == 'August' ? 'selected' : '' }}>August</option>
                                    <option value="September" {{ old('customer_year_end') == 'September' ? 'selected' : '' }}>September</option>
                                    <option value="October" {{ old('customer_year_end') == 'October' ? 'selected' : '' }}>October</option>
                                    <option value="November" {{ old('customer_year_end') == 'November' ? 'selected' : '' }}>November</option>
                                    <option value="December" {{ old('customer_year_end') == 'December' ? 'selected' : '' }}>December</option>
                                </select>
                                @error('customer_year_end')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label for="customer_group_name" class="form-label text-success">Customer Group Name:</label>
                                <input type="text" name="customer_group_name" id="customer_group_name" class="form-control @error('customer_group_name') is-invalid @enderror" value="{{ old('customer_fax') }}">
                                @error('customer_group_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="customer_EIN" class="form-label text-success">Customer EIN:</label>
                                <input type="text" name="customer_EIN" id="customer_EIN" class="form-control @error('customer_EIN') is-invalid @enderror" value="{{ old('customer_fax') }}">
                                @error('customer_EIN')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="customer_address" class="form-label text-success text-center">Customer Address:</label>
                                <textarea name="customer_address" id="customer_address" rows="4" class="form-control @error('customer_address') is-invalid @enderror" required>{{ old('customer_address') }}</textarea>
                                @error('customer_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="customer_mailing_address" class="form-label text-success text-center">Customer Mailing Address:</label>
                                <textarea name="customer_mailing_address" id="customer_mailing_address" rows="4" class="form-control @error('customer_mailing_address') is-invalid @enderror" required>{{ old('customer_mailing_address') }}</textarea>
                                @error('customer_mailing_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="customer_remark" class="form-label text-success text-center">Customer Mailing Address:</label>
                            <textarea name="customer_remark" id="customer_remark" rows="4" class="form-control @error('customer_remark') is-invalid @enderror" required>{{ old('customer_remark') }}</textarea>
                            @error('customer_remark')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endsection