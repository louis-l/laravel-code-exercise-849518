<?php

namespace App\Models;

use App\Events\CompanyCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * @mixin IdeHelperCompany
 */
class Company extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'logo',
        'website',
    ];

    protected $dispatchesEvents = [
        'created' => CompanyCreated::class,
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
