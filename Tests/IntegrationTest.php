<?php

namespace Gpaton\LabelConverterBundle\Tests;

use Gpaton\LabelConverterBundle\Twig\LabelConverterExtension;

class IntegrationTest extends \Twig_Test_IntegrationTestCase
{
    public function getExtensions() {
        return array(
            new LabelConverterExtension(),
        );
    }

    public function getFixturesDir() {
        return dirname(__FILE__).'/Fixtures/';
    }
} 