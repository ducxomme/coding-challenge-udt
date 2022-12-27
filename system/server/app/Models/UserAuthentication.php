<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserAuthentication
 *
 * @property int $id
 * @property int $user_id
 * @property int $role_id
 * @property string $password
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuthentication newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuthentication newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuthentication query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuthentication whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuthentication whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuthentication wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuthentication whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuthentication whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAuthentication whereUserId($value)
 * @mixin \Eloquent
 */
class UserAuthentication extends Model
{
    use HasFactory;
}
