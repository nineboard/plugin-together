<?php
/**
 * Created by PhpStorm.
 * User: hero
 * Date: 07/01/2019
 * Time: 11:49 AM
 */

namespace Xpressengine\Plugins\Together;


use App\Facades\XeConfig;
use App\Facades\XeDB;
use App\Facades\XeMedia;
use App\Facades\XeMenu;
use App\Facades\XeSite;
use App\Facades\XeStorage;
use Illuminate\Support\Facades\Auth;
use Xpressengine\Media\Models\Image;
use Xpressengine\Permission\Grant;
use Xpressengine\Plugins\Banner\Widgets\Widget;
use Xpressengine\Plugins\Board\Components\Widgets\ArticleList\ArticleListWidget;
use Xpressengine\Plugins\Together\Components\Skins\ArticleList\Gallery\GallerySkin;
use Xpressengine\Plugins\Together\Components\Skins\ArticleList\Latest\LatestSkin;
use Xpressengine\Plugins\Together\Components\Skins\ArticleList\Media\MediaSkin;
use Xpressengine\Plugins\Together\Components\Skins\ArticleList\Notice\NoticeSkin;
use Xpressengine\Plugins\Together\Components\Skins\Banner\Category\CategorySkin;
use Xpressengine\Plugins\Together\Components\Skins\Banner\Dday\DdaySkin;
use Xpressengine\Plugins\Together\Components\Theme\Theme;

class Installer
{
    public static function install()
    {
        $menu = self::createMenu();
        self::setTheme($menu->id);
        $index = self::createIndexPage($menu);
        $board = self::createBoardPage($menu);
        for($i=0; $i<6; $i++){
            self::createArticleInBoard($board->id);
        }
        self::createWidgetIn($index, $board->id);
    }

    public static function setTheme($menuId)
    {
        $imageArray = self::createImageArrayFromPath(Plugin::path('assets/images/main_img.jpg'),'main_image.jpg');
        $image=Image::find($imageArray['id']);
        XeConfig::add('theme.settings.'.Theme::getId(),[
            'mainMenu'=>$menuId,
            'useSnb'=>'N',
            'useCopyright'=>'N'
        ]);
        XeConfig::add('theme.settings.'.Theme::getId().'.0', [
            'layoutType'=>'sub',
            'useMainHeader'=>'N'
        ]);
        XeConfig::add('theme.settings.'.Theme::getId().'.1', [
            'layoutType'=>'main',
            'useMainHeader'=>'Y',
            'headerImage'=>[
                'id'=>$imageArray['id'],
                'path'=> $image->url(),
                'filename'=>$image->filename
            ],
            'headerTitle'=>'Together 메인 테마입니다.',
            'headerDescription'=>'Together 메인 테마입니다.'
        ]);
    }

    public static function createMenu()
    {
        $menuTitle = 'Together';
        $menuDescription = 'Together 설치시 나타나는 기본 메뉴 입니다.';
        $defaultTheme=Theme::getId().'.0';
        $desktopTheme = $defaultTheme;
        $mobileTheme = $defaultTheme;


        XeDB::beginTransaction();

        try {
            $menu = XeMenu::createMenu([
                'title' => $menuTitle,
                'description' => $menuDescription,
                'site_key' => XeSite::getCurrentSiteKey(),
            ]);

            XeMenu::setMenuTheme($menu, $desktopTheme, $mobileTheme);

            app('xe.permission')->register($menu->getKey(), XeMenu::getDefaultGrant());
        } catch (\Exception $e) {
            XeDB::rollback();

            throw $e;
        }

        XeDB::commit();

        return $menu;
    }

