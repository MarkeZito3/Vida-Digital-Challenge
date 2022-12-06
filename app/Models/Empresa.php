<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Empresa
 *
 * @property $id
 * @property $nombre
 * @property $logo
 * @property $created_at
 * @property $updated_at
 *
 * @property Sucursale[] $sucursales
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Empresa extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'logo' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','logo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sucursales()
    {
        return $this->hasMany('App\Models\Sucursale', 'id_empresa_sucursales', 'id');
    }
    

}
