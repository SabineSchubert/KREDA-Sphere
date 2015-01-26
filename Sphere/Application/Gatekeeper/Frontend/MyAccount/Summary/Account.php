<?php
namespace KREDA\Sphere\Application\Gatekeeper\Frontend\MyAccount\Summary;

use KREDA\Sphere\Application\Gatekeeper\Service\Account\Entity\TblAccount;
use KREDA\Sphere\Client\Component\IElementInterface;
use KREDA\Sphere\Common\AbstractFrontend;
use MOC\V\Component\Template\Exception\TemplateTypeException;

/**
 * Class Account
 *
 * @package KREDA\Sphere\Application\Gatekeeper\Frontend\MyAccount
 */
class Account extends AbstractFrontend implements IElementInterface
{

    /**
     * @param TblAccount $tblAccount
     *
     * @throws TemplateTypeException
     */
    function __construct( $tblAccount )
    {

        $this->Template = $this->extensionTemplate( __DIR__.'/Account.twig' );
        $this->Template->setVariable( 'tblAccount', $tblAccount );
    }

}
