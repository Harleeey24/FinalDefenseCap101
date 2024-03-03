<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Contracts\Auth\Authenticatable;

class TbUserAcc extends Model implements Authenticatable
{
    use HasFactory;
    protected $table = 'fms_g18_tbuseracc';
    protected $fillable = ['firstname', 'lastname','contact','image','email','username','password', 'role'];

    //search query
    
    public static function search($query)
    {
        return static::where('firstname', 'LIKE', "%$query%")
                     ->orWhere('lastname', 'LIKE', "%$query%")
                     ->orWhere('email', 'LIKE', "%$query%")
                     ->orWhere('contact', 'LIKE', "%$query%")
                     ->orWhere('username', 'LIKE', "%$query%")
                     ->orWhere('id', 'LIKE', "%$query%")
                     ->get();
    }


    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
