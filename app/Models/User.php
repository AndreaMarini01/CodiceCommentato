<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "users";
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'email',
        'password',
        'telefono',
        'datadinascita',
        'username',
        'cognome',
        'genere',
        'role'
    ];

    //Proprietà presente di default nel model
    //In questo modo viene tolta
    public $timestamps = false;


    //Serve nei middleware per l'accesso autorizzato a seconda della classe di utenza
    public function hasRole($role) {
        $role = (array)$role;
        return in_array($this->role, $role);
    }


}
