<?php
/**
 * This file is part of the EzPriceBundle package.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace EzSystems\EzPriceBundle\Tests\Core\Persistence\Legacy\Vat\Price\Gateway;

use eZ\Publish\Core\Persistence\Legacy\Tests\TestCase;
use EzSystems\EzPriceBundle\Core\Persistence\Legacy\Price\Vat\Gateway\DoctrineDatabase;

class DoctrineDatabaseTest extends TestCase
{
    /**
     * Sets up the test suite
     */
    public function setUp()
    {
        parent::setUp();

        $handler = $this->getDatabaseHandler();

        $schema = __DIR__ . "/../../../../../../_fixtures/schema/schema." . $this->db . ".sql";

        $queries = array_filter( preg_split( "(;\\s*$)m", file_get_contents( $schema ) ) );
        foreach ( $queries as $query )
        {
            $handler->exec( $query );
        }
    }

    /**
     * Returns gateway implementation for legacy storage
     *
     * @return \EzSystems\EzPriceBundle\Core\Persistence\Legacy\Price\Vat\Gateway\DoctrineDatabase
     */
    protected function getVatRateGateway()
    {
        $dbHandler = $this->getDatabaseHandler();
        return new DoctrineDatabase( $dbHandler );
    }

    /**
     * @return array
     */
    public static function getLoadVatRateValues()
    {
        return array(
            array( 'name', 'Second Vat Rate' ),
            array( 'percentage', 4.5 )
        );
    }

    /**
     * @dataProvider getLoadVatRateValues
     * @covers \EzSystems\EzPriceBundle\Core\Persistence\Legacy\Price\Vat\Gateway\DoctrineDatabase::getVatRateData
     *
     * @param string $field
     * @param mixed $value
     */
    public function testGetVatRateData( $field, $value )
    {
        $this->insertDatabaseFixture( __DIR__ . "/../../../../../../_fixtures/vatrate_list.php" );
        $handler = $this->getVatRateGateway();
        $data = $handler->getVatRateData( 2 );

        $this->assertEquals(
            $value,
            $data[$field],
            "Value in property $field not as expected."
        );
    }

    /**
     * @covers \EzSystems\EzPriceBundle\Core\Persistence\Legacy\Price\Vat\Gateway\DoctrineDatabase::getVatRateData
     * @expectedException \EzSystems\EzPriceBundle\Core\Persistence\Legacy\Price\Vat\Gateway\VatNotFoundException
     */
    public function testGetVatRateDataThrowsVatNotFoundException()
    {
        $this->insertDatabaseFixture( __DIR__ . "/../../../../../../_fixtures/vatrate_list.php" );
        $handler = $this->getVatRateGateway();
        $handler->getVatRateData( 456 );
    }
}
