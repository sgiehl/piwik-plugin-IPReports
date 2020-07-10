/*!
 * Matomo - free/libre analytics platform
 *
 * Screenshot tests for IPReports plugin
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

describe("IPReports", function () {
    this.timeout(0);

    this.fixture = "Piwik\\Plugins\\IPReports\\tests\\Fixtures\\IPFixture";

    before(function () {
        testEnvironment.pluginsToLoad = ['IPReports'];
        testEnvironment.save();
    });

    it('show report', async function () {
        await page.goto('?module=CoreHome&action=index&idSite=1&period=day&date=2014-09-04#?idSite=1&period=month&date=2014-09-04&category=General_Visitors&subcategory=UserCountry_SubmenuLocations');
        await page.waitForNetworkIdle();
        expect(await page.screenshotSelector('#widgetIPReportsgetIPs')).to.matchImage('report');
    });
});
