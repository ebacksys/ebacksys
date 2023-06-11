<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Account;
use Illuminate\Validation\Rule;

class Accounts extends Component

{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $account_name, $frequency, $last_recon_month, $status, $pending, $monthly_instructions, $month_id,
        $comment1, $comment2, $comment3, $customer_id;
    public $search = '';
    public $sortField = 'id'; // Set default sort field
    public $sortDirection = 'desc'; // Set default sort direction
    public $editIndex = -1;
    public $accounts = [];
    public $monthIDs  = [];
    public $selectedMonthID;
    public $clientIDs  = [];
    public $selectedClientID;
    public $newWorkSheet;
    protected $listeners = ['changedValue', 'duplicateWorksheet', 'removeWorksheet', 'deleteAccount'];

    protected $rules = [
        'accounts.*.customer_id' => 'required',
        'accounts.*.account_name' => 'nullable',
        'accounts.*.frequency' => 'nullable',
        'accounts.*.last_recon_month' => 'nullable',
        'accounts.*.status' => 'nullable',
        'accounts.*.pending' => 'nullable',
        'accounts.*.month_id' => 'nullable',
        'accounts.*.monthly_instructions' => 'nullable',
        'accounts.*.comment1' => 'nullable',
        'accounts.*.comment2' => 'nullable',
        'accounts.*.comment3' => 'nullable'

    ];

    public function confirmDelete($confirmationType, $itemid)
    {
        $this->dispatchBrowserEvent('confirmDelete', [$confirmationType, $itemid]);
    }


    public function deleteAccount($accountid)
    {
        $account = Account::find($accountid);
        $account->delete();
        $this->dispatchBrowserEvent('successDelete');
    }
    public function loadMonthIDs()
    {
        $this->monthIDs = Account::distinct()->pluck('month_id')->sort();
        
    }

    public function loadClientIDs()
    {
        $this->clientIDs = Customer::distinct()
        ->pluck('code', 'id')
        ->sortBy(function ($code, $id) {
            return $code;
        });
            // dd($this->clientIDs);        
    }

    public function changedValue($value, $fieldname, $accountid)   //save each row's fields
    {
        try {
            $existingAccount = Account::find($accountid);
            $existingAccount->update([$fieldname => trim($value)]);

            $value = "";
            $fieldname = "";
            $accountid = "";
        } catch (\Exception $e) {
            session()->flash('message', 'Error saving customer: ' . $e->getMessage());
            throw $e;
        }
    }



    public function edit($rowindex)
    {
        $this->editIndex = $rowindex;
    }

    public function addNew($customerid)
    {
        try {
            $newAccount = new Account();
            $newAccount->month_id = $this->selectedMonthID;
            $newAccount->account_name = '';
            $newAccount->last_recon_month = '';
            $newAccount->frequency = '';
            $newAccount->status = '';
            $newAccount->pending = '';
            $newAccount->monthly_instructions = '';
            $newAccount->comment1 = '';
            $newAccount->comment2 = '';
            $newAccount->comment3 = '';
            $newAccount->customer_id = $customerid;
            $newAccount->save();
            session()->flash('message', 'New account added: ');
        } catch (\Exception $e) {
            session()->flash('message', 'Error adding new account: ' . $e->getMessage());
            throw $e;
        }
    }

    public function save($account)
    {
        $this->dispatchBrowserEvent('successSaved');
        $this->editIndex = -1;
    }

    public function mount()
    {
        $this->accounts = Account::all()->toArray();
        $this->sortField = 'customers.name';
        $this->sortDirection = 'asc';
        $this->loadMonthIDs();
        $this->loadClientIDs();
    }



    public function clearSearch()
    {
        $this->search = '';
        $this->render();
    }

    public function removeWorksheet($workSheet)
    {
        $existingWorksheet = Account::where('month_id', $workSheet);
        $existingWorksheet->delete();
        $this->dispatchBrowserEvent('successDelete');
        $this->loadMonthIDs();
    }

    public function duplicateWorksheet($newWorkSheet)
    {
        try {
            $existingAccounts = Account::where('month_id', $this->selectedMonthID)->get();
            foreach ($existingAccounts as $existingAccount) {
                $newAccount = new Account();
                $newAccount->month_id = $newWorkSheet;
                $newAccount->account_name = $existingAccount->account_name;
                $newAccount->last_recon_month = $existingAccount->last_recon_month;
                $newAccount->frequency = $existingAccount->frequency;
                $newAccount->status = $existingAccount->status;
                $newAccount->pending = $existingAccount->pending;
                $newAccount->monthly_instructions = $existingAccount->monthly_instructions;
                $newAccount->comment1 = $existingAccount->comment1;
                $newAccount->comment2 = $existingAccount->comment2;
                $newAccount->comment3 = $existingAccount->comment3;
                $newAccount->customer_id = $existingAccount->customer_id;
                $newAccount->save();
                $this->loadMonthIDs();
                $this->dispatchBrowserEvent('close-modal');
                $this->dispatchBrowserEvent('successSaved');

            }
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('failedEvent', $e);
        }

        $this->newWorkSheet = $newWorkSheet;
    }


    public function render()
    {
        // dd('render');
        $allaccounts = null;

        if ($this->selectedMonthID) {
            $allaccounts = Account::select('accounts.*', 'customers.name')
                ->join('customers', 'customers.id', '=', 'accounts.customer_id')
                ->where('accounts.month_id', '=', $this->selectedMonthID)
                ->where(function ($query) {
                    $query->where('accounts.account_name', 'like', '%' . $this->search . '%')
                        ->orWhere('accounts.frequency', 'like', '%' . $this->search . '%')
                        ->orWhere('accounts.last_recon_month', 'like', '%' . $this->search . '%')
                        ->orWhere('accounts.status', 'like', '%' . $this->search . '%')
                        ->orWhere('accounts.pending', 'like', '%' . $this->search . '%')
                        ->orWhere('accounts.comment1', 'like', '%' . $this->search . '%')
                        ->orWhere('accounts.comment2', 'like', '%' . $this->search . '%')
                        ->orWhere('accounts.comment3', 'like', '%' . $this->search . '%')
                        ->orWhere('customers.name', 'like', '%' . $this->search . '%');
                })
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(50);
        }

        return view('livewire.accounts', ['allaccounts' => $allaccounts]);

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
