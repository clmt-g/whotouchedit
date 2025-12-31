<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Machine extends Model
{
    use softDeletes;

    protected $table = 'machines';
    protected $primaryKey = 'idMachine';
    protected $keyType = 'integer';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'idMachine',
        'nom',
        'reference',
        'dateInstallation',
        'etat',
        'criticite',
        'localisation'
    ];

    // --- Relations --- à faire plus tard

}
