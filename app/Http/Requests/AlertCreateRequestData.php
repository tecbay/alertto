<?php

namespace App\Http\Requests;

use App\Data\TargetingRuleData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class AlertCreateRequestData extends Data
{
    public function __construct(
        #[Required, Max(255)]
        public readonly string $message,

        #[Required, DataCollectionOf(TargetingRuleData::class)]
        public readonly DataCollection $rules
    ) {
    }
}
