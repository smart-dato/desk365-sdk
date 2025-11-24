<?php

namespace SmartDato\Desk365\Concerns;

trait ConvertsBoolToInt
{
    private function boolToInt(?bool $value): ?int
    {
        if ($value === null) {
            return null;
        }

        return $value ? 1 : 0;
    }
}
