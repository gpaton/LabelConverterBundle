<?php

namespace Gpaton\LabelConverterBundle\Twig;

use Gpaton\LabelConverterBundle\Model\LabelConverterFactory;

class LabelConverterExtension extends \Twig_Extension
{
    public function getFilters() {
        return array(
            'tolabel' => new \Twig_Filter_Method($this, 'labelConverterFilter')
        );
    }

    /**
     * Convert integer to label based on method choosen
     *
     * @param $integer integer to convert to label
     * @param $method method among ArabicNumeral, CapitalLetter, LowercaseLetter and RomanNumeral
     *
     * @return string
     */
    public function labelConverterFilter($integer, $method) {
        $label = LabelConverterFactory::getLabel($method, $integer);

        return $label;
    }

    public function getName() {
        return 'labelconverter_extension';
    }
} 