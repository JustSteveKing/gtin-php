<?php declare(strict_types=1);

namespace JustSteveKing\GtinPHP\Tests\Rules;

use JustSteveKing\GtinPHP\Rules\Gtin;
use JustSteveKing\GtinPHP\Tests\TestCase;

class GtinTest extends TestCase
{
    protected Gtin $rule;

    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new Gtin;
    }

    /**
     * @test
     */
    public function it_tests_that_the_validation_macro_works()
    {
        $this->assertInstanceOf(
            Gtin::class,
            \Illuminate\Validation\Rule::gtin()
        );
    }

    /**
     * @test
     */
    public function it_tests_that_only_a_valid_gtin_will_pass_inspection()
    {
        $shortGtins = [
            1,12,123,1234,12345,123456,1234567,
        ];

        $correctGtins = [
            614141999996,5012345678900,10614141999993,5060884830037,
        ];

        $longGtins = [
            123456789098765,1234567890987654,12345678909876543,
        ];

        foreach ($shortGtins as $gtin) {
            $this->assertFalse(
                $this->rule->passes('gtin', $gtin)
            );

            $this->assertEquals(
                $this->rule->message(),
                'The GTIN must be between 8 and 14 characters long'
            );
        }

        foreach ($correctGtins as $gtin) {
            $this->assertTrue(
                $this->rule->passes('gtin', $gtin)
            );
        }

        foreach ($longGtins as $gtin) {
            $this->assertFalse(
                $this->rule->passes('gtin', $gtin)
            );
            $this->assertEquals(
                $this->rule->message(),
                'The GTIN must be between 8 and 14 characters long'
            );
        }

        $this->assertFalse(
            $this->rule->passes('gtin', 'qwertyuiop')
        );

        $this->assertEquals(
            $this->rule->message(),
            'The GTIN must be an integer'
        );

        $fakeGtin = 123456789;

        $this->assertFalse(
            $this->rule->passes('gtin', $fakeGtin)
        );

        $this->assertEquals(
            $this->rule->message(),
            "The GTIN value {$fakeGtin} does not pass algorithmic inspection."
        );
    }
}
