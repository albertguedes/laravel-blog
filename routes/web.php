<?php declare(strict_types=1);

require __DIR__.'/web/auth.php';

require __DIR__.'/web/authors.php';

require __DIR__.'/web/categories.php';

require __DIR__.'/web/profile.php';

require __DIR__.'/web/tags.php';

// Pages need to be loaded last to avoid conflicts with other routes.
require __DIR__.'/web/pages.php';
