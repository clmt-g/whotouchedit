<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Intervention extends Model
{
    use SoftDeletes;

    protected $table = 'interventions';
    protected $primaryKey = 'idIntervention';
    protected $keyType = 'integer';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'idIntervention',
        'dateHeureDebut',
        'dateHeureFin',
        'description',
        'statut',
        'commentaire',
        'idMachine',
        'idUser'
        ];

    // --- Relations ---
    public function machine() : HasOne {
        return $this->hasOne(Machine::class, 'idMachine', 'idMachine');
    }

    public function user() : HasOne {
        return $this->hasOne(User::class, 'idUser', 'idUser');
    }
}
