<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Client extends Model
{
    use HasFactory;
    public function username()
    {
        return 'cpf';
    }

    // Certifique-se de que activation_token está no array fillable
    protected $fillable = [
        'name',
        'cpf',
        'email',
        'password',
        'activation_token',  // Certifique-se de que este campo está presente
        'is_active',
    ];
}
