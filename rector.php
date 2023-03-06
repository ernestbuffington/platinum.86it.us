<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;
use Rector\Set\ValueObject\LevelSetList;
//use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictConstructorRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
		  //__DIR__ . '/db/mysqli.php', # PHP 8.2.3
		  //__DIR__ . '/modules.php', # PHP 8.2.3
		  //__DIR__ . '/themes/Titanium/theme.php', # PHP 8.2.3
		  //__DIR__ . '/includes/kses/kses.php', # PHP 8.2.3
		  //__DIR__ . '/blocks/block-Shout_Box.php', # PHP 8.2.3
		  //__DIR__ . '/blocks/block-ForumsCollapsing.php', # PHP 8.2.3
		  //__DIR__ . '/includes/nukesentinel.php', # PHP 8.2.3
		  //__DIR__ . '/includes/bbcode.php', # PHP 8.2.3 CRASH
		  //__DIR__ . '/mainfile.php', # PHP 8.2.3
		  //__DIR__ . '/modules/Forums/common.php', # PHP 8.2.3
		  //__DIR__ . '/modules/Forums/index.php', # PHP 8.2.3
		  //__DIR__ . '/includes/nsngr_func.php', # PHP 8.2.3
		  //__DIR__ . '/modules/Your_Account/includes/functions.php', # PHP 8.2.3
		    __DIR__ . '/modules/Your_Account/includes/phpbb_bbinfo.php', # PHP 8.2.3
		  //__DIR__ . '/modules/Your_Account/public/userinfo.php', # PHP 8.2.3
		  //__DIR__ . '/includes/classes/class.paginator_html.php', # PHP 8.2.3
		  //__DIR__ . '/modules/News/index.php', # PHP 8.2.3
		  //__DIR__ . '/modules/News/article.php', # PHP 8.2.3
		  //__DIR__ . '/index.php', # PHP 8.2.3
		  //__DIR__ . '/themes/Impressed/theme.php', # PHP 8.2.3
		  //__DIR__ . '/modules/Advertising/index.php', # PHP 8.2.3
		  //__DIR__ . '/modules/Advertising/admin/index.php', # PHP 8.2.3
    ]);

    // register a single rule
    // $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);
	$rectorConfig->rule(TypedPropertyFromStrictConstructorRector::class);

        $rectorConfig->sets([
		    SetList::CODE_QUALITY,
            LevelSetList::UP_TO_PHP_82
        ]);
};
