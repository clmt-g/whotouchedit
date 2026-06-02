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

    /** For 'admin' or 'responsable' returns all the interventions
     * For other roles, (such as 'operateur') returns the interventions created by the user
     * Is refered to as 'ForUser' when called
     * @param $query - The query in whitch the function was caller
     * @param $user - The user logged in
     * @return \LaravelIdea\Helper\App\Models\_IH_Intervention_QB
     */
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
