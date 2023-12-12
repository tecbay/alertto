<?php

namespace App\Enums;

enum TargetingRuleCondition: string
{
    case CONTAINS = 'contains';
    case EQUALS = 'equals';
    case START_WITH = 'start-with';
    case END_WITH = 'end-with';
}
