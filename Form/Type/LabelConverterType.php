<?php

namespace Gpaton\LabelConverterBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;

class LabelConverterType extends AbstractType
{

    private $translator;

    public function __construct(TranslatorInterface $translator) {
        $this->translator = $translator;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'choices' => array(
                'ArabicNumeral' => $this->translator->trans('choice_label', array(), 'ArabicNumeral'),
                'RomanNumeral' => $this->translator->trans('choice_label', array(), 'RomanNumeral'),
                'CapitalLetter' => $this->translator->trans('choice_label', array(), 'CapitalLetter'),
                'LowercaseLetter' => $this->translator->trans('choice_label', array(), 'LowercaseLetter'),
            )
        ));
    }

    public function getParent() {
        return 'choice';
    }

    public function getName() {
        return 'gpaton_labelconverter';
    }
} 