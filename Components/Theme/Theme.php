<?php
/**
 * Theme.php
 *
 * PHP version 7
 *
 * @category    Together
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2019 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 */

namespace Xpressengine\Plugins\Together\Components\Theme;

use Xpressengine\Plugins\Together\DemoDataManager;
use Xpressengine\Theme\GenericTheme;

/**
 * Class Theme
 *
 * @category    Together
 *
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2019 Copyright XEHub Corp. <https://www.xehub.io>
 * @license     http://www.gnu.org/licenses/lgpl-3.0-standalone.html LGPL
 *
 * @link        https://xpressengine.io
 */
class Theme extends GenericTheme
{
    protected static $path = 'together/Components/Theme';

    protected $demoDataManager;

    public function __construct()
    {
        $this->demoDataManager = new DemoDataManager();
    }

    public function render()
    {
        return parent::render();
    }

    public function getThemeConfigInformation()
    {
        return $this->demoDataManager->getThemeConfig();
    }

    public function getMenuItemContents()
    {
        return $this->demoDataManager->getMenuItemContents();
    }

    public function getBoardContentsInformation()
    {
        return $this->demoDataManager->getBoardContents();
    }

    public function getBannerContentsInformation()
    {
        return $this->demoDataManager->getBannerContents();
    }

    public function getWidgetpageContentsInformation()
    {
        return $this->demoDataManager->getWidgetpageContents();
    }
}
