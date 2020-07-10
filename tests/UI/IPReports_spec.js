/*!
 * Matomo - free/libre analytics platform
 *
 * Screenshot tests for ReferrersManager plugin
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

describe("IPReports", function () {
    this.timeout(0);

    it('show report', function (done) {
        expect.screenshot('report').to.be.captureSelector('#widgetIPReportsgetIPs', function (page) {
            page.load('?module=CoreHome&action=index&idSite=1&period=day&date=2012-08-09#?idSite=1&period=month&date=2012-08-09&category=General_Visitors&subcategory=UserCountry_SubmenuLocations');
        }, done);
    });
});
