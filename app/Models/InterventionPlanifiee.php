<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InterventionPlanifiee extends Model
{
    use SoftDeletes;

    protected $table = 'interventions_planifiees';
    protected $primaryKey = 'idInterventionPlanifiee';
    protected $keyType = 'integer';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'dateDebut',
        'dateFin',
        'type',
        'description',
        'statut',
        'frequence',
        'idMachine'
    ];

    protected $casts = [
        'dateDebut' => 'datetime',
        'dateFin' => 'datetime',
    ];

    // Relation Many-to-Many avec User (techniciens)
    public function techniciens()
    {
        return $this->belongsToMany(
            User::class,
            'intervention_planifiee_techniciens',
            'idInterventionPlanifiee',
            'idUser'
        );
    }

    /** For 'admin' or 'responsable' returns all the interventions
     * For other roles, (such as 'operateur') returns the interventions created by the user
     * Is refered to as 'ForUser' when called
     * @param $query - The query in whitch the function was caller
     * @param $user - The user logged in
     * @return \LaravelIdea\Helper\App\Models\_IH_Intervention_QB
     */
    public function scopeForUser($query, $user) {
        if ($user->role === 'admin' || $user->role === 'responsable') {
            return $query;
        }
        return $query->whereHas('techniciens', function ($inter) use ($user) {
            $inter->where('id', $user->id);
        });
    }

    // Relation avec Machine
    public function machine()
    {
        return $this->belongsTo(Machine::class, 'idMachine', 'idMachine');
    }
}
