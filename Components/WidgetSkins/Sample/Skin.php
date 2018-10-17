<?php
namespace Xpressengine\plugins\Together\Components\WidgetSkins\ArticleList\SampleSkin;

use Xpressengine\Skin\GenericSkin;
use View;

class SampleSkin extends GenericSkin
{
    /**
     * @var string
     */
    protected static $path = 'together/Components/WidgetSkins/ArticleList/SampleSkin';

    static public function getPath()
    {
        return 'plugins/together';
    }
}
