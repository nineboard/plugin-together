<?php

namespace Xpressengine\Plugins\Together;

use XeLang;
use Xpressengine\Media\Models\Image;
use Xpressengine\Plugins\Banner\Widgets\Widget;
use Xpressengine\Plugins\Board\Components\Skins\Board\Blog\BlogSkin;
use Xpressengine\Plugins\Board\Components\Skins\Board\Gallery\GallerySkin;
use Xpressengine\Plugins\Board\Components\Widgets\ArticleList\ArticleListWidget;
use Xpressengine\Plugins\Together\Components\Skins\ArticleList\Gallery\GallerySkin as TogetherWidgetGallerySkin;
use Xpressengine\Plugins\Together\Components\Skins\ArticleList\Latest\LatestSkin;
use Xpressengine\Plugins\Together\Components\Skins\ArticleList\Media\MediaSkin;
use Xpressengine\Plugins\Together\Components\Skins\ArticleList\Notice\NoticeSkin;
use Xpressengine\Plugins\Together\Components\Skins\Banner\Category\CategorySkin;
use Xpressengine\Plugins\Together\Components\Skins\Banner\Dday\DdaySkin;

class DemoDataManager
{
    const MAIN_THEME_CONFIG = 'Together::MAIN_THEME_CONFIG';
    const SUB_THEME_CONFIG = 'Together::SUB_THEME_CONFIG';
    const WIDGETPAGE = 'Together::WIDGETPAGE';
    const NOTICE_BOARD = 'Together::NOTICE_BOARD';
    const BLOG_BOARD = 'Together::BLOG_BOARD';
    const BOARD_BOARD = 'Together::BOARD_BOARD';
    const GALLERY_BOARD = 'Together::GALLERY_BOARD';
    const CATEGORY_BANNER = 'Together::CATEGORY_BANNER';
    const DDAY_BANNER = 'Together::DDAY_BANNER';

    public function getThemeConfig()
    {
        $multiLines = [
            'headerTitle' => [
                'ko' => 'Welcome!' . PHP_EOL . 'XE3 Theme Together',
                'en' => 'Welcome!' . PHP_EOL . 'XE3 Theme Together'
            ],
            'headerDescription' => [
                'ko' => 'XE3에 오신걸 환영합니다.' . PHP_EOL . 'XE3와 함께 손쉬운 나만의 웹사이트를 만들어보세요.',
                'en' => 'Welcome to XE3.' . PHP_EOL . 'Create your personalized website with XE3.'
            ]
        ];

        foreach ($multiLines as $key => $lang) {
            $langKey = XeLang::genUserKey();
            XeLang::save($langKey, 'ko', $lang['ko'], true);
            $multiLines[$key] = $langKey;
        }

        $singleLines = [
            'logoText' => [
                'ko' => 'Together',
                'en' => 'Together'
            ],
            'slogan' => [
                'ko' => 'Welcome! XE3 Theme Together',
                'en' => 'Welcome! XE3 Theme Together'
            ]
        ];

        foreach ($singleLines as $key => $lang) {
            $langKey = XeLang::genUserKey();
            XeLang::save($langKey, 'ko', $lang['ko'], false);
            $singleLines[$key] = $langKey;
        }

        $imgInfo = $this->storeImage(Plugin::path('assets/images/demo_images/main_img.jpg'), 'main_image.jpg');
        $image = Image::find($imgInfo['id']);

        $subConfig = [
            '_configTitle' => '기본',
            'layoutType' => 'sub',
            'logoType' => 'text',
            'logoImage' => 'assets/images/demo_images/main_img.jpg',
            'useMainHeader' => 'N',
            'useSnb' => 'Y',
            'socialTwitter' => '',
            'socialYoutube' => '',
            'socialInstagram' => '',
            'socialFacebook' => '',
            'useCopyright' => 'Y',
            'copyrightContent' => '',
        ];
        $subConfig = array_merge($subConfig, $multiLines, $singleLines);

        $mainConfig = [
            '_configTitle' => '메인페이지용',
            'useMainHeader' => 'Y',
            'layoutType' => 'main',
            'headerImage' => [
                'id' => $imgInfo['id'],
                'path' => $image->url(),
                'filename' => $image->filename
            ],
        ];
        $mainConfig = array_merge($subConfig, $mainConfig, $multiLines, $singleLines);

        return [
            self::MAIN_THEME_CONFIG => $mainConfig,
            self::SUB_THEME_CONFIG => $subConfig
        ];
    }

