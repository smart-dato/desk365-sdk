<?php

namespace SmartDato\Desk365\Enums\Tickets;

enum TicketCategory: string
{
    case PICKUP = '🚚 Pickup';
    case DELIVERY = '📦 Delivery';
    case SPECIAL_REQUEST = '📣 Special Request';
    case PAYMENT_INVOIVE = '💳 Payment & Invoive';
    case EPC_QUOTE = '📑 EPC quote';
    case GENERAL_INFORMATION = 'ℹ️ General information';
    case OTHER = '💬 Other';

}
