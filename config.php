<?php
/**
 * config.php — Source unique de vérité pour le portfolio.
 * Chargé en premier par chaque point d'entrée PHP.
 */

declare(strict_types=1);

// ── Détection dynamique du chemin de base ──────────────────────────────────

$docRoot = rtrim(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT'] ?? ''), '/');
$appRoot = rtrim(str_replace('\\', '/', __DIR__), '/');

$basePath = '';
if ($docRoot !== '' && str_starts_with($appRoot, $docRoot)) {
    $basePath = substr($appRoot, strlen($docRoot));
    $basePath = '/' . trim($basePath, '/');
    if ($basePath === '/') $basePath = '';
}
define('BASE_PATH', $basePath);

function url(string $path = '', bool $directory = false): string {
    $url = BASE_PATH . '/' . ltrim($path, '/');
    if ($directory && !str_ends_with($url, '/')) {
        $url .= '/';
    }
    return $url;
}

function absolute_url(string $path = ''): string {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host   = $_SERVER['HTTP_HOST'] ?? 'semakuba.ct.ws';
    return $scheme . '://' . $host . url($path);
}

// ── Environnement ──────────────────────────────────────────────────────────

define('ENV', getenv('APP_ENV') ?: 'production');
define('DEBUG', ENV === 'development');

if (DEBUG) {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    error_reporting(0);
}

// ── Chemins absolus ────────────────────────────────────────────────────────

define('ROOT',       __DIR__);
define('INCLUDES',   ROOT . '/includes');
define('DATA_DIR',   ROOT . '/data');
define('ASSETS_URL', url('assets'));
define('BASE_URL',   BASE_PATH);

// ── Identité ───────────────────────────────────────────────────────────────

define('IDENTITY', [
    'name_display' => 'Semakuba David',
    'name_legal'   => 'Batumike Semakuba David',
    'title'        => 'Développeur Web & Applications',
    'email'        => 'semakubadavid931@gmail.com',
    'phone'        => '+243 980 709 291',
    'github_user'  => 'Semakuba',
    'github_url'   => 'https://github.com/Semakuba',
    'formation'    => 'Licence 3 Informatique (en cours)',
    'school'       => 'ISC Goma',
    'cv_url'       => url('assets/cv/semakuba-david-cv.pdf'),
]);

// ── Métadonnées SEO par défaut ─────────────────────────────────────────────

define('SEO_DEFAULT', [
    'title'       => 'Semakuba David — Développeur Web & Applications',
    'description' => 'Portfolio de Semakuba David, développeur full-stack '
                   . 'spécialisé en backend sécurisé, frontend soigné, '
                   . 'applications mobiles, desktop et intégration système.',
    'canonical'   => absolute_url('/'),
    'og_image'    => absolute_url('assets/img/og-cover.png'),
    'theme_color' => '#b06040',   // approximation HEX pour <meta> navigateur
]);

// ── Thème ──────────────────────────────────────────────────────────────────

/**
 * Détecte le thème préféré depuis le cookie (priorité)
 * ou retourne 'light' par défaut.
 */
function get_theme(): string {
    $allowed = ['light', 'dark'];
    $cookie  = $_COOKIE['theme'] ?? 'light';
    return in_array($cookie, $allowed, true) ? $cookie : 'light';
}

// ── Helpers ────────────────────────────────────────────────────────────────

/**
 * Échappe une chaîne pour une insertion HTML sûre.
 */
function e(string $str): string {
    return htmlspecialchars($str, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Génère un attribut src ou href avec chemin absolu asset.
 */
function asset(string $path): string {
    return ASSETS_URL . '/' . ltrim($path, '/');
}

/**
 * Inclut un partial depuis /includes/.
 * Lance une exception claire si le fichier est absent.
 */
function partial(string $name, array $vars = []): void {
    $file = INCLUDES . '/' . ltrim($name, '/') . '.php';
    if (!file_exists($file)) {
        if (DEBUG) {
            throw new RuntimeException("Partial introuvable : {$file}");
        }
        return;
    }
    extract($vars, EXTR_SKIP);
    require $file;
}

/**
 * Charge le tableau de projets depuis data/projects.php.
 * Met en cache dans une variable statique pour la requête.
 */
function get_projects(): array {
    static $projects = null;
    if ($projects === null) {
        $projects = require DATA_DIR . '/projects.php';
    }
    return $projects;
}

/**
 * Retourne un projet par son slug ou null si introuvable.
 */
function get_project(string $slug): ?array {
    foreach (get_projects() as $project) {
        if ($project['slug'] === $slug) {
            return $project;
        }
    }
    return null;
}

/**
 * Construit la balise <title> SEO complète.
 */
function page_title(string $suffix = ''): string {
    $base = SEO_DEFAULT['title'];
    return $suffix ? e($suffix) . ' — ' . e(IDENTITY['name_display']) : e($base);
}

// ── Session sécurisée (préparation future) ─────────────────────────────────

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'secure'   => isset($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    // session_start(); // décommenter si authentification ajoutée
}