    public function getMenuItemContents()
    {
        $widgetpageTitle = XeLang::genUserKey();
        foreach (XeLang::getLocales() as $locale) {
            $value = "Widgetpage";
            if ($locale != 'ko') {
                $value = "Widgetpage";
            }
            XeLang::save($widgetpageTitle, $locale, $value, false);
        }
        $noticeBoardTitle = XeLang::genUserKey();
        foreach (XeLang::getLocales() as $locale) {
            $value = "Notice";
            if ($locale != 'ko') {
                $value = "Notice";
            }
            XeLang::save($noticeBoardTitle, $locale, $value, false);
        }
        $blogBoardTitle = XeLang::genUserKey();
        foreach (XeLang::getLocales() as $locale) {
            $value = "Blog";
            if ($locale != 'ko') {
                $value = "Blog";
            }
            XeLang::save($blogBoardTitle, $locale, $value, false);
        }
        $boardBoardTitle = XeLang::genUserKey();
        foreach (XeLang::getLocales() as $locale) {
            $value = "Board";
            if ($locale != 'ko') {
                $value = "Board";
            }
            XeLang::save($boardBoardTitle, $locale, $value, false);
        }
        $galleryBoardTitle = XeLang::genUserKey();
        foreach (XeLang::getLocales() as $locale) {
            $value = "Gallery";
            if ($locale != 'ko') {
                $value = "Gallery";
            }
            XeLang::save($galleryBoardTitle, $locale, $value, false);
        }

        $menuItems['widgetpage'][self::WIDGETPAGE] = [
            'input' => [
                'parent_id' => null,
                'title' => $widgetpageTitle,
                'description' => 'Together',
                'target' => '',
                'type' => 'widgetpage@widgetpage',
                'ordering' => '1',
                'activated' => '1',
            ],
            'menuType' => [
                'pageTitle' => 'Welcome to XpressEngine3',
                'comment' => false,
                'siteKey' => 'default'
            ],
            'options' => [
                'theme' => self::MAIN_THEME_CONFIG
            ]
        ];

        $menuItems['board'][self::NOTICE_BOARD] = [
            'input' => [
                'parent_id' => null,
                'title' => $noticeBoardTitle,
                'description' => 'Notice',
                'target' => '',
                'type' => 'board@board',
                'ordering' => '1',
                'activated' => '1',
            ],
            'menuType' => [
                'page_title' => 'Board',
                'board_name' => 'Notice',
                'site_key' => 'default',
                'revision' => 'true',
                'division' => 'false',
            ]
        ];

        $menuItems['board'][self::BLOG_BOARD] = [
            'input' => [
                'parent_id' => null,
                'title' => $blogBoardTitle,
                'description' => 'Blog',
                'target' => '',
                'type' => 'board@board',
                'ordering' => '2',
                'activated' => '1',
            ],
            'menuType' => [
                'page_title' => 'Board',
                'board_name' => 'Blog',
                'site_key' => 'default',
                'revision' => 'true',
                'division' => 'false',
            ],
            'options' => [
                'boardSkin' => BlogSkin::getId()
            ]
        ];

        $menuItems['board'][self::BOARD_BOARD] = [
            'input' => [
                'parent_id' => null,
                'title' => $boardBoardTitle,
                'description' => 'Board',
                'target' => '',
                'type' => 'board@board',
                'ordering' => '3',
                'activated' => '1',
            ],
            'menuType' => [
                'page_title' => 'Board',
                'board_name' => 'Board',
                'site_key' => 'default',
                'revision' => 'true',
                'division' => 'false',
            ]
        ];

        $menuItems['board'][self::GALLERY_BOARD] = [
            'input' => [
                'parent_id' => null,
                'title' => $galleryBoardTitle,
                'description' => 'Gallery',
                'target' => '',
                'type' => 'board@board',
                'ordering' => '4',
                'activated' => '1',
            ],
            'menuType' => [
                'page_title' => 'Board',
                'board_name' => 'Gallery',
                'site_key' => 'default',
                'revision' => 'true',
                'division' => 'false',
            ],
            'options' => [
                'boardSkin' => GallerySkin::getId()
            ]
        ];

        $menuItems['banner'][self::CATEGORY_BANNER] = [
            'title' => '카테고리 배너 Demo' . rand(1, 10000),
            'skin' => CategorySkin::getId()
        ];

        $menuItems['banner'][self::DDAY_BANNER] = [
            'title' => '디데이 배너 Demo' . rand(1, 10000),
            'skin' => DdaySkin::getId()
        ];

        return $menuItems;
    }