    public static function createIndexPage($menu)
    {
        $theme = Theme::getId().'.1';

        XeDB::beginTransaction();

        try {

            $item = XeMenu::createItem($menu, [
                'title' => '샘플메인페이지',
                'url' => trim('together', " \t\n\r\0\x0B/"),
                'description' => 'Together 샘플페이지',
                'target' => '_self',
                'type' => 'widgetpage@widgetpage',
                'ordering' => 0,
                'activated' => 1,
                'parent_id' => null
            ],[
                'site_key' => $menu->site_key
            ]);
            app('xe.menu')->setMenuItemTheme($item,$theme,$theme);
            app('xe.permission')->register(XeMenu::permKeyString($item), new Grant(), $menu->site_key);
        } catch (\Exception $e) {
            XeDB::rollback();

            throw $e;
        }

        XeDB::commit();
        return $item;
    }

    public static function  createBoardPage($menu)
    {
        XeDB::beginTransaction();

        try {

            $item = XeMenu::createItem($menu, [
                'title' => '샘플게시판페이지',
                'url' => trim('together-board', " \t\n\r\0\x0B/"),
                'description' => 'Together 게시판페이지',
                'target' => '_self',
                'type' => 'board@board',
                'ordering' => 0,
                'activated' => 1,
                'parent_id' => null
            ],[
                'page_title' => 'Together Board',
                'board_name' => 'Together 게시판',
                'site_key' => $menu->site_key,
                'revision' => 'true',
                'division' => 'false',
            ]);
            app('xe.menu')->setMenuItemTheme($item,null,null);
            app('xe.permission')->register(XeMenu::permKeyString($item), new Grant(), $menu->site_key);
        } catch (\Exception $e) {
            XeDB::rollback();

            throw $e;
        }

        XeDB::commit();
        return $item;
    }

    public static function createArticleInBoard($board_id)
    {
        $imageArray = self::createImageArrayFromPath(Plugin::path('assets/images/board_img.jpg'),'board_image.jpg');
        $inputs['head'] = null;
        $inputs['queryString'] = null;
        $inputs['title'] = '아이돌룸 본방을 못보다니!!';
        $inputs['slug'] = app('xe.keygen')->generate();
        $inputs['content'] = '<p>Red Velvet Summer Mini Album ‘Summer Magic’ 발매를 기념하는 앨범 사인회가 오는 8월 18일(토) 진행됩니다. 여기는 최대 3줄까지 들어갑니다</p>';
        $inputs['_coverId'] = $imageArray['id'];
        $inputs['allow_comment'] = '1';
        $inputs['use_alarm'] = '1';
        $inputs['file'] = null;
        $inputs['instance_id'] = $board_id;
        $inputs['format'] = 10;
        $inputs['_files'] = [];
        $inputs['_hashTags'] = [];

        $config = app('xe.board.config')->get($board_id);
        app('xe.board.handler')->add($inputs, Auth::user(), $config);
    }

    public static function createBanner($title, $skin)
    {
        return app('xe.banner')->createGroup([
            'title'=>$title,
            'skin'=>$skin
        ]);
    }

    public static function createItemInBanner($bannerGroup, $title, $content, $image, $etc = [])
    {
        $option = [
            'title'=>$title,
            'content'=>$content,
            'image'=>$image,
            'status'=>'show'
        ];
        if(count($etc)>0){
            $option['etc']=$etc;
        }
        app('xe.banner')->createItem($bannerGroup, $option);
    }

    public static function createImageArrayFromPath($path, $name)
    {
        $file = file_get_contents($path);
        $xe_file = XeStorage::create($file, 'public/together/widget/sample',$name);
        $xe_image= XeMedia::make($xe_file);
        return [
            'id' => $xe_file->id,
            'filename' => $xe_file->clientname,
            'path' => $xe_image->url()
        ];
    }

