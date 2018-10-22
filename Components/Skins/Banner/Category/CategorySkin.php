<?php
namespace Xpressengine\Plugins\Together\Components\Skins\Banner\Category;

use Xpressengine\Skin\GenericSkin;
use View;

use Xpressengine\Plugins\Banner\BannerWidgetSkin;

class CategorySkin extends BannerWidgetSkin
{
    /**
     * @var string
     */
    protected static $path = 'together/Components/Skins/Banner/Category';

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
}