    public function getBoardContents()
    {
        $contents[self::NOTICE_BOARD] = $this->getNoticeBoardContents();
        $contents[self::BLOG_BOARD] = $this->getBlogBoardContents();
        $contents[self::BOARD_BOARD] = $this->getBoardBoardContents();
        $contents[self::GALLERY_BOARD] = $this->getGalleryBoardContents();

        return $contents;
    }

    public function getBannerContents()
    {
        $imageInfo = $this->storeImage(Plugin::path('assets/images/demo_images/banner1.jpg'), 'banner1.jpg');
        $contents[self::CATEGORY_BANNER][] = [
            'status' => 'show',
            'title' => '홈 화면 변경하기',
            'content' => '사이트 홈을 설정해보세요',
            'link' => '#1',
            'image' => $imageInfo,
        ];

        $imageInfo = $this->storeImage(Plugin::path('assets/images/demo_images/banner2.jpg'), 'banner2.jpg');
        $contents[self::CATEGORY_BANNER][] = [
            'status' => 'show',
            'title' => '메뉴 구조 구성하기',
            'content' => '메뉴를 만들어 보세요',
            'link' => '#2',
            'image' => $imageInfo,
        ];

        $imageInfo = $this->storeImage(Plugin::path('assets/images/demo_images/banner3.jpg'), 'banner3.jpg');
        $contents[self::CATEGORY_BANNER][] = [
            'status' => 'show',
            'title' => '테마 디자인 변경하기',
            'content' => '다른 테마로 변경해보세요',
            'link' => '#3',
            'image' => $imageInfo,
        ];

        $imageInfo = $this->storeImage(Plugin::path('assets/images/demo_images/banner4.jpg'), 'banner4.jpg');
        $contents[self::CATEGORY_BANNER][] = [
            'status' => 'show',
            'title' => '플러그인 관리하기',
            'content' => '새로운 플러그인을 설치해보세요',
            'link' => '#4',
            'image' => $imageInfo,
        ];

        $imageInfo = $this->storeImage(Plugin::path('assets/images/demo_images/dday.jpg'), 'dday.jpg');
        $contents[self::DDAY_BANNER][] = [
            'status' => 'show',
            'title' => 'XE Store Beta Open',
            'content' => 'XE의 멋진 익스텐션과 테마를 만나보세요!' . PHP_EOL . '마음에 드는 플러그인을 골라 웹사이트의 기능을 확장하고 아름답게 꾸며보세요!',
            'link' => 'https://store.xehub.io',
            'image' => $imageInfo,
            'link_target' => '_blank',
            'etc' => ['dday_at' => '2019-02-27']
        ];

        return $contents;
    }

