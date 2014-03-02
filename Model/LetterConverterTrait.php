<?php

namespace Gpaton\LabelConverterBundle\Model;

trait LetterConverterTrait
{
    /**
     * Convert number to letter, capital or lowercase depending on $capital parameter
     * We use the same format as Excel uses for its columns. ie :
     * 26 => z, 27 => aa, 28 => ab, ...
     *
     * @param $integer
     * @param bool $capital if True, number is converted to capital letters, else convert to lowercase letters
     *
     * @return string
     */
    private function getCaseSensitiveLabel($integer, $capital = TRUE) {
        $label = '';
        $baseChr = 65;
        if (!$capital) {
            $baseChr = 97;
        }

        while ($integer > 0) {
            $modulo = ($integer - 1) % 26;
            $label = chr($baseChr + $modulo) . $label;
            $integer = round(($integer - $modulo) / 26, 0);
        }

        return $label;
    }
}