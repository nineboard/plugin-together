<?php

namespace Xpressengine\Plugins\Together\Components\Skins\Board\Together;

use Xpressengine\Config\ConfigEntity;
use Xpressengine\Http\Request;
use Xpressengine\Media\Models\Image;
use Xpressengine\Plugins\Board\Components\Modules\BoardModule;
use Xpressengine\Plugins\Board\Components\Skins\Board\Gallery\GallerySKin;
use Xpressengine\Plugins\Board\Models\Board;
use Xpressengine\Plugins\Board\Models\BoardGalleryThumb;
use Xpressengine\Plugins\Board\Handler as BoardHandler;
use XeStorage;
use XeSkin;
use View;
use Event;
use Input;
use App;
use Xpressengine\Presenter\Presenter;
use Xpressengine\Routing\InstanceConfig;

class TogetherSkin extends GallerySkin
{
    protected static $path = 'together/components/Skins/Board/Together';
}
