<?php

/**
 * Matomo - free/libre analytics platform
 *
 * @link    https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

namespace Piwik\Plugins\IPReports\tests\Fixtures;

use Piwik\Tests\Framework\Fixture;
use Piwik\Date;

class IPFixture extends Fixture
{
    public $dateTime = '2014-09-04 00:00:00';
    public $idSite = 1;

    public function setUp(): void
    {
        $this->setUpWebsite();
        $this->trackVisits();
    }

    private function setUpWebsite()
    {
        if (!self::siteCreated($this->idSite)) {
            $idSite = self::createWebsite($this->dateTime);
            $this->assertSame($this->idSite, $idSite);
        }
    }

    private function getIPAddresses()
    {
        return [
            '192.23.33.55', '234.6.45.44', '9.9.9.9', '4.33.44.154',
            '2003:f6:93bf:907:9ec7:a6ff:fe29:27de', '234.6.45.44', 'fe80::74e6:b5f3:fe92:830e',
            '92.34.0.87', '5.88.3.45', 'fe80:0000:0000:0000:0202:b3ff:fe1e:8329'
        ];
    }

    private function trackVisits()
    {
        $tracker = self::getTracker(
            $this->idSite,
            $this->dateTime,
            $defaultInit = false
        );
        $tracker->setTokenAuth(self::getTokenAuth());

        $hour = 1;
        foreach ($this->getIPAddresses() as $ip) {
            $tracker->setForceVisitDateTime(
                Date::factory($this->dateTime)->addHour($hour++)->getDatetime()
            );
            $tracker->setForceNewVisit();

            $tracker->setIp($ip);

            self::checkResponse($tracker->doTrackPageView("Viewing homepage"));
        }
    }

    public function provideContainerConfig()
    {
        return [
            'Piwik\Config' => \Piwik\DI::decorate(function ($previous) {
                $general = $previous->General;
                $general['datatable_archiving_maximum_rows_standard'] = 7;
                $previous->General = $general;
                return $previous;
            }),
        ];
    }
}