<?php declare(strict_types=1);

namespace spriebsch\uuid;

interface UUID
{
    public static function generate(): UUID;

    public static function from(string $uuid): UUID;

    public function asString(): string;
}
