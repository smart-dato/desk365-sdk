<?php

namespace SmartDato\Desk365\Enums\Tickets;

enum TicketPriority: int
{
    case Low = 1;
    case Medium = 5;
    case High = 10;
    case Urgent = 20;
}
