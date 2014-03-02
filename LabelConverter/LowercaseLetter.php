<?php

namespace Gpaton\LabelConverterBundle\LabelConverter;

use Gpaton\LabelConverterBundle\Model\LabelConverterInterface;
use Gpaton\LabelConverterBundle\Model\LetterConverterTrait;

class LowercaseLetter implements LabelConverterInterface
{
    use LetterConverterTrait;

    /**
     * Convert number to capital letter
     * We use the same format as Excel uses for its columns. ie :
     * 26 => Z, 27 => AA, 28 => AB, ...
     *
     * @param $integer
     *
     * @return string
     */
    public function getLabel($integer) {
        return $this->getCaseSensitiveLabel($integer, FALSE);
    }
}