    public function getWidgetpageContents()
    {
        $mediaWidget = [
            'board_id' => self::BLOG_BOARD,
            'take' => '2',
            'recent_date' => 0,
            'order_type' => '',
            '@attributes' => [
                'id' => ArticleListWidget::getId(),
                'title' => '미디어 위젯',
                'skin-id' => MediaSkin::getId()
            ]
        ];

        $boardWidget = [
            'board_id' => self::BOARD_BOARD,
            'take' => '4',
            'recent_date' => 0,
            'order_type' => '',
            '@attributes' => [
                'id' => ArticleListWidget::getId(),
                'title' => '최신글 위젯',
                'skin-id' => LatestSkin::getId()
            ]
        ];

        $noticeWidget = [
            'board_id' => self::NOTICE_BOARD,
            'take' => '2',
            'recent_date' => 0,
            'order_type' => '',
            '@attributes' => [
                'id' => ArticleListWidget::getId(),
                'title' => 'NOTICE',
                'skin-id' => NoticeSkin::getId()
            ]
        ];

        $galleryWidget = [
            'board_id' => self::GALLERY_BOARD,
            'take' => '6',
            'recent_date' => 0,
            'order_type' => '',
            '@attributes' => [
                'id' => ArticleListWidget::getId(),
                'title' => 'Gallery',
                'skin-id' => TogetherWidgetGallerySkin::getId()
            ]
        ];

        $ddayBannerWidget = [
            'group_id' => self::DDAY_BANNER,
            '@attributes' => [
                'id' => Widget::getId(),
                'title' => '디데이 배너 위젯',
                'skin-id' => DdaySkin::getId()
            ]
        ];

        $categoryBannerWidget = [
            'group_id' => self::CATEGORY_BANNER,
            '@attributes' => [
                'id' => Widget::getId(),
                'title' => '카테고리 배너 위젯',
                'skin-id' => CategorySkin::getId()
            ]
        ];

        $contents[self::WIDGETPAGE] = [
            [
                [
                    'grid' => [
                        'md' => '12'
                    ],
                    'rows' => [],
                    'widgets' => [
                        $mediaWidget
                    ]
                ]
            ],
            [
                [
                    'grid' => [
                        'md' => '12'
                    ],
                    'rows' => [],
                    'widgets' => [
                        $categoryBannerWidget
                    ]
                ]
            ],
            [
                [
                    'grid' => [
                        'md' => '9'
                    ],
                    'rows' => [],
                    'widgets' => [
                        $ddayBannerWidget
                    ]
                ],
                [
                    'grid' => [
                        'md' => '3'
                    ],
                    'rows' => [],
                    'widgets' => [
                        $boardWidget
                    ]
                ]
            ],
            [
                [
                    'grid' => [
                        'md' => '12'
                    ],
                    'rows' => [],
                    'widgets' => [
                        $noticeWidget
                    ]
                ]
            ],

            [
                [
                    'grid' => [
                        'md' => '12'
                    ],
                    'rows' => [],
                    'widgets' => [
                        $galleryWidget
                    ]
                ]
            ]
        ];

        return $contents;
    }

    private function storeImage($path, $name)
    {
        $file = file_get_contents($path);
        $imgFile = \XeStorage::create($file, 'public/together/widget/sample', $name);
        $image = \XeMedia::make($imgFile);

        return [
            'id' => $imgFile->id,
            'filename' => $imgFile->clientname,
            'path' => $image->url()
        ];
    }

    public function getNoticeBoardContents()
    {
        $firstExampleImageInfo = $this->storeImage(Plugin::path('assets/images/demo_images/board_banner_setting_first_ex.png'), 'board_banner_setting_first_ex.png');
        $secondExampleImageInfo = $this->storeImage(Plugin::path('assets/images/demo_images/board_banner_setting_second_ex.png'), 'board_banner_setting_second_ex.png');
        $contents[] = [
            'title' => 'D-Day 배너 설정하기',
            'slug' => 'D-Day 배너 설정하기',
            'content' => '<img class="__xe_image" data-id="' . $firstExampleImageInfo['id'] . '" src="' . $firstExampleImageInfo['path'] .
                '" xe-file-id="' . $firstExampleImageInfo['id'] . '" alt="' . $firstExampleImageInfo['filename'] . '" /><br/>' .
                '<img class="__xe_image" data-id="' . $secondExampleImageInfo['id'] . '" src="' . $secondExampleImageInfo['path'] .
                '" xe-file-id="' . $secondExampleImageInfo['id'] . '" alt="' . $secondExampleImageInfo['filename'] . '" />'
                . '<p>메인 페이지의 D-Day 배너를 설정하세요.<br/>
배너 설정은 <a href="'.route('settings.setting.permissions').'" target="_blank">사이트관리 > 플러그인 > 설치된 플러그인 > 배너 설정</a>에서 설정할 수 있습니다.</p>',
            '_coverId' => '',
            'allow_comment' => '1',
            'use_alarm' => '1',
            'file' => null,
            'format' => 10,
            '_files' => [],
            '_hashTags' => [],
        ];

        $exampleImageInfo = $this->storeImage(Plugin::path('assets/images/demo_images/board_site_permission_ex.png'), 'board_site_permission_ex.png');
        $contents[] = [
            'title' => '관리페이지 권한 설정하기',
            'slug' => '관리페이지 권한 설정하기',
            'content' => '<img class="__xe_image" data-id="' . $exampleImageInfo['id'] . '" src="' . $exampleImageInfo['path'] .
                '" xe-file-id="' . $exampleImageInfo['id'] . '" alt="' . $exampleImageInfo['filename'] . '" />'
                . '<p>사이트의 관리 권한을 설정하세요.<br/>
권한 설정은 <a href="'.route('settings.setting.permissions').'" target="_blank">사이트관리 > 설정 > 관리페이지 권한 설정</a>에서 수정할 수 있습니다.</p>',
            '_coverId' => '',
            'allow_comment' => '1',
            'use_alarm' => '1',
            'file' => null,
            'format' => 10,
            '_files' => [],
            '_hashTags' => [],
        ];

        return $contents;
    }

