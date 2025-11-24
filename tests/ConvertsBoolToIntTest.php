<?php

use SmartDato\Desk365\Concerns\ConvertsBoolToInt;

it('converts true to 1', function () {
    $class = new class
    {
        use ConvertsBoolToInt;

        public function convert(?bool $value): ?int
        {
            return $this->boolToInt($value);
        }
    };

    expect($class->convert(true))->toBe(1);
});

it('converts false to 0', function () {
    $class = new class
    {
        use ConvertsBoolToInt;

        public function convert(?bool $value): ?int
        {
            return $this->boolToInt($value);
        }
    };

    expect($class->convert(false))->toBe(0);
});

it('converts null to null', function () {
    $class = new class
    {
        use ConvertsBoolToInt;

        public function convert(?bool $value): ?int
        {
            return $this->boolToInt($value);
        }
    };

    expect($class->convert(null))->toBeNull();
});
