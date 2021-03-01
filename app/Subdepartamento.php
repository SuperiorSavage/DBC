<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subdepartamento extends Model
{
    use SoftDeletes;

    protected $table      = 'subdepartamentos';
    protected $primaryKey = 'subdepartamento_id';

    protected $fillable = [
        'nombre',
        'departamento_id',
    ];

    public function departamentos()
    {
        return $this->belongsToMany('App\Departamento','departamento_subdepartamento', 'subdepartamento_id', 'departamento_id');
    }

    public function documentos()
    {
        return $this->hasMany('App\Documento','subdepartamento_id');
    }
}

