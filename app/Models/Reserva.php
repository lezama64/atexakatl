<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla si es diferente
    protected $table = 'reservas'; // o el nombre exacto de tu tabla

    // Especificar la clave primaria
    protected $primaryKey = 'idReserva';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'fechaReserva',
        'estado',
        'noPersonas',
        'whatsapp',
        'comentarios',
        'usuariosid',
        'rutasidRuta'
    ];

    protected $casts = [
        'fechaReserva' => 'date',
    ];

    // Si quieres desactivar los timestamps
    public $timestamps = false;

    // Relaciones (ajusta según tus modelos)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuariosid');
    }

    public function ruta()
    {
        return $this->belongsTo(Ruta::class, 'rutasidRuta');
    }
}

