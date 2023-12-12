<?php

namespace App\Data;

use App\Enums\TargetingRuleAction;
use App\Enums\TargetingRuleCondition;
use App\Rules\UrlPath;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class TargetingRuleData extends Data
{
    public function __construct(
        #[Required, Enum(TargetingRuleAction::class)]
        public readonly string $action,
        #[Required, Enum(TargetingRuleCondition::class)]
        public readonly string $condition,
        #[Required, Rule(new UrlPath())]
        public readonly string $value
    ) {
    }
}
