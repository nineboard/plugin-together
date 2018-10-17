<?php
namespace Xpressengine\Plugins\Together\Components\WidgetSkins\ArticleList\Latest;

use Xpressengine\Skin\GenericSkin;
use View;

class LatestSkin extends GenericSkin
{
    /**
     * @var string
     */
    protected static $path = 'together/Components/WidgetSkins/ArticleList/LatestSkin';

    static public function getPath()
    {
        return 'plugins/together';
    }
}
