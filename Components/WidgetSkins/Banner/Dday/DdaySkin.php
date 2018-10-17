<?php
namespace Xpressengine\Plugins\Together\Components\WidgetSkins\Banner\Dday;

use Xpressengine\Skin\GenericSkin;
use View;

use Xpressengine\Plugins\Banner\BannerWidgetSkin;

class DdaySkin extends BannerWidgetSkin
{
    protected static $path = 'together/Components/WidgetSkins/Banner/Skins/Dday';

    public static function getBannerInfo($key = null)
    {
        if ($key) {
            $key = '.'.$key;
        }
        return static::info('banner'.$key);
    }

    public function renderBannerSetting()
    {
        return '';
    }

    /**
     * @var string
     */

    static public function getPath()
    {
        return 'plugins/' . static::$path;
    }
}
