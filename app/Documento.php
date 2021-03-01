<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documento extends Model
{
    protected $table      = 'documentos';
    protected $primaryKey = 'documento_id';

    protected $fillable = [
        'nombre',
        'ruta',
        'departamento_id',
        'subdepartamento_id',
        
    ];

    public function departamento()
    {
        return $this->belongsTo('App\Departamento', 'departamento_id');
    }

    public function subdepartamento()
    {
        return $this->belongsTo('App\Subdepartamento', 'subdepartamento_id');
    }
}
