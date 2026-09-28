<?php
/**
 * index.php — Point d'entrée principal du portfolio.
 * Assemble les partials. Aucun HTML autonome ici.
 */

require_once __DIR__ . '/config.php';

$theme    = get_theme();
$seo      = [
    'title'       => 'Semakuba David — Développeur Web & Applications | PHP, Java, Kotlin',
    'description' => 'Portfolio de Semakuba David, développeur full-stack. Conception de systèmes web, applications mobiles et outils desktop. Projets en PHP, Java, Kotlin.',
    'canonical'   => absolute_url('/'),
    'og_image'    => absolute_url('assets/svg/og-cover.svg'),
];
$projects = get_projects();
?>
<!doctype html>
<html lang="fr" data-theme="<?= e($theme) ?>">
<?php partial('head', ['seo' => $seo]) ?>
<body>
<?php partial('header') ?>
<main id="main-content">
  <?php partial('hero') ?>
  <?php partial('projects', ['projects' => $projects]) ?>
  <?php partial('skills') ?>
  <?php partial('about') ?>
  <?php partial('contact') ?>
</main>
<?php partial('footer') ?>
</body>
</html>
