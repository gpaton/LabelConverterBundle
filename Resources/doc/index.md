# LabelConverter Bundle

## Introduction

This Symfony Bundle provides tools to convert an integer to a label like roman numeral, capital or lowercase letter

Label types currently supported are :

- **Roman numeral** : I, II, III, ...
- **Capital letter** : A, B, C, ...
- **Lowercase letter** : a, b, c, ...
- **Arabic numeral** : 1, 2, 3, ... (if you want to keep integers)

Tools included are :

- **Form field type** : Choices list which allows you to choose among label types to convert to
- **Service** to convert in your controllers
- **Twig filter** to convert integers in your templates

## Installation

### Install GpatonLabelConverterBundle

Simply run assuming you have installed composer.phar or composer binary:

    $ php composer.phar require gpaton/labelconverter-bundle 1.0.*

### Enable the bundle

Finally, enable the bundle in the kernel:

    <?php
    // app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Gpaton\LabelConverterBundle\GpatonLabelConverterBundle(),

        );
    }


## Usage

3 tools are provided to make your life easier, but you may not need to use all of them.


### Form field type

This tool is useful when you want to let the user choose in a form among label conversion types to use.
Let's say for instance that you want the user to choose what type of label to use before answers in a quiz.

Add the form field in your Question form :

    <?php
    // Acme\DemoBundle\Form\QuestionType

    // ...

    class QuestionType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder->add(
                conversion',
                'gpaton_labelconverter',
                array(
                    'label' => 'What kind of label to you want to use ?',
                )
            );
        }
    }

You just have to get converter type choosen in your controller :


    <?php
    // Acme\DemoBundle\Controller\QuestionController

    namespace Acme\DemoBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Acme\DemoBundle\Form\QuestionType;

    class QuestionController extends Controller {

        public function indexAction(Request $request) {

            $form = $this->createForm(new QuestionType());
            $form->handleRequest($request);

            if ($form->isValid()) {

                $converterType = $form->get('conversion')->getData();

            }

            // ...
        }
    }

### Service

To use the converter in your controller, load the service `gpaton.labelconverter.factory`
then call the `getLabel` method like this :

    <?php
    // Acme\DemoBundle\Controller\QuestionController

    namespace Acme\DemoBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class QuestionController extends Controller {

        public function indexAction() {

            $labelConverterFactory = $this->get('gpaton.labelconverter.factory');

            $label = $labelConverterFactory->getLabel('RomanNumeral', 3);

            // ...
        }
    }

the `getlabel` method takes 2 arguments :

1. Converter type among the 4 currently supported :
    - `RomanNumeral` : I, II, III, ...
    - `CapitalLetter` : A, B, C, ...
    - `LowercaseLetter` : a, b, c, ...
    - `ArabicNumeral` : 1, 2, 3, ... (if you want to keep integers)

2. The integer to convert

### Twig filter

Use filter with converter type in argument :

    // Acme\DemoBundle\Resources\views\Demo\index.html.twig

    Question 1 : Do you lifke pancakes ?<br />
    {{ 1 | tolabel('CapitalLetter') }}/ Yes<br />
    {{ 2 | tolabel('CapitalLetter') }}/ No

This template will render :

    Question 1 : Do you like pancakes ?
    A/ Yes
    B/ No

Choose converter type among the 4 currently supported :

- `RomanNumeral` : I, II, III, ...
- `CapitalLetter` : A, B, C, ...
- `LowercaseLetter` : a, b, c, ...
- `ArabicNumeral` : 1, 2, 3, ... (if you want to keep integers)

## Additonnal notes

### Letter conversion after 26

When you try to convert an integer greater than 26 to a capital or lowercase letter, the bundle use the system used by
Excel with its columns names :

- 26 -> Z
- 27 -> AA
- 28 -> AB
- 29 -> AC
- ...

### Integers supported

Only integers strictly greater than 0 are supported. Other numbers will throw a `LabelConverterException` you may catch.

### Invalid converter type

If you try to convert an integer by using a non existent converter type, a `LabelConverterException` will be thrown.

## License

This bundle is under GPL v2 license. See the complete license in the bundle:

    Resources/meta/LICENSE