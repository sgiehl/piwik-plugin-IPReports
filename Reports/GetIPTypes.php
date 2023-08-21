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
use Piwik\Plugins\CoreVisualizations\Visualizations\JqplotGraph\Pie;
use Piwik\Plugins\IPReports\Columns\IP;

class GetIPTypes extends Report
{
    protected function init()
    {
        $this->categoryId    = 'General_Visitors';
        $this->dimension     = new IP();
        $this->name          = Piwik::translate('IPReports_WidgetIPTypes');
        $this->order         = 55;
        $this->subcategoryId = 'UserCountry_SubmenuLocations';

        $this->alwaysUseDefaultViewDataTable();
    }

    public function configureView(ViewDataTable $view)
    {
        $view->config->addTranslation('label', $this->dimension->getName());
    }

    public function alwaysUseDefaultViewDataTable()
    {
        return true;
    }

    public function getDefaultTypeViewDataTable()
    {
        return Pie::ID;
    }
}
