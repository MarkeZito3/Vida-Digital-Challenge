<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Sucursale
 *
 * @property $id
 * @property $direccion
 * @property $localidad
 * @property $telefono
 * @property $id_empresa_sucursales
 * @property $created_at
 * @property $updated_at
 *
 * @property Empleado[] $empleados
 * @property Empresa $empresa
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Sucursale extends Model
{
    
    static $rules = [
		'direccion' => 'required',
		'localidad' => 'required',
		'telefono' => 'required',
		'id_empresa_sucursales' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['direccion','localidad','telefono','id_empresa_sucursales'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function empleados()
    {
        return $this->hasMany('App\Models\Empleado', 'id_sucursales_empleados', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function empresa()
    {
        return $this->hasOne('App\Models\Empresa', 'id', 'id_empresa_sucursales');
    }
    

}
