<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Livewire\WithPagination;
use App\Models\Customer;
use Livewire\Component;
use App\Models\Credential;
use Illuminate\Validation\Rule;

use function Termwind\render;

class CustomerShow extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public  $customer_id, $code, $name, $service, $service_other, $business_address, $mailing_address, $year_end, $accounting_period, $ein,
        $company_group, $contact_person, $other_contact_person, $email, $fax, $telephone, $client_status,
        $remark, $description, $descriptionUpdate, $credentials;
    public $search = '';
    public $sortField = 'id'; // Set default sort field
    public $sortDirection = 'desc'; // Set default sort direction
    // public $allCredentials;

    protected $listeners = [
        'credentialUpdated', 'modalHidden'
    ];

    public function confirmDelete($confirmationType, $itemid)
    {
        $this->dispatchBrowserEvent('confirmDelete', [$confirmationType, $itemid]);
    }
    
    public function credentialUpdated($credentialData)
    {
        $this->credentials = $credentialData;
    }


    protected function rules()
    {
        return [
            'code' => [
                'required',
                'string',
                Rule::unique('customers')->ignore($this->customer_id, 'id'),
                Rule::unique('customers', 'code')->where(function ($query) {
                    return $query->where('code', $this->code)->where('id', '<>', $this->customer_id);
                }),
            ],
            'name' => 'required|string',
            'email' => 'nullable|regex:/^([\w+]+([\.-]?\w+)*@([\w-]+\.)+\w{2,})+(,\s*[\w+]+([\.-]?\w+)*@([\w-]+\.)+\w{2,})*$/',
            // 'email' => 'nullable|email',
            'service' => 'nullable',
            'service_other' => 'nullable',
            'business_address' => 'nullable',
            'mailing_address' => 'nullable',
            'year_end' => 'nullable',
            'accounting_period' => 'nullable',
            'ein' => 'nullable',
            'company_group' => 'nullable',
            'contact_person' => 'nullable',
            'other_contact_person' => 'nullable',
            'fax' => 'nullable',
            'telephone' => 'nullable',
            'client_status' => 'nullable',
            'remark' => 'nullable',
            'description' => 'nullable'

        ];
    }


    public function updated($fields)
    {
        $this->validateOnly($fields);
    }


    public function saveCustomer(Request $request)
    {
        $validatedData = $this->validate();

        //check if new save or update
        if (is_null($this->customer_id)) {
            $message = 'Customer saved successfully.';
        } else {
            $message = 'Customer is updated successfully.';
        }

        DB::beginTransaction();

        try {
            $customer = Customer::updateOrCreate(['id' => $this->customer_id], $validatedData);
            Credential::where('customer_id', $customer->id)->delete();

            if (!is_null($this->credentials)) {
                foreach ($this->credentials as $credential) {
                    $credentialData = [
                        'entity_name' => $credential['entity_name'],
                        'login_url' => $credential['login_url'],
                        'username' => $credential['username'],
                        'password' => $credential['password'],
                        'remarks' => $credential['remarks'],
                        'customer_id' => $customer->id
                    ];
                    $customer->credentials()->create($credentialData);
                }
            }

            DB::commit();

            session()->flash('message', $message);
            $this->dispatchBrowserEvent('close-modal');
            $this->render();
        } catch (\Exception $e) {
            DB::rollback();

            session()->flash('message', 'Error saving customer: ' . $e->getMessage());

            throw $e;
        }
    }
  
    public function deleteCustomer(int $customer_id)
    {
        $this->customer_id = $customer_id;
    }

    public function destroyCustomer()
    {
        DB::beginTransaction();

        try {
            Customer::find($this->customer_id)->delete();
            Credential::where('customer_id', $this->customer_id)->delete();
            DB::commit();

            session()->flash('message', 'Customer Deleted Successfully');
            $this->dispatchBrowserEvent('close-modal');
        } catch (\Exception $e) {
            DB::rollback();

            session()->flash('message', 'Failed to delete Customer. Please try again.');
            // Log the error or perform some other error handling here.
        }
    }




    public function editCustomer(string $customer_id)
    {
        $this->resetInput();
        $customer = Customer::find($customer_id);
        if ($customer) {
            $this->customer_id = $customer->id;
            $this->code = $customer->code;
            $this->name = $customer->name;
            $this->service = $customer->service;
            $this->service_other = "";
            $this->business_address = $customer->business_address;
            $this->mailing_address = $customer->mailing_address;
            $this->year_end = $customer->year_end;
            $this->accounting_period = $customer->accounting_period;
            $this->ein = $customer->ein;
            $this->company_group = $customer->company_group;
            $this->contact_person = $customer->contact_person;
            $this->other_contact_person = "";
            $this->email = $customer->email;
            $this->fax = $customer->fax;
            $this->telephone = $customer->telephone;
            $this->client_status = "";
            $this->remark = $customer->remark;
            $this->description = $customer->description;
            $this->emit('descriptionUpdate', $this->description);
        } else {
            return redirect()->to('/customers');
        }
    }


    public function modalHidden()
    {
        $this->resetInput();
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->render();
    }


    public function resetInput()
    {
        $this->code = '';
        $this->name = '';
        $this->service = '';
        // $this->service_other = '';
        $this->business_address = '';
        $this->mailing_address = '';
        $this->year_end = '';
        $this->accounting_period = '';
        $this->ein = '';
        $this->company_group = '';
        $this->contact_person = '';
        // $this->other_contact_person = '';
        $this->email = '';
        $this->fax = '';
        $this->telephone = '';
        // $this->client_status = '';
        $this->remark = '';
        $this->description = '';
        $this->descriptionUpdate = '';
        // $this->allCredentials ='';
    }



    public function mount()
    {
        $this->sortField = 'name';
        $this->sortDirection = 'asc';
    }

    public function render()
    {
        // info($this->loadedCredentials);
        $customers = Customer::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('telephone', 'like', '%' . $this->search . '%')
            ->orWhere('contact_person', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(15);

        return view('livewire.customer-show', ['customers' => $customers]);
    }

    public function sortBy($field)
    {
        if ($this->sortField == $field) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
}
