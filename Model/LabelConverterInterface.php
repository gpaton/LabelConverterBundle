<?php

namespace Gpaton\LabelConverterBundle\Model;

interface LabelConverterInterface
{
    /**
     * Return integer converted to label
     *
     * @param $integer
     * @return string
     */
    public function getLabel($integer);
} 