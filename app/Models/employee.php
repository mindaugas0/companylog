<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class employee extends Model
{
    use HasFactory;
    use Sortable;

    public $sortable = ['id', 'name', 'surname', 'birthday', 'details'];

    public function Company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
