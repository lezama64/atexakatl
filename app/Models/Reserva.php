<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reservas';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'idReserva';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'fechaReserva',
        'estado',
        'noPersonas',
        'whatsapp',
        'comentarios',
        'usuariosidUsuario',
        'rutasidRuta'
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'fechaReserva' => 'date',
            'noPersonas' => 'integer',
            'whatsapp' => 'integer',
            'usuariosidUsuario' => 'integer',
            'rutasidRuta' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * Relación con el modelo Usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'usuariosid', 'id');
    }

    /**
     * Relación con el modelo Ruta
     */
    public function ruta()
    {
        return $this->belongsTo(Ruta::class, 'rutasidRuta', 'idRuta');
    }
}