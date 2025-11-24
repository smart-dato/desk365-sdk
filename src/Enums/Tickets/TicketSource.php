<?php

namespace SmartDato\Desk365\Enums\Tickets;

enum TicketSource: int
{
    case Email = 1;
    case MicrosoftTeams = 5;
    case SupportPortal = 6;
    case PhoneOrOther = 7;
    case WebForm = 12;
    case WebWidget = 13;
    case API = 15;

}
