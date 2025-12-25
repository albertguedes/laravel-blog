<?php declare(strict_types=1);

require_once __DIR__.'/web/auth.php';

require_once __DIR__.'/web/authors.php';

require_once __DIR__.'/web/categories.php';

require_once __DIR__.'/web/errors.php';

require_once __DIR__.'/web/profile.php';

require_once __DIR__.'/web/tags.php';

/**
 * This routes needs to be define at the end of the routes file to prevent
 * conflicts because the argument try to find any post with the slug written in
 * the url.
 */
require_once __DIR__.'/web/pages.php';
