<?php

namespace Xpressengine\Plugins\Together\Components\Theme;

use Xpressengine\Plugins\Together\DemoDataManager;
use Xpressengine\Theme\GenericTheme;

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
