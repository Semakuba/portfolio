<?php
/**
 * includes/head.php — <head> HTML commun.
 * Reçoit : $seo (array avec title, description, canonical, og_image)
 */

$ogImage = $seo['og_image'] ?? SEO_DEFAULT['og_image'];
if (($ogImage === url('assets/img/og-cover.png') || $ogImage === absolute_url('assets/img/og-cover.png') || empty($ogImage)) && !file_exists(ROOT . '/assets/img/og-cover.png')) {
    $ogImage = absolute_url('assets/svg/og-cover.svg');
}
if (!str_starts_with($ogImage, 'http://') && !str_starts_with($ogImage, 'https://')) {
    $ogImage = absolute_url($ogImage);
}

$canonicalUrl = $seo['canonical'] ?? absolute_url('/');
if (!str_starts_with($canonicalUrl, 'http://') && !str_starts_with($canonicalUrl, 'https://')) {
    $canonicalUrl = absolute_url($canonicalUrl);
}
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- SEO -->
  <title><?= e($seo['title'] ?? SEO_DEFAULT['title']) ?></title>
  <meta name="description" content="<?= e($seo['description'] ?? SEO_DEFAULT['description']) ?>">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?= e($seo['canonical'] ?? absolute_url('/')) ?>">

  <!-- Open Graph -->
  <meta property="og:type"        content="website">
  <meta property="og:title"       content="<?= e($seo['title'] ?? SEO_DEFAULT['title']) ?>">
  <meta property="og:description" content="<?= e($seo['description'] ?? SEO_DEFAULT['description']) ?>">
  <meta property="og:image"       content="<?= e($ogImage) ?>">
  <meta property="og:url"         content="<?= e($seo['canonical'] ?? absolute_url('/')) ?>">

  <!-- Twitter Card -->
  <meta name="twitter:card"        content="summary_large_image">
  <meta name="twitter:title"       content="<?= e($seo['title'] ?? SEO_DEFAULT['title']) ?>">
  <meta name="twitter:description" content="<?= e($seo['description'] ?? SEO_DEFAULT['description']) ?>">
  <meta name="twitter:image"       content="<?= e($ogImage) ?>">

  <!-- Favicon & Thème navigateur -->
  <link rel="icon" type="image/svg+xml" href="<?= url('assets/favicon.svg') ?>">
  <link rel="apple-touch-icon" href="<?= url('assets/favicon.svg') ?>">
  <meta name="theme-color" content="#b85632">

  <!-- Prechargement des ressources critiques (Fonts & Image LCP) -->
  <link rel="preload"
        href="https://fonts.gstatic.com/s/inter/v20/UcC73FwrK3iLTeHuS_nVMrMxCp50SjIa1ZL7.woff2"
        as="font"
        type="font/woff2"
        crossorigin>
  <link rel="preload"
        href="<?= url('assets/img/david-portrait.webp') ?>"
        as="image"
        fetchpriority="high">

  <!-- CSS : ordre de cascade strict -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@400;500;600;700&display=swap">
  <link rel="stylesheet" href="<?= url('assets/css/tokens.css') ?>">
  <link rel="stylesheet" href="<?= url('assets/css/base.css') ?>">
  <link rel="stylesheet" href="<?= url('assets/css/components.css') ?>">
  <link rel="stylesheet" href="<?= url('assets/css/animations.css') ?>">

  <!-- Thème initial sans FOUC : 1. localStorage > 2. prefers-color-scheme > 3. fallback light -->
  <script>
    (function () {
      var saved = null;
      try {
        saved = localStorage.getItem('theme-preference');
      } catch (_) {}
      if (saved === 'dark' || saved === 'light') {
        document.documentElement.setAttribute('data-theme', saved);
      } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        document.documentElement.setAttribute('data-theme', 'dark');
      } else {
        document.documentElement.setAttribute('data-theme', 'light');
      }
    })();
  </script>
</head>
