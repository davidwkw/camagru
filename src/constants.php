<?php

declare(strict_types=1);

namespace Camagru;

function init_constants(): void
{
    define('BASE_DIR', dirname(__FILE__));
    define('TEMPLATE_DIR', BASE_DIR . 'view/templates');
}

init_constants();
