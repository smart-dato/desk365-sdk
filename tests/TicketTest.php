<?php

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use SmartDato\Desk365\Data\Tickets\CreateTicketData;
use SmartDato\Desk365\Data\Tickets\CustomFieldsData;
use SmartDato\Desk365\Data\Tickets\UpdateTicketData;
use SmartDato\Desk365\Desk365;
use SmartDato\Desk365\Enums\Tickets\TicketPriority;
use SmartDato\Desk365\Enums\Tickets\TicketStatus;
use SmartDato\Desk365\Enums\Tickets\TicketType;
use SmartDato\Desk365\Requests\Tickets\AddNoteRequest;
use SmartDato\Desk365\Requests\Tickets\AddReplyRequest;
use SmartDato\Desk365\Requests\Tickets\CreateTicketRequest;
use SmartDato\Desk365\Requests\Tickets\GetTicketConversationsRequest;
use SmartDato\Desk365\Requests\Tickets\GetTicketDetailsRequest;
use SmartDato\Desk365\Requests\Tickets\GetTicketsRequest;
use SmartDato\Desk365\Requests\Tickets\UpdateTicketRequest;

beforeEach(function () {
    $this->desk = new Desk365;
});

it('can collect tickets', function () {
    MockClient::global([
        GetTicketsRequest::class => MockResponse::fixture('Tickets/GetTicketsRequest'),
        GetTicketDetailsRequest::class => MockResponse::fixture('Tickets/GetTicketDetailsRequest'),
    ]);

    $tickets = $this->desk->connector()->send(
        new GetTicketsRequest
    );

    $ticketNumber = $tickets->json('tickets.29.ticket_number');

    $ticket = $this->desk->connector()->send(
        new GetTicketDetailsRequest(
            ticketNumber: $ticketNumber
        )
    );

    expect($ticket->json('ticket_number'))->toBe($ticketNumber);
});

test('create new ticket and update the priority', function () {
    MockClient::global([
        CreateTicketRequest::class => MockResponse::fixture('Tickets/CreateTicketRequest'),
        UpdateTicketRequest::class => MockResponse::fixture('Tickets/UpdateTicketRequest'),
    ]);

    $ticket = $this->desk->connector()->send(
        new CreateTicketRequest(
            new CreateTicketData(
                email: 'test@example.com',
                subject: 'Printer not working',
                description: '<div>Please fix it</div>',
                status: TicketStatus::Open,
                priority: TicketPriority::Low,
                type: TicketType::Question,
                customFields: new CustomFieldsData(
                    clientNumber: '12345',
                    shipmentKeyOls: 'OLS-001',
                ),
            )
        )
    );

    $ticketNumber = $ticket->json('ticket_number');

    $ticket = $this->desk->connector()->send(
        new UpdateTicketRequest(
            ticketNumber: $ticketNumber,
            data: new UpdateTicketData(
                priority: TicketPriority::Urgent,
            ),
        )
    );

    expect($ticket->json('ticket_number'))->toBe($ticketNumber)
        ->and($ticket->json('priority'))->toBe(TicketPriority::Urgent->value);
});

it('can add note', function () {
    MockClient::global([
        CreateTicketRequest::class => MockResponse::fixture('Tickets/Note/CreateTicketRequest'),
        AddNoteRequest::class => MockResponse::fixture('Tickets/Note/UpdateTicketRequest'),
        GetTicketDetailsRequest::class => MockResponse::fixture('Tickets/Note/GetTicketDetailsRequest'),
        GetTicketConversationsRequest::class => MockResponse::fixture('Tickets/Note/GetTicketConversationsRequest'),
    ]);

    $ticket = $this->desk->connector()->send(
        new CreateTicketRequest(
            new CreateTicketData(
                email: 'test@example.com',
                subject: 'Printer not working',
                description: '<div>Please fix it</div>',
                status: TicketStatus::Open,
                priority: TicketPriority::Low,
                type: TicketType::Question,
                customFields: new CustomFieldsData(
                    clientNumber: '12345',
                    shipmentKeyOls: 'OLS-001',
                ),
            )
        )
    );

    $ticketNumber = $ticket->json('ticket_number');
    expect($ticketNumber)
        ->not()->toBeNull()
        ->toBeNumeric();

    $note = $this->desk->connector()->send(
        new AddNoteRequest(
            $ticketNumber,
            '<div>This is a note added to the ticket.</div>'
        )
    );

    $ticket = $this->desk->connector()->send(
        new GetTicketDetailsRequest(
            ticketNumber: $ticketNumber
        )
    );

    expect($ticket->json('conversation_count'))->toBe(1);

    $conversationDetails = $this->desk->connector()->send(
        new GetTicketConversationsRequest(
            ticketNumber: $ticketNumber
        )
    );

    expect($conversationDetails->json('conversations.0.body'))
        ->toBe($note->json('body'));
});

it('can add reply', function () {
    MockClient::global([
        CreateTicketRequest::class => MockResponse::fixture('Tickets/Reply/CreateTicketRequest'),
        AddReplyRequest::class => MockResponse::fixture('Tickets/Reply/UpdateTicketRequest'),
        GetTicketDetailsRequest::class => MockResponse::fixture('Tickets/Reply/GetTicketDetailsRequest'),
        GetTicketConversationsRequest::class => MockResponse::fixture('Tickets/Reply/GetTicketConversationsRequest'),
    ]);

    $ticket = $this->desk->connector()->send(
        new CreateTicketRequest(
            new CreateTicketData(
                email: 'test@example.com',
                subject: 'Printer not working',
                description: '<div>Please fix it</div>',
                status: TicketStatus::Open,
                priority: TicketPriority::Low,
                type: TicketType::Question,
                customFields: new CustomFieldsData(
                    clientNumber: '12345',
                    shipmentKeyOls: 'OLS-001',
                ),
            )
        )
    );

    $ticketNumber = $ticket->json('ticket_number');
    expect($ticketNumber)
        ->not()->toBeNull()
        ->toBeNumeric();

    $reply = $this->desk->connector()->send(
        new AddReplyRequest(
            $ticketNumber,
            '<div>This is a reply added to the ticket.</div>'
        )
    );

    $conversationDetails = $this->desk->connector()->send(
        new GetTicketConversationsRequest(
            ticketNumber: $ticketNumber
        )
    );

    expect($conversationDetails->json('agent_reply_count'))->toBe(1)
        ->and($conversationDetails->json('conversations.0.body'))->toBe($reply->json('body'));
});
