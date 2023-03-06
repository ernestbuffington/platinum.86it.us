<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
		  //__DIR__ . '/db/mysqli.php',
		  //__DIR__ . '/modules.php',
		  //__DIR__ . '/themes/Titanium/theme.php',
		  //__DIR__ . '/includes/kses/kses.php',
		  //__DIR__ . '/blocks/block-Shout_Box.php',
		  //__DIR__ . '/blocks/block-ForumsCollapsing.php',
		  //__DIR__ . '/includes/nukesentinel.php',
		  //__DIR__ . '/mainfile.php', # PHP 8.2.3
		  //__DIR__ . '/modules/Forums/common.php',
		  //__DIR__ . '/modules/Forums/index.php',
		  //__DIR__ . '/includes/nsngr_func.php',
		  //__DIR__ . '/modules/Your_Account/includes/functions.php',
		    __DIR__ . '/modules/Your_Account/public/userinfo.php',
		  //__DIR__ . '/includes/classes/class.paginator_html.php',
		  //__DIR__ . '/modules/News/index.php',
		  //__DIR__ . '/modules/News/article.php',
		  //__DIR__ . '/index.php',
		  //__DIR__ . '/themes/Impressed/theme.php',
		  //__DIR__ . '/modules/Advertising/index.php',
		  //__DIR__ . '/modules/Advertising/admin/index.php',
    ]);

    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

        $rectorConfig->sets([
            LevelSetList::UP_TO_PHP_82
        ]);
};
