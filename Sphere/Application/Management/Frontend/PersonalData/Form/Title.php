<?php
namespace KREDA\Sphere\Application\Management\Frontend\PersonalData\Form;

use KREDA\Sphere\Application\Management\Frontend\PersonalData\Common\Error;
use KREDA\Sphere\Client\Component\IElementInterface;
use MOC\V\Component\Template\Exception\TemplateTypeException;
use MOC\V\Component\Template\Template;

/**
 * Class Title
 *
 * @package KREDA\Sphere\Application\Management\PersonalData\Form
 */
class Title extends Error implements IElementInterface
{

    /**
     * @throws TemplateTypeException
     */
    function __construct()
    {

        $this->Template = Template::getTemplate( __DIR__.'/Title.twig' );

        foreach ((array)$_REQUEST as $Key => $Value) {
            if (is_string( $Value )) {
                $this->Template->setVariable( $Key.'Value', $Value );
            }
        }
    }
}