    public static function createWidgetIn($menu_item, $board_id)
    {

        $media=[
            'board_id'=>$board_id,
            'take'=>'2',
            'recent_date'=>0,
            'order_type'=>'',
            '@attributes' =>[
                'id' => ArticleListWidget::getId(),
                'title' => '미디어위젯',
                'skin-id' => MediaSkin::getId()
            ]
        ];

        $category_banner = self::createBanner('카테고리 위젯', CategorySkin::getId());
        $category_sample_image = self::createImageArrayFromPath(Plugin::path('assets/images/category_img.jpg'),'category_image.jpg');
        self::createItemInBanner($category_banner, 'Red Velvet 레드벨벳', '레드벨벳이 참 예쁘네요.', $category_sample_image);
        self::createItemInBanner($category_banner, 'Red Velvet 레드벨벳', '레드벨벳이 참 예쁘네요.', $category_sample_image);
        self::createItemInBanner($category_banner, 'Red Velvet 레드벨벳', '레드벨벳이 참 예쁘네요.', $category_sample_image);
        self::createItemInBanner($category_banner, 'Red Velvet 레드벨벳', '레드벨벳이 참 예쁘네요.', $category_sample_image);

        $category=[
            'group_id'=>$category_banner->id,
            '@attributes' =>[
                'id' => Widget::getId(),
                'title' => '카테고리위젯',
                'skin-id' => CategorySkin::getId()
            ]
        ];


        $dday_banner = self::createBanner('디데이 위젯', DdaySkin::getId());
        $dday_sample_image = self::createImageArrayFromPath(Plugin::path('assets/images/dday_img.jpg'),'dday_image.jpg');

        self::createItemInBanner(
            $dday_banner,
            '제목은 한 줄까지만 들어가요',
            '미스테리한 차원의 세계와 마주친 레드벨벳 다섯 멤버가 전하면 미스터리한 세계보다 레드벨벳의 역시 더 눈이 가는데...',
            $dday_sample_image,
            [
                'dday_at' => now()->toDateString()
            ]
        );

        $dday=[
            'group_id'=>$dday_banner->id,
            '@attributes' =>[
                'id' => Widget::getId(),
                'title' => '디데이위젯',
                'skin-id' => DdaySkin::getId()
            ]
        ];
        $latest=[
            'board_id'=>$board_id,
            'take'=>'5',
            'recent_date'=>0,
            'order_type'=>'',
            '@attributes' =>[
                'id' => ArticleListWidget::getId(),
                'title' => '최신글위젯',
                'skin-id' => LatestSkin::getId()
            ]
        ];
        $notice=[
            'board_id'=>$board_id,
            'take'=>'2',
            'recent_date'=>0,
            'order_type'=>'',
            '@attributes' =>[
                'id' => ArticleListWidget::getId(),
                'title' => 'HOT ISSUE',
                'skin-id' => NoticeSkin::getId()
            ]
        ];
        $gallery=[
            'board_id'=>$board_id,
            'take'=>'6',
            'recent_date'=>0,
            'order_type'=>'',
            '@attributes' =>[
                'id' => ArticleListWidget::getId(),
                'title' => 'STAR GALLERY',
                'skin-id' => GallerySkin::getId()
            ]
        ];
        app('xe.widgetbox')->update('widgetpage-'.$menu_item->id, ['content' => [

            [
                [
                    'grid'=>[
                        'md'=>'12'
                    ],
                    'rows'=>[],
                    'widgets'=>[
                        $media
                    ]
                ]
            ],

            [
                [
                    'grid'=>[
                        'md'=>'12'
                    ],
                    'rows'=>[],
                    'widgets'=>[
                        $category
                    ]
                ]
            ],
            [
                [
                    'grid'=>[
                        'md'=>'9'
                    ],
                    'rows'=>[],
                    'widgets'=>[
                        $dday
                    ]
                ],
                [
                    'grid'=>[
                        'md'=>'3'
                    ],
                    'rows'=>[],
                    'widgets'=>[
                        $latest
                    ]
                ]
            ],
            [
                [
                    'grid'=>[
                        'md'=>'12'
                    ],
                    'rows'=>[],
                    'widgets'=>[
                        $notice
                    ]
                ]
            ],

            [
                [
                    'grid'=>[
                        'md'=>'12'
                    ],
                    'rows'=>[],
                    'widgets'=>[
                        $gallery
                    ]
                ]
            ]
        ]]);
    }
}
