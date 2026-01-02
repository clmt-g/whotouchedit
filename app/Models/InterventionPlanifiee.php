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

    // RelationMany-to-Many avec User (techniciens)
    public function techniciens()
    {
        return $this->belongsToMany(
            User::class,
            'intervention_planifiee_techniciens',
            'idInterventionPlanifiee',
            'idUser'
        );
    }

    // Relation avec Machine
    public function machine()
    {
        return $this->belongsTo(Machine::class, 'idMachine', 'idMachine');
    }

    // relation Many-to-many avec technicen (table : intervention_planifiee_techniciens)
    // Pour récupérer tout les technicien d'une intervention planifier
    public function technicien()
    {
        return $this->belongsToMany(
            User::class,
            'intervention_planifiee_techniciens', // table pivot
            'idInterventionPlanifiee',
            'idUser'
        );
    }
}
