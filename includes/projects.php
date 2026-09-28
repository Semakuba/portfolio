<?php
/**
 * includes/projects.php — Section Projets (Phase 3.A).
 * Grille de 4 projets réels avec cartes interactives, placeholders SVG 16:10 et micro-interactions.
 */

$allProjects = get_projects();
$projects    = array_filter($allProjects, fn($p) => !empty($p['featured']));
$projects    = array_slice($projects, 0, 6);
?>

<section id="projets" class="projects section" aria-labelledby="projets-title">
  <div class="container">

    <!-- En-tête de la section -->
    <header class="section-header projects__header">
      <span class="section-label">Projets</span>
      <h2 id="projets-title" class="section-title">Quatre systèmes livrés ou fonctionnels.</h2>
      <p class="section-description">Démonstrations disponibles sur demande.</p>
    </header>

    <!-- Grille des 4 projets -->
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

    <!-- Lien vers l'archive complète des projets -->
    <div class="projects__footer">
      <a href="<?= url('projets', true) ?>" class="projects__all-link">
        <span>Voir tous les projets &rarr;</span>
        <svg class="projects__all-link-underline" viewBox="0 0 100 2" preserveAspectRatio="none" aria-hidden="true">
          <line x1="0" y1="1" x2="100" y2="1" />
        </svg>
      </a>
    </div>

  </div>
</section>

<!-- Bibliothèque GSAP ScrollTrigger pour l'animation au scroll -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js" defer></script>
