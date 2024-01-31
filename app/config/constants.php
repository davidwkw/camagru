<?php

declare(strict_types=1);

namespace Camagru;

define('BASE_DIR', dirname(dirname(__FILE__)));
define('TEMPLATES_DIR', BASE_DIR . '/views/templates');
define('URL_ROOT', '/');
define('GLOBAL_CSS_HREF', ["global.css"]);
define('GLOBAL_JS_SRCS', []);
define('SITE_NAME', "Camagru");
define('BASE_HEAD_ARGS', ["title" => SITE_NAME, "cssPaths" => GLOBAL_CSS_HREF, "scriptPaths" => GLOBAL_JS_SRCS]);
define('BASE_NAV_ARGS', ["homeLink" => ["name" => SITE_NAME, "href" => "index.php"], "navLinks" => []]);
define('DOCUMENT_ROOT', 'public/');
