<?php
namespace KREDA\Sphere\Application\Gatekeeper\Frontend\MyAccount\Consumer;

use KREDA\Sphere\Application\Gatekeeper\Frontend\AbstractError;
use KREDA\Sphere\Client\Component\IElementInterface;
use MOC\V\Component\Template\Exception\TemplateTypeException;
use MOC\V\Component\Template\Template;
use MOC\V\Core\HttpKernel\HttpKernel;

/**
 * Class ChangeConsumer
 *
 * @package KREDA\Sphere\Application\Gatekeeper\Frontend\MyAccount
 */
class ChangeConsumer extends AbstractError implements IElementInterface
{

    /**
     * @throws TemplateTypeException
     */
    function __construct()
    {

        $this->Template = Template::getTemplate( __DIR__.'/ChangeConsumer.twig' );
        $this->Template->setVariable( 'UrlBase', HttpKernel::getRequest()->getUrlBase() );

    }

}
