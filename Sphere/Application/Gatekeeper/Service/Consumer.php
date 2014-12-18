<?php
namespace KREDA\Sphere\Application\Gatekeeper\Service;

use Doctrine\DBAL\Schema\Table;
use KREDA\Sphere\Application\Gatekeeper\Service\Consumer\Entity\TblConsumer;
use KREDA\Sphere\Application\Gatekeeper\Service\Consumer\Entity\TblConsumerTyp;
use KREDA\Sphere\Application\Gatekeeper\Service\Consumer\Entity\ViewConsumer;
use KREDA\Sphere\Application\Gatekeeper\Service\Consumer\EntityAction;

/**
 * Class Consumer
 *
 * @package KREDA\Sphere\Application\Gatekeeper\Service
 */
class Consumer extends EntityAction
{

    /**
     * @throws \Exception
     */
    public function __construct()
    {

        $this->setDatabaseHandler( 'Gatekeeper', 'Consumer' );
    }

    public function setupDatabaseContent()
    {

        $this->actionCreateConsumer( 'Root', '', null, '' );
    }

    /**
     * @return Table
     */
    public function schemaTableConsumer()
    {

        return $this->getTableConsumer();
    }

    /**
     * @param integer $Id
     *
     * @return bool|TblConsumer
     */
    public function entityConsumerById( $Id )
    {

        return parent::entityConsumerById( $Id );
    }

    /**
     * @param integer $Id
     *
     * @return bool|TblConsumerTyp
     */
    public function entityConsumerTypById( $Id )
    {

        return parent::entityConsumerTypById( $Id );
    }

    /**
     * @param string $Name
     *
     * @return bool|TblConsumer
     */
    public function entityConsumerByName( $Name )
    {

        return parent::entityConsumerByName( $Name );
    }

    /**
     * @param null|string $Session
     *
     * @return bool|TblConsumer
     */
    public function entityConsumerBySession( $Session = null )
    {

        return parent::entityConsumerBySession( $Session );
    }

    /**
     * @return bool|ViewConsumer[]
     */
    public function entityViewConsumer()
    {

        return parent::entityViewConsumer();
    }

    /**
     * @return bool|tblConsumer[]
     */
    public function entityConsumerAll()
    {

        return parent::entityConsumerAll();
    }
}
