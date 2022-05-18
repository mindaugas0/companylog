<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class company extends Model
{
    use HasFactory;
    use Sortable;

    public $sortable = ['id', 'name', 'code', 'adress', 'description'];

    public $sortableAs = ['company_employee_count'];

    public function companyEmployee()
    {
        return $this->hasMany(Employee::class, 'company_id', 'id');
    }
}
