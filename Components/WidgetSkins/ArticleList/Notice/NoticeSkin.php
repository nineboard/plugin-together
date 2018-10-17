<?php
namespace Xpressengine\Plugins\Together\Components\WidgetSkins\ArticleList\Notice;

use Xpressengine\Skin\GenericSkin;
use View;

class NoticeSkin extends GenericSkin
{
    /**
     * @var string
     */
    protected static $path = 'together/Components/WidgetSkins/ArticleList/NoticeSkin';

    static public function getPath()
    {
        return 'plugins/together';
    }
}
