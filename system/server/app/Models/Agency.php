<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Agency
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $phone_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Agency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Agency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Agency query()
 * @method static \Illuminate\Database\Eloquent\Builder|Agency whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agency wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agency whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Agency extends Model
{
    use HasFactory;

    protected $table = 'agency';
}
