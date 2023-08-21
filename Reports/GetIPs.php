<?php

/**
 * Matomo - free/libre analytics platform
 *
 * @link    https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

namespace Piwik\Plugins\IPReports\Reports;

use Piwik\Piwik;
use Piwik\Plugin\Report;
use Piwik\Plugin\ViewDataTable;
use Piwik\Plugins\IPReports\Columns\IP;

class GetIPs extends Report
{
    protected function init()
    {
        $this->categoryId = 'General_Visitors';
        $this->dimension  = new IP();
        $this->name       = Piwik::translate('IPReports_WidgetIPs');
        $this->order      = 50;

        $this->subcategoryId = 'UserCountry_SubmenuLocations';
    }

    public function configureView(ViewDataTable $view)
    {
        $view->requestConfig->filter_limit = 5;
        $view->config->addTranslation('label', $this->dimension->getName());
    }
}
