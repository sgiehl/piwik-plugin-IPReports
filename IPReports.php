<?php

/**
 * Matomo - Open source web analytics
 *
 * @link    https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\IPReports;

use Piwik\Plugin;

/**
 *
 */
class IPReports extends Plugin
{
    /**
     * @see \Piwik\Plugin::registerEvents
     */
    public function registerEvents()
    {
        return [
            'AssetManager.getStylesheetFiles' => 'getStylesheetFiles',
        ];
    }

    /**
     * Adds required CSS files
     *
     * @param $stylesheets
     */
    public function getStylesheetFiles(&$stylesheets)
    {
        $stylesheets[] = "plugins/IPReports/stylesheets/ipreports.less";
    }
}
