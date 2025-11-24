<?php

namespace SmartDato\Desk365\Enums\Tickets;

enum TicketType: string
{
    case Question = '🙋 Question';
    case Incident = '☝️Incident';
    case Problem = '🙌 Problem';
    case Request = '📬 Request';
}
