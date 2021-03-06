<?php
namespace KREDA\Sphere\Client\Component\Element\Repository\Navigation;

use KREDA\Sphere\Client\Component\IElementInterface;
use KREDA\Sphere\Client\Component\Parameter\Repository\Link\IconParameter;
use KREDA\Sphere\Client\Component\Parameter\Repository\Link\NameParameter;
use KREDA\Sphere\Client\Component\Parameter\Repository\Link\UrlParameter;
use KREDA\Sphere\Common\AbstractExtension;
use MOC\V\Component\Template\Component\IBridgeInterface;
use MOC\V\Component\Template\Exception\TemplateTypeException;

/**
 * Class AbstractLink
 *
 * @package KREDA\Sphere\Client\Component\Element\Repository\Navigation
 */
abstract class AbstractLink extends AbstractExtension implements IElementInterface
{

    /** @var string $TemplateDirectory */
    protected $TemplateDirectory = __DIR__;
    /** @var IBridgeInterface $Template */
    private $Template = null;

    /**
     * @param UrlParameter  $Route
     * @param NameParameter $Name
     * @param IconParameter $Icon
     * @param bool          $ToggleActive
     *
     * @throws TemplateTypeException
     */
    function __construct(
        UrlParameter $Route,
        NameParameter $Name,
        IconParameter $Icon = null,
        $ToggleActive = false
    ) {

        $this->Template = $this->extensionTemplate( $this->TemplateDirectory.'/Link.twig' );
        $this->Template->setVariable( 'UrlParameter', $Route->getValue() );
        $this->Template->setVariable( 'NameParameter', $Name->getValue() );
        if (null === $Icon) {
            $this->Template->setVariable( 'IconParameter', '' );
        } else {
            $this->Template->setVariable( 'IconParameter', $Icon->getValue() );
        }
        if (true === $ToggleActive) {
            $this->Template->setVariable( 'ToggleActiveClass', 'active' );
        } else {
            $this->Template->setVariable( 'ToggleActiveClass', '' );
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
