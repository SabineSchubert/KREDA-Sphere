<?php
namespace KREDA\Sphere\Client\Component\Exception;

use KREDA\Sphere\Client\Exception\ClientException;

class ComponentException extends ClientException
{

    /**
     * @param string $Message
     * @param int    $Code
     * @param null   $Previous
     */
    public function __construct( $Message = "", $Code = 0, $Previous = null )
    {

        parent::__construct( $Message, $Code, $Previous );
    }
}
