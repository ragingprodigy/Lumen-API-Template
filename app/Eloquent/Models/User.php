<?php

namespace DevProject\Eloquent\Models;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use DevProject\Eloquent\UuidPrimaryKey;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User
 *
 * @package DevProject\Eloquent\Models
 * @property string $id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property string $last_login_from
 * @property boolean $is_admin
 * @property boolean $is_active
 * @property Carbon $last_login
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @OA\Schema(
 *     schema="User",
 *     description="User Model",
 *     allOf={
 *         @OA\Schema(ref="#/components/schemas/BaseModel")
 *     },
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="username", type="string"),
 *     @OA\Property(property="email", type="string", format="email"),
 *     @OA\Property(property="last_login_from", type="string"),
 *     @OA\Property(property="is_admin", type="boolean"),
 *     @OA\Property(property="is_active", type="boolean"),
 * )
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, UuidPrimaryKey;

    const TABLE_NAME = 'users';

    protected $table = self::TABLE_NAME;

    protected $casts = [
        'is_admin' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected $dates = [
        'last_login'
    ];

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'name'              => $this->getName(),
            'is_admin'          => $this->isAdmin(),
            'is_active'         => $this->isActive(),
            'last_login'        => $this->getLastLogin(),
            'last_login_from'   => $this->getLastLoginFrom(),
        ];
    }

    /**
     * @return string
     */
    public function getId(): string
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
     * @param string $name
     * @return User
     */
    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername(string $username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * @param bool $is_admin
     * @return User
     */
    public function setIsAdmin(bool $is_admin): User
    {
        $this->is_admin = $is_admin;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }

    /**
     * @param bool $is_active
     * @return User
     */
    public function setIsActive(bool $is_active): User
    {
        $this->is_active = $is_active;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): ?Carbon
    {
        return $this->created_at;
    }

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): ?Carbon
    {
        return $this->updated_at;
    }

    /**
     * @return string
     */
    public function getLastLoginFrom(): ?string
    {
        return $this->last_login_from;
    }

    /**
     * @param string $last_login_from
     * @return User
     */
    public function setLastLoginFrom(string $last_login_from): User
    {
        $this->last_login_from = $last_login_from;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getLastLogin(): ?Carbon
    {
        return $this->last_login;
    }

    /**
     * @param Carbon $last_login
     * @return User
     */
    public function setLastLogin(Carbon $last_login): User
    {
        $this->last_login = $last_login;
        return $this;
    }
}
