<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Machine extends Model
{
    use softDeletes;

    protected $table = 'machines';
    protected $primaryKey = 'idMachine';
    protected $keyType = 'integer';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'nom',
        'reference',
        'dateInstallation',
        'etat',
        'criticite',
        'localisation',
        'notes'
    ];

    // --- Relations ---
    // FIXME : quand on clique sur une machine depuis intervention.show, on peut voir toutes les inter d'une machine
    public function interventions() : HasMany {
        return $this->hasMany(Intervention::class, 'idMachine', 'idMachine');
    }

}
