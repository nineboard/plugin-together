<?php
namespace Xpressengine\plugins\TheNextMagazine\Components\WidgetSkins\Banner\Skins\About;

use Xpressengine\Skin\GenericSkin;
use View;

use Xpressengine\Plugins\Banner\BannerWidgetSkin;

class AboutSkin extends BannerWidgetSkin
{
    protected static $path = 'the_next_magazine/Components/WidgetSkins/Banner/Skins/About';

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
