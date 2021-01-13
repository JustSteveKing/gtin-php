<?php declare(strict_types=1);

namespace JustSteveKing\GtinPHP\Rules;

use Illuminate\Contracts\Validation\Rule;
use JustSteveKing\GtinPHP\Gtin as GtinValidator;

class Gtin implements Rule
{
    protected string $message;

    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // GTIN is between 8 and 14 characters long
        if (! GtinValidator::length($value)) {
            $this->message = 'The GTIN must be between 8 and 14 characters long';

            return false;
        }

        // GTIN is a number
        if (! GtinValidator::integer($value)) {
            $this->message = 'The GTIN must be an integer';

            return false;
        }

        if (! GtinValidator::inspect($value)) {
            $this->message = "The GTIN value {$value} does not pass algorithmic inspection.";

            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