    public function getBlogBoardContents()
    {
        $thumbNailInfo = $this->storeImage(Plugin::path('assets/images/demo_images/blog6_thumb.jpg'), 'blog6_thumb.jpg');
        $exampleImageInfo = $this->storeImage(Plugin::path('assets/images/demo_images/board_plugin_ex.png'), 'board_plugin_ex.png');
        $contents[] = [
            'title' => '플러그인 관리하기',
            'slug' => '플러그인 관리하기',
            'content' => '<img class="__xe_image" data-id="' . $exampleImageInfo['id'] . '" src="' . $exampleImageInfo['path'] .
                '" xe-file-id="' . $exampleImageInfo['id'] . '" alt="' . $exampleImageInfo['filename'] . '" />'
                . '<p>스토어에서 플러그인을 설치하여 사이트를 풍성하게 만들어보세요.<br/>플러그인은 <a href="'.route('settings.plugins').'" target="_blank">사이트관리 > 플러그인 > 플러그인 추가</a>에서 설정할 수 있습니다.</p>',
            '_coverId' => $thumbNailInfo['id'],
            'allow_comment' => '1',
            'use_alarm' => '1',
            'file' => null,
            'format' => 10,
            '_files' => [],
            '_hashTags' => [],
        ];

        $thumbNailInfo = $this->storeImage(Plugin::path('assets/images/demo_images/blog5_thumb.jpg'), 'blog5_thumb.jpg');
        $exampleImageInfo = $this->storeImage(Plugin::path('assets/images/demo_images/board_theme_ex.png'), 'board_theme_ex.png');
        $contents[] = [
            'title' => '테마 디자인 변경하기',
            'slug' => '테마 디자인 변경하기',
            'content' => '<img class="__xe_image" data-id="' . $exampleImageInfo['id'] . '" src="' . $exampleImageInfo['path'] .
                '" xe-file-id="' . $exampleImageInfo['id'] . '" alt="' . $exampleImageInfo['filename'] . '" />'
                . '<p>다른 테마가 필요하신가요? 내가 만든 테마를 적용하고 싶으신가요?<br/><a href="'.route('settings.setting.theme').'" target="_blank">사이트관리 > 설정 > 테마 기본설정</a>에서 변경할 수 있습니다.</p>',
            '_coverId' => $thumbNailInfo['id'],
            'allow_comment' => '1',
            'use_alarm' => '1',
            'file' => null,
            'format' => 10,
            '_files' => [],
            '_hashTags' => [],
        ];

        $thumbNailInfo = $this->storeImage(Plugin::path('assets/images/demo_images/blog4_thumb.jpg'), 'blog4_thumb.jpg');
        $exampleImageInfo = $this->storeImage(Plugin::path('assets/images/demo_images/board_sitemap_menu_ex.png'), 'board_sitemap_menu_ex.png');
        $contents[] = [
            'title' => '메뉴 구조 구성하기',
            'slug' => '메뉴 구조 구성하기',
            'content' => '<img class="__xe_image" data-id="' . $exampleImageInfo['id'] . '" src="' . $exampleImageInfo['path'] .
                '" xe-file-id="' . $exampleImageInfo['id'] . '" alt="' . $exampleImageInfo['filename'] . '" />'
                . '<p>메뉴를 만들어 사이트맵을 구성해보세요.<br/><a href="'.route('settings.menu.index').'" target="_blank">사이트 관리 > 사이트맵 > 사이트메뉴 편집</a>에서 메뉴를 설정합니다.</p>',
            '_coverId' => $thumbNailInfo['id'],
            'allow_comment' => '1',
            'use_alarm' => '1',
            'file' => null,
            'format' => 10,
            '_files' => [],
            '_hashTags' => [],
        ];

        $thumbNailInfo = $this->storeImage(Plugin::path('assets/images/demo_images/blog3_thumb.jpg'), 'blog3_thumb.jpg');
        $exampleImageInfo = $this->storeImage(Plugin::path('assets/images/demo_images/board_sitemap_home_ex.png'), 'board_sitemap_home_ex.png');
        $contents[] = [
            'title' => '홈 화면 변경하기',
            'slug' => '홈 화면 변경하기',
            'content' => '<img class="__xe_image" data-id="' . $exampleImageInfo['id'] . '" src="' . $exampleImageInfo['path'] .
                '" xe-file-id="' . $exampleImageInfo['id'] . '" alt="' . $exampleImageInfo['filename'] . '" />'
                . '<p>사이트 홈을 설정해 보세요.<br/><a href="'.route('settings.menu.index').'" target="_blank">사이트 관리 > 사이트맵 > 사이트 메뉴 편집</a>에서 홈을 설정합니다.</p>',
            '_coverId' => $thumbNailInfo['id'],
            'allow_comment' => '1',
            'use_alarm' => '1',
            'file' => null,
            'format' => 10,
            '_files' => [],
            '_hashTags' => [],
        ];

        $thumbNailInfo = $this->storeImage(Plugin::path('assets/images/demo_images/blog2_thumb.jpg'), 'blog2_thumb.jpg');
        $exampleImageInfo = $this->storeImage(Plugin::path('assets/images/demo_images/board_site_setting_ex.png'), 'board_site_setting_ex.png');
        $contents[] = [
            'title' => '사이트 기본 설정을 확인해보세요',
            'slug' => '사이트 기본 설정을 확인해보세요',
            'content' => '<img class="__xe_image" data-id="' . $exampleImageInfo['id'] . '" src="' . $exampleImageInfo['path'] .
                '" xe-file-id="' . $exampleImageInfo['id'] . '" alt="' . $exampleImageInfo['filename'] . '" />'
                . '<p>홈페이지 기본 설정을 변경해 보세요.<br/><a href="'.route('settings.setting.edit').'" target="_blank">사이트 관리 > 설정 > 사이트 기본설정</a>에서 사이트 제목을 설정할 수 있습니다.</p>',
            '_coverId' => $thumbNailInfo['id'],
            'allow_comment' => '1',
            'use_alarm' => '1',
            'file' => null,
            'format' => 10,
            '_files' => [],
            '_hashTags' => [],
        ];

        $thumbNailInfo = $this->storeImage(Plugin::path('assets/images/demo_images/blog1_thumb.jpg'), 'blog1_thumb.jpg');
        $defaultSkinImageInfo = $this->storeImage(Plugin::path('assets/images/demo_images/default_skin.png'), 'default_skin.png');
        $gallerySkinImageInfo = $this->storeImage(Plugin::path('assets/images/demo_images/gallery_skin.png'), 'gallery_skin.png');
        $blogSkinImageInfo = $this->storeImage(Plugin::path('assets/images/demo_images/blog_skin.png'), 'blog_skin.png');
        $ddaySampleImageInfo = $this->storeImage(Plugin::path('assets/images/demo_images/dday_sample.png'), 'dday_sample.png');
        $contents[] = [
            'title' => 'XE Theme Together를 소개합니다',
            'slug' => 'XE Theme Together를 소개합니다',
            'content' => '<p>XE3 공식테마 Together를 설치해주셔서 감사합니다.<br/>다양한 게시판 위젯과 디데이, 카테고리 위젯을 제공하고 있습니다.<br/>Together theme로 개성있는 나만의 웹 사이트를 제작해보세요.<br/></p>' .
                '<p><span style="font-size:16px;"><b>◆ 원하는 형태의 게시판을 게시판 스킨 변경으로 자유롭게 배치해보세요</b></span></p>' .
                '<img class="__xe_image" data-id="' . $defaultSkinImageInfo['id'] . '" src="' . $defaultSkinImageInfo['path'] .
                '" xe-file-id="' . $defaultSkinImageInfo['id'] . '" alt="' . $defaultSkinImageInfo['filename'] . '" />' .
                '<p>리스트형 게시판 (기본)</p>' .
                '<img class="__xe_image" data-id="' . $gallerySkinImageInfo['id'] . '" src="' . $gallerySkinImageInfo['path'] .
                '" xe-file-id="' . $gallerySkinImageInfo['id'] . '" alt="' . $gallerySkinImageInfo['filename'] . '" />' .
                '<p>갤러리형 게시판</p>' .
                '<img class="__xe_image" data-id="' . $blogSkinImageInfo['id'] . '" src="' . $blogSkinImageInfo['path'] .
                '" xe-file-id="' . $blogSkinImageInfo['id'] . '" alt="' . $blogSkinImageInfo['filename'] . '" />' .
                '<p>블로그형 게시판</p>' .
                '<p><span style="font-size:16px;"><b>◆ D day 위젯을 통해 중요 알림을 공지해보세요</b></span></p>' .
                '<img class="__xe_image" data-id="' . $ddaySampleImageInfo['id'] . '" src="' . $ddaySampleImageInfo['path'] .
                '" xe-file-id="' . $ddaySampleImageInfo['id'] . '" alt="' . $ddaySampleImageInfo['filename'] . '" />',
            '_coverId' => $thumbNailInfo['id'],
            'allow_comment' => '1',
            'use_alarm' => '1',
            'file' => null,
            'format' => 10,
            '_files' => [],
            '_hashTags' => [],
        ];

        return $contents;
    }

