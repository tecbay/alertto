<?php

namespace App\Http\Controllers;

use App\Data\TargetingRuleData;
use App\Enums\TargetingRuleAction;
use App\Enums\TargetingRuleCondition;
use App\Models\Alert;
use Illuminate\Support\Str;

class ScriptController extends Controller
{
    public string $path;
    public Alert $alert;
    public bool $show = false;
    public string $jsCode = '';

    public function __construct()
    {
        $this->alert = Alert::findOrFail(request('id'));
        $this->path = request('path');
    }

    public function __invoke()
    {

        $this->applyShowableTargetingRules();

        $this->applyHideableTargetingRules();

        if ($this->show) {
            $this->jsCode = "alert('{$this->alert->message}')";
        }

        return response($this->jsCode)
            ->header('Content-Type', 'application/javascript');
    }

    protected function isShowable(TargetingRuleData $rule): bool
    {
        $value = Str::of($rule->value)->trim('/');
        $path = Str::of($this->path)->trim('/');

        return match (TargetingRuleCondition::tryFrom($rule->condition)) {
            TargetingRuleCondition::CONTAINS => Str::contains($this->path, $rule->value),
            TargetingRuleCondition::EQUALS => $path->exactly($value),
            TargetingRuleCondition::START_WITH => $path->startsWith($value),
            TargetingRuleCondition::END_WITH => $path->endsWith($value),
            default => false,
        };
    }

    protected function isHideable(TargetingRuleData $rule): bool
    {
        $value = Str::of($rule->value)->trim('/');
        $path = Str::of($this->path)->trim('/');

        return match (TargetingRuleCondition::tryFrom($rule->condition)) {
            TargetingRuleCondition::CONTAINS => Str::contains($this->path, $rule->value),
            TargetingRuleCondition::EQUALS => $path->exactly($value),
            TargetingRuleCondition::START_WITH => $path->startsWith($value),
            TargetingRuleCondition::END_WITH => $path->endsWith($value),
            default => false,
        };
    }

    public function applyShowableTargetingRules(): void
    {
        foreach ($this->alert->targeting_rules->where('action', TargetingRuleAction::SHOW->value) as $targetingRule) {
            if ($this->show = $this->isShowable($targetingRule)) {
                break;
            }
        }
    }

    public function applyHideableTargetingRules(): void
    {
        foreach ($this->alert->targeting_rules->where('action', TargetingRuleAction::HIDE->value) as $targetingRule) {
            if ($this->isHideable($targetingRule)) {
                $this->show = false;
                break;
            }
        }
    }
}
