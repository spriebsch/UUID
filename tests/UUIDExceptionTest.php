<?php declare(strict_types=1);

/*
 * This file is part of UUID.
 *
 * (c) Stefan Priebsch <stefan@priebsch.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spriebsch\uuid;

use PHPUnit\Framework\TestCase;

/**
 * @covers \spriebsch\uuid\UUIDException
 *
 * @group  spriebsch
 * @group  uuid
 */
class UUIDExceptionTest extends TestCase
{
    public function test_malformed_uuid(): void
    {
        $exception = UUIDException::malformedUUID('the-id');

        $this->assertStringContainsString('Malformed UUID', $exception->getMessage());
    }

    public function test_malformed_uuid_contains_id(): void
    {
        $exception = UUIDException::malformedUUID('the-id');

        $this->assertStringContainsString('the-id', $exception->getMessage());
    }
}
