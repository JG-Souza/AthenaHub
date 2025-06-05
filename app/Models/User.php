<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Define os campos que podem ser preenchidos em massa
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'cpf',
    ];

    /**
     * Atributos ocultos nas respostas JSON.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Converte atributos automaticamente, como datas e senhas.
     *
     * 'email_verified_at' vira um objeto Carbon.
     * 'password' é armazenado de forma segura (hash).
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

    /**
     * Relacionamentos.
     */
    public function modules()
    {
        return $this->hasMany(Module::class); // Criar o model Module
    }

    public function grades()
    {
        return $this->hasMany(Grade::class); // Criar o model Grade
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class); // Criar o model Enrollment
    }
}
