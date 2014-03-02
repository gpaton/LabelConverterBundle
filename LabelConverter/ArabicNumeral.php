<?php

namespace Gpaton\LabelConverterBundle\LabelConverter;

use Gpaton\LabelConverterBundle\Model\LabelConverterInterface;

class ArabicNumeral implements LabelConverterInterface
{
    public function getLabel($integer) {
        return (string)$integer;
    }
}