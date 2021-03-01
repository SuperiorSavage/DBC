<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartamentoSubdepartamento extends Model
{
    use SoftDeletes;
    
    protected $table      = 'departamento_subdepartamento';
    protected $primaryKey = 'departamento_subdepartamento_id';

    protected $fillable = [
        'departamento_id',
        'subdepartamento_id',
    ];

}
