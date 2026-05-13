<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, softDeletes, Impersonate;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    public $incrementing = true;
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- Relations ---
    public function interventions(): HasMany
    {
        return $this->hasMany(Intervention::class, 'idUser', 'id');
    }

    // relation Many-to-many (table pivot : intervention_planifiees_technicien)
    // Pour récupérer toutes les interventions planifier d'un user par exemple
    public function interventionsPlanifiees()
    {
        return $this->belongsToMany(
            InterventionPlanifiee::class,
            'intervention_planifiee_techniciens',
            'idUser',
            'idInterventionPlanifiee'
        );
    }

    // Définit qui peut être impersonnifié
    public function canBeImpersonated(): bool
    {
        return $this->role !== 'admin';
    }

    // Définit qui peut impersonnifier
    public function canImpersonate(): bool
    {
        return $this->role === 'admin';
    }
}
