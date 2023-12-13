<?php

namespace App\Models;

use App\Data\TargetingRuleData;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\LaravelData\DataCollection;

class Alert extends Model
{
    use HasFactory, HasUlids;

    public $incrementing = false;

    protected $primaryKey = 'ulid';

    protected $keyType = 'string';

    protected $guarded = [];

    protected $hidden = [];

    protected $casts = [
        'message'         => 'string',
        'targeting_rules' => DataCollection::class.':'.TargetingRuleData::class,
    ];
}
