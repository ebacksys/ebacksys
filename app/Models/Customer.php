<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'service',
        'service_other',
        'business_address',
        'mailing_address',
        'year_end',
        'accounting_period',
        'ein',
        'company_group',
        'contact_person',
        'other_contact_person',
        'email',
        'fax',
        'telephone',
        'client_status',
        'remark',
        'description',
        'accounting_period'
    ];


    public function credentials()
    {
        return $this->hasMany(Credential::class);
    }
    
}
