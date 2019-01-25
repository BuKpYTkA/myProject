<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

/**
 * Class User
 * @package App
 *
 * @property int $id
 * @property string $name
 * @property string $alias
 * @property string $email
 * @method static getPersonalInfoRules()
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'alias', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return array
     */
    public function getUserInfoRules(): array
    {
        $rules = [
            'name' => [
                'string',
                'min:3',
                'max:50',
                Rule::unique('users')->ignore(auth()->user()->id)
            ],
            'email' => [
                'email',
                Rule::unique('users')->ignore(auth()->user()->id)
            ],
            'alias' => [
                'string',
                'min:1',
                'max:50',
                Rule::unique('users')->ignore(auth()->user()->id),
            ],
        ];
        return $rules;
    }

    /**
     * @return array
     */
    public function getPasswordRules(): array
    {
        return [
            'newPass' => 'required|string|min:6',
            'repeatPass' => 'required|same:newPass',
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
