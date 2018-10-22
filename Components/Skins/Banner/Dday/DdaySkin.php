<?php
namespace Xpressengine\Plugins\Together\Components\Skins\Banner\Dday;

use Xpressengine\Skin\GenericSkin;
use View;

use Xpressengine\Plugins\Banner\BannerWidgetSkin;

class DdaySkin extends BannerWidgetSkin
{
    /**
     * @var string
     */
    protected static $path = 'together/Components/Skins/Banner/Dday';

    public static function getBannerInfo($key = null)
    {
        if ($key) {
            $key = '.'.$key;
        }
        return static::info('banner'.$key);
    }

    public function renderBannerSetting($items = null)
    {
        return $view = View::make(sprintf('%s/views/setting', static::$path), [ 'item' => $items ]);
    }
}
