<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Empleado
 *
 * @property $id
 * @property $nombre
 * @property $apellido
 * @property $dni
 * @property $telefono
 * @property $domicilio
 * @property $email
 * @property $cargos
 * @property $id_sucursales_empleados
 * @property $created_at
 * @property $updated_at
 *
 * @property Sucursale $sucursale
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Empleado extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'apellido' => 'required',
		'dni' => 'required',
		'telefono' => 'required',
		'domicilio' => 'required',
		'email' => 'required',
		'cargos' => 'required',
		'id_sucursales_empleados' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','apellido','dni','telefono','domicilio','email','cargos','id_sucursales_empleados'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sucursale()
    {
        return $this->hasOne('App\Models\Sucursale', 'id', 'id_sucursales_empleados');
    }
    

}
