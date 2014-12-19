<?php
namespace KREDA\Sphere\Application\Management\PersonalData\Form;

use KREDA\Sphere\Application\Management\PersonalData\Common\Error;
use KREDA\Sphere\Client\Component\IElementInterface;
use MOC\V\Component\Template\Exception\TemplateTypeException;
use MOC\V\Component\Template\Template;

/**
 * Class City
 *
 * @package KREDA\Sphere\Application\Management\PersonalData\Form
 */
class City extends Error implements IElementInterface
{

    /**
     * @throws TemplateTypeException
     */
    function __construct()
    {

        $this->Template = Template::getTemplate( __DIR__.'/City.twig' );

        foreach ((array)$_REQUEST as $Key => $Value) {
            if (is_string( $Value )) {
                $this->Template->setVariable( $Key.'Value', $Value );
            }
        }
    }
}