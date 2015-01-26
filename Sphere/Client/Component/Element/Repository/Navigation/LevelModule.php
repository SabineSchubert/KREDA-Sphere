<?php
namespace KREDA\Sphere\Client\Component\Element\Repository\Navigation;

use KREDA\Sphere\Client\Component\Element\Repository\AbstractNavigation;
use KREDA\Sphere\Client\Component\IElementInterface;
use MOC\V\Component\Template\Component\IBridgeInterface;
use MOC\V\Component\Template\Exception\TemplateTypeException;

/**
 * Class LevelModule
 *
 * @package KREDA\Sphere\Client\Component\Element\Repository\Navigation
 */
class LevelModule extends AbstractNavigation implements IElementInterface
{

    /** @var IBridgeInterface $Template */
    private $Template = null;
    /** @var LevelModule\Link[] $MainLinkList */
    private $MainLinkList = array();
    /** @var array $BreadcrumbList */
    private $BreadcrumbList = array();

    /**
     * @throws TemplateTypeException
     */
    function __construct()
    {

        $this->Template = $this->extensionTemplate( __DIR__.'/LevelModule/Main.twig' );
    }

    /**
     * @param string $Title
     *
     * @return LevelClient
     */
    public function addBreadcrumb( $Title )
    {

        if (!in_array( $Title, $this->BreadcrumbList )) {
            array_push( $this->BreadcrumbList, $Title );
        }
        return $this;
    }

    /**
     * @param LevelModule\Link $Link
     *
     * @return LevelModule
     */
    public function addLinkToMain( LevelModule\Link $Link )
    {

        if (!in_array( $Link->getContent(), $this->MainLinkList )) {
            array_push( $this->MainLinkList, $Link->getContent() );
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {

        $this->Template->setVariable( 'PositionMain', implode( '', $this->MainLinkList ) );
        $this->Template->setVariable( 'PositionBreadcrumb',
            ( empty( $this->BreadcrumbList ) ? '' : implode( '', $this->BreadcrumbList ).'&nbsp;&nbsp;' ) );
        return $this->Template->getContent();
    }

}
