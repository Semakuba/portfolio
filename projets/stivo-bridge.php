<?php
/**
 * projets/stivo-bridge.php — Page détail STIVO Bridge.
 */

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/_layout.php';

$allProjects = get_projects();
$slug = 'stivo-bridge';
$current = null;
$prev = null;
$next = null;

foreach ($allProjects as $i => $p) {
    if ($p['slug'] === $slug) {
        $current = $p;
        $count = count($allProjects);
        $prev = $allProjects[($i - 1 + $count) % $count];
        $next = $allProjects[($i + 1) % $count];
        break;
    }
}

if (!$current) {
    http_response_code(404);
    exit;
}

render_project_page($current, $prev, $next);
