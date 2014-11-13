<?php
namespace KREDA\Sphere\Application\Gatekeeper\Client\SignIn;

use KREDA\Sphere\Application\Gatekeeper\Client\SignInError;
use KREDA\Sphere\Client\Component\Element\Repository\Shell;
use KREDA\Sphere\Client\Component\IElementInterface;
use MOC\V\Component\Template\Exception\TemplateTypeException;
use MOC\V\Component\Template\Template;

/**
 * Class SignInStudent
 *
 * @package KREDA\Sphere\Application\Gatekeeper\Client\SignIn
 */
class SignInStudent extends SignInError implements IElementInterface
{

    /**
     * @throws TemplateTypeException
     */
    function __construct()
    {

        $this->Template = Template::getTemplate( __DIR__.'/SignInStudent.twig' );
        if (isset( $_REQUEST['CredentialName'] )) {
            $this->Template->setVariable( 'CredentialNameValue', $_REQUEST['CredentialName'] );
        }
        if (isset( $_REQUEST['CredentialLock'] )) {
            $this->Template->setVariable( 'CredentialLockValue', $_REQUEST['CredentialLock'] );
        }
    }

}
