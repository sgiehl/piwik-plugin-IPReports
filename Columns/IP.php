<?php
/**
 * Matomo - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

namespace Piwik\Plugins\IPReports\Columns;

use Piwik\Plugin\Dimension\VisitDimension;

class IP extends VisitDimension
{
    protected $category = 'UserCountry_VisitLocation';
    protected $nameSingular = 'IPReports_IP';
    protected $namePlural = 'IPReports_IPs';
}