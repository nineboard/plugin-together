<?php
namespace Xpressengine\Plugins\Together\Components\Skins\Banner\Dday;

use Xpressengine\Skin\GenericSkin;
use View;
use Carbon\Carbon;

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

    /**
     * 블레이드 템플릿을 사용하여 스킨을 출력한다.
     *
     * @param null|string $view view name
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|null
     */
    protected function renderBlade($view = null)
    {
        if (isset($this->data['items']) && count($this->data['items'])) {
            foreach ($this->data['items'] as $item) {
                if (array_has($item, 'etc.dday_at')) {
                    try {
                        $dday_at = array_get($item, 'etc.dday_at');
                        $dday = Carbon::parse($dday_at);
                        $dday = $dday->diffInDays(Carbon::now(), false);
                        $diff = ($dday <= 0) ? 'D - ' . abs($dday) : 'D + ' . abs($dday);
                    } catch(\Exception $e) {
                        $diff = 'invalid';
                    }
                    $item['etc'] = array_merge(array_get($item, 'etc'), compact('diff'));
                }
            }
        }

        return parent::renderBlade($view);
    }

    public function renderBannerSetting($items = null)
    {
        return $view = View::make(sprintf('%s/views/setting', static::$path), [ 'item' => $items ]);
    }
}