    public function getBoardBoardContents()
    {
        $exampleImageInfo = $this->storeImage(Plugin::path('assets/images/demo_images/board4.png'), 'board4.png');
        $contents[] = [
            'title' => '스토어는 왜 베타인가요?',
            'slug' => '스토어는 왜 베타인가요?',
            'content' => '<img class="__xe_image" data-id="' . $exampleImageInfo['id'] . '" src="' . $exampleImageInfo['path'] .
                '" xe-file-id="' . $exampleImageInfo['id'] . '" alt="' . $exampleImageInfo['filename'] . '" />'
                . '<p>베타 기간동안 창작자를 위해 플랫폼 수수료를 대폭 낮추고 XEHub에서 기술지원을 드리려고 합니다.<br/>무료, 유료 플러그인이 유통되기 시작하면 정식 오픈을 할 예정이니, 창작자로서 참여하고 싶다면 서두르세요!</p>',
            '_coverId' => '',
            'allow_comment' => '1',
            'use_alarm' => '1',
            'file' => null,
            'format' => 10,
            '_files' => [],
            '_hashTags' => [],
        ];

        $exampleImageInfo = $this->storeImage(Plugin::path('assets/images/demo_images/board3.png'), 'board3.png');
        $contents[] = [
            'title' => '창작자를 위해 준비했어요!',
            'slug' => '창작자를 위해 준비했어요!',
            'content' => '<img class="__xe_image" data-id="' . $exampleImageInfo['id'] . '" src="' . $exampleImageInfo['path'] .
                '" xe-file-id="' . $exampleImageInfo['id'] . '" alt="' . $exampleImageInfo['filename'] . '" />'
                . '<p>XEHub는 창작자분들의 창의성을 응원하고 다양한 프로그램을 통해 열심히 도움을 드립니다.<br/>XE Study에 참여하여 창작자가 될 수 있고, 초기 판매자가 되어 XE의 플러그인 시장을 확보할 수도 있습니다.</p>',
            '_coverId' => '',
            'allow_comment' => '1',
            'use_alarm' => '1',
            'file' => null,
            'format' => 10,
            '_files' => [],
            '_hashTags' => [],
        ];

        $exampleImageInfo = $this->storeImage(Plugin::path('assets/images/demo_images/board2.png'), 'board2.png');
        $contents[] = [
            'title' => 'XE창작자는 무엇인가요?',
            'slug' => 'XE창작자는 무엇인가요?',
            'content' => '<img class="__xe_image" data-id="' . $exampleImageInfo['id'] . '" src="' . $exampleImageInfo['path'] .
                '" xe-file-id="' . $exampleImageInfo['id'] . '" alt="' . $exampleImageInfo['filename'] . '" />'
                . '<p>XE Store에서 창작자는 무료로 개발한 플러그인을 오픈소스로 공개하여 사용자의 피드백을 받아볼 수 있고,<br/>유료 플러그인을 게시하여 창작자가 만든 제품의 가치만큼 수익을 얻을 수 있습니다.<br/>여러분의 번뜩이는 아이디어와 지식으로 아직 부족한 XE Store를 가득 채우기를 고대하고 있어요.</p>',
            '_coverId' => '',
            'allow_comment' => '1',
            'use_alarm' => '1',
            'file' => null,
            'format' => 10,
            '_files' => [],
            '_hashTags' => [],
        ];

        $exampleImageInfo = $this->storeImage(Plugin::path('assets/images/demo_images/board1.png'), 'board1.png');
        $contents[] = [
            'title' => '스토어는 어떤 공간인가요?',
            'slug' => '스토어는 어떤 공간인가요?',
            'content' => '<img class="__xe_image" data-id="' . $exampleImageInfo['id'] . '" src="' . $exampleImageInfo['path'] .
                '" xe-file-id="' . $exampleImageInfo['id'] . '" alt="' . $exampleImageInfo['filename'] . '" />'
                . '<p>창작자는 자신이 만든 플러그인을 공개하거나 판매할 수 있고,<br/>XE3 사용자는 Store를 통해 마음에 드는 플러그인을 골라 웹사이트의 기능을 확장하고 아름답게 꾸밀 수 있습니다.</p>',
            '_coverId' => '',
            'allow_comment' => '1',
            'use_alarm' => '1',
            'file' => null,
            'format' => 10,
            '_files' => [],
            '_hashTags' => [],
        ];

        return $contents;
    }

