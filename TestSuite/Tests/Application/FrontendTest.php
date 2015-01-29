<?php
namespace KREDA\TestSuite\Tests\Application;

use KREDA\Sphere\Common\AbstractFrontend;

/**
 * Class FrontendTest
 *
 * @package KREDA\TestSuite\Tests\Application
 */
class FrontendTest extends \PHPUnit_Framework_TestCase
{

    public function testAbstractFrontend()
    {

        /** @var \KREDA\Sphere\Common\AbstractFrontend $MockFrontend */
        $MockFrontend = $this->getMockForAbstractClass( 'KREDA\Sphere\Common\AbstractFrontend' );
        $this->assertInstanceOf( 'KREDA\Sphere\Common\AbstractExtension', $MockFrontend );
    }

    public function testFrontendCodeStyle()
    {

        /**
         * Assistance
         */
        $Namespace = 'KREDA\Sphere\Application\Assistance\Frontend';
        $this->checkFrontendMethodName( $Namespace.'\Account' );
        $this->checkFrontendMethodName( $Namespace.'\Application' );
        $this->checkFrontendMethodName( $Namespace.'\Support' );
        /**
         * Gatekeeper
         */
        $Namespace = 'KREDA\Sphere\Application\Gatekeeper\Frontend';
        $this->checkFrontendMethodName( $Namespace.'\Authentication\Authentication' );
        $this->checkFrontendMethodName( $Namespace.'\Authentication\SignIn' );
        $this->checkFrontendMethodName( $Namespace.'\Authentication\SignOut' );
        $this->checkFrontendMethodName( $Namespace.'\MyAccount\MyAccount' );
        /**
         * Billing
         */
        $Namespace = 'KREDA\Sphere\Application\Billing\Frontend';
        $this->checkFrontendMethodName( $Namespace.'\Summary\Summary' );
        /**
         * System
         */
        $Namespace = 'KREDA\Sphere\Application\System\Frontend';
        $this->checkFrontendMethodName( $Namespace.'\Authorization\Authorization' );

    }

    /**
     * @param string $Frontend
     */
    private function checkFrontendMethodName( $Frontend )
    {

        $Name = 'getContent|__toString';
        $Prefix = 'stage|extension';
        $this->checkMethodName( $Frontend, '!^(('.$Name.')|('.$Prefix.')[a-zA-Z]+)$!',
            \ReflectionMethod::IS_PUBLIC );
    }

    /**
     * @param string $Class
     * @param string $Pattern
     * @param int    $Realm
     */
    private function checkMethodName( $Class, $Pattern, $Realm = \ReflectionMethod::IS_PUBLIC )
    {

        $Class = new \ReflectionClass( $Class );
        $MethodList = $Class->getMethods( $Realm );
        /** @var \ReflectionMethod $Method */
        foreach ($MethodList as $Method) {
            $this->assertEquals( 1, preg_match( $Pattern, $Method->getShortName(), $Result ),
                $Class->getName().'::'.$Method->getShortName()."\n".' -> '.$Pattern );

            if (!$Class->isAbstract()) {
                /** @var AbstractFrontend $Object */
                $Object = $Class->newInstance();

                if (in_array( 'stage', $Result )) {
                    if (count( $ParameterList = $Method->getParameters() ) == 0) {
                        $this->assertInstanceOf( '\KREDA\Sphere\Client\Component\Element\Repository\Content\Stage',
                            $Object->{$Method->getShortName()}()
                        );
                    } else {
                        array_walk( $ParameterList, function ( &$V ) {

                            $V = null;
                        } );
                        $this->assertInstanceOf( '\KREDA\Sphere\Client\Component\Element\Repository\Content\Stage',
                            call_user_func_array( array( $Object, $Method->getShortName() ), $ParameterList )
                        );
                    }
                }
            }
        }
    }
}
