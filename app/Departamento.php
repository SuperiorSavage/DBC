<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departamento extends Model
{
    use SoftDeletes;
    
    protected $table      = 'departamentos';
    protected $primaryKey = 'departamento_id';

    protected $fillable = [
        'nombre',
    ];

    public function subdepartamentos()
    {
        return $this->belongsToMany('App\Subdepartamento','departamento_subdepartamento', 'departamento_id', 'subdepartamento_id');
    }

    public function documentos()
    {
        return $this->hasMany('App\Documento','departamento_id');
    }
}
