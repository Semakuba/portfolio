<?php
/**
 * projets/index.php — Page Archive des projets.
 * Liste l'intégralité des systèmes, applications et extensions réalisés.
 */

require_once __DIR__ . '/../config.php';

$theme    = get_theme();
$seo      = [
    'title'       => 'Projets — Semakuba David',
    'description' => 'Tous les projets de Semakuba David : systèmes de gestion, extensions navigateur, applications mobiles et desktop.',
    'canonical'   => absolute_url('projets/'),
];
$projects = get_projects();
?>
<!doctype html>
<html lang="fr" data-theme="<?= e($theme) ?>">
<?php partial('head', ['seo' => $seo]) ?>
<body>
<?php partial('header') ?>

<main id="main-content">
  <section class="projects-archive section" aria-labelledby="archive-title">
    <div class="container">

      <!-- En-tête de l'archive -->
      <header class="section-header projects-archive__header">
        <span class="section-label">Archive</span>
        <h1 id="archive-title" class="section-title">Tous les projets</h1>
        <p class="section-description">Systèmes, applications et extensions.</p>
      </header>

      <!-- Grille des projets -->
      <ul class="projects__grid">
        <?php foreach ($projects as $project): ?>
          <li class="project-card">
            <a href="<?= url('projets/' . e($project['slug'])) ?>"
               class="project-card__link"
               aria-label="Voir le projet <?= e($project['title']) ?> : <?= e($project['category']) ?>">

              <!-- 1. Zone média (ratio 16:10, placeholder SVG, overlay gradient) -->
              <div class="project-card__media-wrapper">
                <div class="project-card__media">
                  <img src="<?= url('assets/svg/projects/' . e($project['slug']) . '.svg') ?>"
                       alt="Aperçu schématique du système <?= e($project['title']) ?>"
                       class="project-card__image"
                       width="800"
                       height="500"
                       loading="lazy"
                       decoding="async">
                </div>
                <div class="project-card__overlay" aria-hidden="true"></div>
              </div>

              <!-- Contenu de la carte -->
              <div class="project-card__content">
                <!-- 2. Catégorie -->
                <span class="project-card__category"><?= e($project['category']) ?></span>

                <!-- 3. Titre et flèche interactive -->
                <div class="project-card__title-row">
                  <h3 class="project-card__title"><?= e($project['title']) ?></h3>
                  <span class="project-card__arrow" aria-hidden="true">→</span>
                </div>

                <!-- 4. Résumé court (2-3 lignes) -->
                <p class="project-card__summary"><?= e($project['summary']) ?></p>

                <!-- 5. Liste de tags technologiques (pills) -->
                <ul class="project-card__tags" aria-label="Technologies utilisées">
                  <?php foreach ($project['stack'] as $tech): ?>
                    <li class="project-card__tag"><?= e($tech) ?></li>
                  <?php endforeach; ?>
                </ul>

                <!-- 6. Statut du projet (séparateur supérieur) -->
                <div class="project-card__status">
                  <span class="project-card__status-dot project-card__status-dot--<?= e($project['status_type'] ?? 'live') ?>" aria-hidden="true"></span>
                  <span class="project-card__status-text"><?= e($project['status']) ?></span>
                </div>
              </div>

            </a>
          </li>
        <?php endforeach; ?>
      </ul>

    </div>
  </section>
</main>

<!-- Bibliothèques GSAP pour les animations ScrollTrigger -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js" defer></script>

<?php partial('footer') ?>
</body>
</html>
