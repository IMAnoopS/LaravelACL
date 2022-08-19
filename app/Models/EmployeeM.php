<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeM extends Model
{
    use HasFactory;
     protected $table='employees';
    protected $fillable = [
        'firstName','lastName','company_id', 'email','phone'
    ];
    
    public function companyDetail(){
        return $this->belongsTo('App\Models\CompaniesM','company_id','id');
    }
}
