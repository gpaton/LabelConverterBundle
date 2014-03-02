<?php
namespace Gpaton\LabelConverterBundle\LabelConverter;

use Gpaton\LabelConverterBundle\Model\LabelConverterInterface;

class RomanNumeral implements LabelConverterInterface
{
    /**
     * Convert number to roman numeral
     *
     * @param $integer
     *
     * @return string
     */
    public function getLabel($integer) {
        $label = '';

        // Create a lookup array that contains all of the Roman numerals.
        $lookup = array(
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1
        );

        foreach($lookup as $roman => $value){
            // Determine the number of matches
            $matches = intval($integer / $value);

            // Add the same number of characters to the string
            $label .= str_repeat($roman,$matches);

            // Set the integer to be the remainder of the integer and the value
            $integer = $integer % $value;
        }

        return $label;
    }
}