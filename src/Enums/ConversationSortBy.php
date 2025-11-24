<?php

namespace SmartDato\Desk365\Enums;

enum ConversationSortBy: string
{
    case EarliestFirst = 'earliest_on_top';
    case LatestFirst = 'latest_on_top';
}
