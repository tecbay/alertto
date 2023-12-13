<?php

namespace App\Http\Requests;

use App\Data\TargetingRuleData;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class AlertUpdateRequestData extends Data
{

    public static function authorize(): bool
    {
        return auth()->user()->id === request('alert')->user_id;
    }

    public function __construct(
        #[Required, Max(255)]
        public readonly string $message,

        #[Required, DataCollectionOf(TargetingRuleData::class)]
        public readonly DataCollection $rules
    ) {
    }
}
