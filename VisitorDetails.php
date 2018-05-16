<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link    http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\IPReports;

use Piwik\Plugins\Live\VisitorDetailsAbstract;
use Piwik\Version;

class VisitorDetails extends VisitorDetailsAbstract
{
    public function renderIcons($visitorDetails)
    {
        if (version_compare(Version::VERSION, '3.5.0', '>=')) {
            return ''; // skip for older Matomo versions, as IP was included in real time widget
        }
        return '<span class="location-ip">IP: ' . $visitorDetails['visitIp'] . '</span>';
    }
}