    public function getGalleryBoardContents()
    {
        $thumbNailInfo = $this->storeImage(Plugin::path('assets/images/demo_images/gallery1.jpg'), 'gallery1.jpg');
        $contents[] = [
            'title' => 'gallery1',
            'slug' => 'gallery1',
            'content' => '<p></p>',
            '_coverId' => $thumbNailInfo['id'],
            'allow_comment' => '1',
            'use_alarm' => '1',
            'file' => null,
            'format' => 10,
            '_files' => [],
            '_hashTags' => [],
        ];

        $thumbNailInfo = $this->storeImage(Plugin::path('assets/images/demo_images/gallery2.jpg'), 'gallery2.jpg');
        $contents[] = [
            'title' => 'gallery2',
            'slug' => 'gallery2',
            'content' => '<p></p>',
            '_coverId' => $thumbNailInfo['id'],
            'allow_comment' => '1',
            'use_alarm' => '1',
            'file' => null,
            'format' => 10,
            '_files' => [],
            '_hashTags' => [],
        ];

        $thumbNailInfo = $this->storeImage(Plugin::path('assets/images/demo_images/gallery3.jpg'), 'gallery3.jpg');
        $contents[] = [
            'title' => 'gallery3',
            'slug' => 'gallery3',
            'content' => '<p></p>',
            '_coverId' => $thumbNailInfo['id'],
            'allow_comment' => '1',
            'use_alarm' => '1',
            'file' => null,
            'format' => 10,
            '_files' => [],
            '_hashTags' => [],
        ];

        $thumbNailInfo = $this->storeImage(Plugin::path('assets/images/demo_images/gallery4.jpg'), 'gallery4.jpg');
        $contents[] = [
            'title' => 'gallery4',
            'slug' => 'gallery4',
            'content' => '<p></p>',
            '_coverId' => $thumbNailInfo['id'],
            'allow_comment' => '1',
            'use_alarm' => '1',
            'file' => null,
            'format' => 10,
            '_files' => [],
            '_hashTags' => [],
        ];

        $thumbNailInfo = $this->storeImage(Plugin::path('assets/images/demo_images/gallery5.jpg'), 'gallery5.jpg');
        $contents[] = [
            'title' => 'gallery5',
            'slug' => 'gallery5',
            'content' => '<p></p>',
            '_coverId' => $thumbNailInfo['id'],
            'allow_comment' => '1',
            'use_alarm' => '1',
            'file' => null,
            'format' => 10,
            '_files' => [],
            '_hashTags' => [],
        ];

        $thumbNailInfo = $this->storeImage(Plugin::path('assets/images/demo_images/gallery6.jpg'), 'gallery6.jpg');
        $contents[] = [
            'title' => 'gallery6',
            'slug' => 'gallery6',
            'content' => '<p></p>',
            '_coverId' => $thumbNailInfo['id'],
            'allow_comment' => '1',
            'use_alarm' => '1',
            'file' => null,
            'format' => 10,
            '_files' => [],
            '_hashTags' => [],
        ];

        return $contents;
    }
}
