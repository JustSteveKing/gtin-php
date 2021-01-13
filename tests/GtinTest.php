<?php declare(strict_types=1);

namespace JustSteveKing\GtinPHP\Tests;

use Illuminate\Support\Arr;
use JustSteveKing\GtinPHP\Gtin;
use PHPUnit\Framework\TestCase;

class GtinTest extends TestCase
{
    protected array $correctGtins = [
        614141999996,
        5060884830037,
        5012345678900,
        10614141999993,
    ];

    /**
     * @test
     */
    public function it_tests_that_the_gtin_is_the_correct_length()
    {
        $this->assertFalse(
            Gtin::length(1234567)
        );
        $this->assertTrue(
            Gtin::length(12345678)
        );
        $this->assertFalse(
            Gtin::length(123456789098765)
        );
    }

    /**
     * @test
     */
    public function it_tests_that_the_gtin_is_an_integer()
    {
        $this->assertFalse(
            Gtin::integer('qwerty')
        );

        $this->assertTrue(
            Gtin::integer(1234)
        );
    }

    /**
     * @test
     */
    public function it_inspects_the_gtin_to_ensure_it_is_valid()
    {
        $this->assertFalse(
            Gtin::inspect(123456789)
        );

        $this->assertTrue(
            Gtin::inspect(
                Arr::random($this->correctGtins)
            )
        );

        $fails = Arr::random($this->correctGtins) - 1;
        $this->assertFalse(
            Gtin::inspect($fails)
        );
    }

    /**
     * @test
     */
    public function it_tests_that_the_gtin_is_valid()
    {
        foreach ($this->correctGtins as $gtin) {
            $this->assertTrue(
                Gtin::validate($gtin)
            );
        }
    }
}
