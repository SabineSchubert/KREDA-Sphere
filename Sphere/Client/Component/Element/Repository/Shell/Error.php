<?php
namespace KREDA\Sphere\Client\Component\Element\Repository\Shell;

use KREDA\Sphere\Client\Component\Element\Repository\AbstractShell;
use KREDA\Sphere\Client\Component\IElementInterface;
use MOC\V\Component\Template\Component\IBridgeInterface;

/**
 * Class Error
 *
 * @package KREDA\Sphere\Client\Component\Element\Repository\Shell
 */
class Error extends AbstractShell implements IElementInterface
{

    /** @var IBridgeInterface $Template */
    private $Template = null;

    /**
     * @param integer|string $Code
     * @param null           $Message
     *
     * @throws \MOC\V\Component\Template\Exception\TemplateTypeException
     */
    function __construct( $Code, $Message = null )
    {

        $this->Template = $this->extensionTemplate( __DIR__.'/Error.twig' );
        $this->Template->setVariable( 'ErrorCode', $Code );
        if (null === $Message) {
            switch ($Code) {
                case 404:
                    $this->Template->setVariable( 'ErrorMessage',
                        'Die angeforderte Ressource konnte nicht gefunden werden' );
                    break;
                default:
                    $this->Template->setVariable( 'ErrorMessage', '' );

            }
        } else {
            $this->Template->setVariable( 'ErrorMessage', $Message );

            $this->Template->setVariable( 'ErrorMenu', array(
                $this->extensionRequest()->getUrlBase()
                .'/'.trim( '/Sphere/Assistance/Support/Ticket'
                    .'?TicketSubject='.urlencode( $Code )
                    .'&TicketMessage='.urlencode( $Message ),
                    '/' ) => 'Fehlerbericht senden'
            ) );

        }
    }

    /**
     * @return string
     */
    public function getContent()
    {

        return $this->Template->getContent();
    }

}
