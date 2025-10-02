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

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(UUIDv4::class)]
#[CoversClass(UUIDException::class)]
class UUIDv4Test extends TestCase
{
    public function test_can_be_generated(): void
    {
        $this->assertInstanceOf(UUIDv4::class, UUIDv4::generate());
    }

    public function test_can_be_created_from_string(): void
    {
        $uuid = UUIDv4::generate()->asString();

        $this->assertEquals($uuid, UUIDv4::from($uuid)->asString());
    }

    public function test_can_be_converted_to_string(): void
    {
        $this->assertIsString(UUIDv4::generate()->asString());
    }

    public function test_generated_UUIDs_differ(): void
    {
        $uuids = [];

        for ($i = 0; $i < 1000; $i++) {
            $uuids[] = UUIDv4::generate()->asString();
        }

        $this->assertEquals(count($uuids), count(array_unique($uuids)));
    }

    /**
     * @dataProvider provideInvalidUUIDs
     */
    public function test_exception_on_invalid_format(string $uuid): void
    {
        $this->expectException(UUIDException::class);

        UUIDv4::from($uuid);
    }

    public static function provideInvalidUUIDs(): array
    {
        return [
            'length not 36 characters' => ['not-36-characters-long'],
            'no first dash'            => ['2b481805af77e-437f-93a9-be159422da39'],
            'no second dash'           => ['2b481805-f77ea437f-93a9-be159422da39'],
            'no third dash'            => ['2b481805-f77e-437fa93a9-be159422da39'],
            'no fourth dash'           => ['2b481805-f77e-437f-93a9abe159422da39'],
            'not version 4'            => ['2b481805-f77e-337f-93a9-be159422da39'],
            'non-hex numbers'          => ['xb481805-f77e-437f-93a9-be159422da39'],
        ];
    }
}
