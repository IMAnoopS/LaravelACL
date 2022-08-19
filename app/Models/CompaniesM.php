<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompaniesM extends Model
{
    use HasFactory;
    protected $table='companies';
    protected $fillable = [
        'name', 'email','logo'
    ];
    
    public function employeeDetail(){
        return $this->hasOne('App\Models\EmployeeM','company_id','id');
    }
}
