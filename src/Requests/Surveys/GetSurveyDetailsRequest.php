<?php

namespace SmartDato\Desk365\Requests\Surveys;

use Saloon\Enums\Method;
use SmartDato\Desk365\Requests\Desk365Request;

class GetSurveyDetailsRequest extends Desk365Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $surveyId,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/surveys/details';
    }

    protected function defaultQuery(): array
    {
        return [
            'survey_id' => $this->surveyId,
        ];
    }
}
