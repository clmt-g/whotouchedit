<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Intervention extends Model
{
    use SoftDeletes;

    protected $table = 'interventions';
    protected $primaryKey = 'idIntervention';
    protected $keyType = 'integer';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'dateHeureDebut',
        'dateHeureFin',
        'description',
        'statut',
        'commentaire',
        'idMachine',
        'idUser'
    ];

    // --- Scopes ---
    public function scopeForUser($query, $user)
    {
        if ($user->role === 'admin' || $user->role === 'responsable') {
            return $query;
        }
        return $query->where('idUser', $user->id);
    }

    // --- Relations ---
    public function machine() : HasOne {
        return $this->hasOne(Machine::class, 'idMachine', 'idMachine');
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class, 'idUser', 'id')->withTrashed();
    }
}
