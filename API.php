<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\IPReports;

use Piwik\Archive;
use Piwik\Network\IP;
use Piwik\Piwik;

/**
 * The IP Reports API lets you access reports for your visitors IP-Addresses.
 *
 * @method static \Piwik\Plugins\IPReports\API getInstance()
 */
class API extends \Piwik\Plugin\API
{
    public function getIPs($idSite, $period, $date, $segment = false)
    {
        Piwik::checkUserHasViewAccess($idSite);
        $archive = Archive::build($idSite, $period, $date, $segment);
        $dataTable = $archive->getDataTable(Archiver::IPREPORTS_RECORD_NAME);
        $dataTable->filter('GroupBy', array('label', function($value) {
            return IP::fromBinaryIP($value)->toString();
        }));
        $dataTable->queueFilter('ReplaceColumnNames');
        $dataTable->queueFilter('ReplaceSummaryRowLabel');
        return $dataTable;
    }
}
