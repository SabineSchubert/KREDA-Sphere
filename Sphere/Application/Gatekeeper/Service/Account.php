<?php
namespace KREDA\Sphere\Application\Gatekeeper\Service;

use Doctrine\DBAL\Schema\Table;
use KREDA\Sphere\Application\Gatekeeper\Service\Account\Schema;

/**
 * Class Account
 *
 * @package KREDA\Sphere\Application\Gatekeeper\Service
 */
class Account extends Schema
{

    const API_SIGN_IN_ERROR_CREDENTIAL = 21;
    const API_SIGN_IN_ERROR_TOKEN = 22;
    const API_SIGN_IN_ERROR = 23;
    const API_SIGN_IN_SUCCESS = 11;
    private static $ValidSessionCache = false;

    /**
     * @throws \Exception
     */
    public function __construct()
    {

        $this->getDebugger()->addConstructorCall( __METHOD__ );

        $this->connectDatabase( 'Gatekeeper-Account' );
    }

    public function setupSystem()
    {

        $this->getDebugger()->addMethodCall( __METHOD__ );

        $this->actionCreateAccount( 'Root', 'OvdZ2üA!Lz{AFÖFp' );
    }

    /**
     * @param string $Username
     * @param string $Password
     * @param bool   $TokenString
     *
     * @return int
     */
    public function apiSignIn( $Username, $Password, $TokenString = false )
    {

        $this->getDebugger()->addMethodCall( __METHOD__ );

        /**
         * Credentials
         */
        if (false === ( $Account = $this->objectAccountByCredential( $Username, $Password ) )) {
            /**
             * Invalid
             */
            return self::API_SIGN_IN_ERROR_CREDENTIAL;
        } else {
            /**
             * Typ
             */
            if (false === $TokenString) {
                /**
                 * Valid
                 */
                session_regenerate_id();
                $this->actionCreateSession( session_id(), $Account->getId() );
                return self::API_SIGN_IN_SUCCESS;
            } else {
                /**
                 * Token
                 */
                try {
                    if (Token::getApi()->apiValidateToken( $TokenString )) {
                        /**
                         * Certification
                         */
                        if (false === ( $Token = Token::getApi()->entityTokenById( $Account->getTblToken() ) )) {
                            /**
                             * Invalid
                             */
                            return self::API_SIGN_IN_ERROR_TOKEN;
                        } else {
                            if ($Token->getIdentifier() == substr( $TokenString, 0, 12 )) {
                                /**
                                 * Valid
                                 */
                                session_regenerate_id();
                                $this->actionCreateSession( session_id(), $Account->getId() );
                                return self::API_SIGN_IN_SUCCESS;
                            } else {
                                /**
                                 * Invalid
                                 */
                                return self::API_SIGN_IN_ERROR_TOKEN;
                            }
                        }
                    } else {
                        /**
                         * Invalid
                         */
                        return self::API_SIGN_IN_ERROR_TOKEN;
                    }
                } catch( \Exception $E ) {
                    /**
                     * Invalid
                     */
                    return self::API_SIGN_IN_ERROR_TOKEN;
                }
            }
        }
    }

    /**
     *
     */
    public function apiSignOut()
    {

        $this->getDebugger()->addMethodCall( __METHOD__ );

        $this->actionDestroySession();
        session_regenerate_id();
    }

    /**
     * @return bool
     */
    public function apiIsValidSession()
    {

        $this->getDebugger()->addMethodCall( __METHOD__ );

        if (self::$ValidSessionCache) {
            return true;
        }

        if (false === ( $Account = $this->objectAccountBySession() )) {
            self::$ValidSessionCache = false;
        } else {
            self::$ValidSessionCache = true;
        }
        return self::$ValidSessionCache;
    }

    /**
     * @return Table
     */
    public function schemaTableAccount()
    {

        $this->getDebugger()->addMethodCall( __METHOD__ );

        return $this->getTableAccount();
    }

    /**
     * @param integer $Id
     *
     * @return bool|Schema\TblAccount
     */
    public function entityAccountById( $Id )
    {

        $this->getDebugger()->addMethodCall( __METHOD__ );

        return $this->objectAccountById( $Id );
    }

    /**
     * @param string $Name
     *
     * @return bool|Schema\TblAccount
     */
    public function entityAccountByUsername( $Name )
    {

        $this->getDebugger()->addMethodCall( __METHOD__ );

        return $this->objectAccountByUsername( $Name );
    }
}