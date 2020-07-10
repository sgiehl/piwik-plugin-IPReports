<?php
/**
 * Matomo - free/libre analytics platform
 *
 * @link    https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\IPReports\tests\System;


use Piwik\Plugins\IPReports\tests\Fixtures\IPFixture;
use Piwik\Tests\Framework\TestCase\SystemTestCase;

/**
 * @package Piwik\Plugins\IPReports\tests
 * @group Plugins
 * @group IPReports
 */
class ApiTest extends SystemTestCase {

    public static $fixture = null;

    public static function getOutputPrefix()
    {
        return '';
    }

    /**
     * @param $api
     * @param $params
     * @dataProvider    getApiForTesting
     */
    public function testApi($api, $params)
    {
        $this->runApiTests($api, $params);
    }

    /**
     * @return array
     */
    public function getApiForTesting()
    {
        $apiToCall = array(
            "IPReports.getIPs",
        );

        $apiToTest = array();

        $apiToTest[] = array(
                            $apiToCall,
                            array(
                                'idSite'  => self::$fixture->idSite,
                                'date'    => self::$fixture->dateTime,
                                'periods' => array('day')
                            )
                       );

        return $apiToTest;
    }


    public static function getPathToTestDirectory()
    {
        return dirname(__FILE__);
    }

}

ApiTest::$fixture = new IPFixture();