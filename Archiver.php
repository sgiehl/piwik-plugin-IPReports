<?php

/**
 * Matomo - free/libre analytics platform
 *
 * @link    https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

namespace Piwik\Plugins\IPReports;

use Matomo\Network\IP;
use Piwik\Metrics;

class Archiver extends \Piwik\Plugin\Archiver
{
    const IPREPORTS_RECORD_NAME = 'IPReports_ips';
    const IPTYPES_RECORD_NAME = 'IPReports_types';
    const IPREPORTS_FIELD = 'location_ip';

    public function aggregateDayReport()
    {
        $metrics     = $this->getLogAggregator()->getMetricsFromVisitByDimension(self::IPREPORTS_FIELD)->asDataTable();
        $metricsCopy = clone $metrics;
        $report      = $metrics->getSerialized($this->maximumRows, null, Metrics::INDEX_NB_VISITS);
        $this->getProcessor()->insertBlobRecord(self::IPREPORTS_RECORD_NAME, $report);

        $metricsCopy->filter('GroupBy', [
            'label',
            function ($ip) {
                $ip = IP::fromBinaryIP($ip);
                return $ip->toIPv4String() ? 'IPv4' : 'IPv6';
            },
        ]);
        $report = $metricsCopy->getSerialized($this->maximumRows, null, Metrics::INDEX_NB_VISITS);
        $this->getProcessor()->insertBlobRecord(self::IPTYPES_RECORD_NAME, $report);
    }

    public function aggregateMultipleReports()
    {
        $columnsAggregationOperation = null;

        $this->getProcessor()->aggregateDataTableRecords(
            [self::IPREPORTS_RECORD_NAME, self::IPTYPES_RECORD_NAME],
            $this->maximumRows,
            $maximumRowsInSubDataTable = null,
            $columnToSortByBeforeTruncation = null,
            $columnsAggregationOperation,
            $columnsToRenameAfterAggregation = null,
            $countRowsRecursive = []
        );
    }
}
