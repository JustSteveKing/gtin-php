<?php declare(strict_types=1);

namespace JustSteveKing\GtinPHP;

class Gtin
{
    /**
     * Check the length of a GTIN to make sure it is between 8 and 14 characters long
     * @param mixed $value
     * @return bool
     */
    public static function length($value): bool
    {
        $value = (string) $value;

        if (\strlen($value) <= 7 || \strlen($value) >= 15) {
            return false;
        }

        return true;
    }

    /**
     * Check that the GTIN is an integer - simply performs an is_int
     * @param mixed $value
     * @return bool
     */
    public static function integer($value): bool
    {
        return is_int($value);
    }

    /**
     * Inspects a GTIN to make sure the algorithm matches
     * @param mixed $value
     * @return bool
     */
    public static function inspect($value): bool
    {
        $gtinString = (string) $value;

        $checkDigitArray = [];
        $gtinMath = [3, 1, 3, 1, 3, 1, 3, 1, 3, 1, 3, 1, 3, 1, 3, 1, 3];
        $modifier = 17 - (\strlen($gtinString) - 1); // First Digit in array
        $checkDigit = \substr($gtinString, -1); // Get the check digit

        $barcodeArray = \str_split($gtinString); // split gtin into an array

        $tempCheckDigit = 0;
        $tempCheckSum = 0;

        // Run through and put digits into multiplication table
        for ($i = 0; $i < (\strlen($gtinString) - 1); $i++) {
            $checkDigitArray[$modifier + $i] = $barcodeArray[$i];
        }

        // Calculate the sum of barcode digits
        for ($i = $modifier; $i < 17; $i++) {
            $tempCheckSum += ((int) $checkDigitArray[$i] * $gtinMath[$i]);
        }

        // Difference from rounded up to nearest 10 to final check digit calculation
        $tempCheckDigit = (int)(\ceil($tempCheckSum / 10) * 10) - $tempCheckSum;

        if ((int) $checkDigit !== $tempCheckDigit) {
            return false;
        }

        return true;
    }

    /**
     * Validates an entire GTIN
     * @param mixed $value
     * @return bool
     */
    public static function validate($value): bool
    {
        if (! Gtin::length($value)) {
            return false;
        }

        if (! Gtin::integer($value)) {
            return false;
        }

        if (! Gtin::inspect($value)) {
            return false;
        }

        return true;
    }
}
