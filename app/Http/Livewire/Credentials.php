<?php

namespace App\Http\Livewire;

use App\Models\Credential;
use Livewire\Component;

class Credentials extends Component
{
    public $customer_id;
    public $loadedCredentials = [];
    public $allCredentials = [];


    public function render()
    {
        // info($this->loadedCredentials);
        return view('livewire.credentials');
    }

    public function updated($name, $value)
    {
        $this->emit("credentialUpdated", $this->allCredentials);
    }

    public function mount()
    {
        $this->allCredentials = Credential::where('customer_id', $this->customer_id)->get()->toArray();

        // $this->loadedCredentials = [
        //     ['entity_name' => '', 'login_url' => '']
        // ];
    }

    public function addCredential()
    {

        $this->allCredentials[] =
            [
                'entity_name' => '',
                'login_url' => '',
                'username' => '',
                'password' => '',
                'remarks' => ''

            ];

        $this->emit("credentialUpdated", $this->allCredentials);
    }

    public function removeCredential($index)
    {
        unset($this->allCredentials[$index]);
        $this->emit("credentialUpdated", $this->allCredentials);
    }
}
