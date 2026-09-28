<?php
/**
 * projets/_layout.php — Template partagé pour les pages de détail de projet.
 * Reçoit les données du projet courant et des projets adjacent (boucle circulaire).
 */

function render_project_page(array $project, array $prev, array $next): void {
    $theme = get_theme();
    $seo   = [
        'title'       => $project['title'] . ' — ' . IDENTITY['name_display'],
        'description' => $project['summary'],
        'canonical'   => absolute_url('projets/' . $project['slug']),
        'og_image'    => absolute_url('assets/svg/projects/' . $project['slug'] . '.svg'),
    ];
    ?>
    <!doctype html>
    <html lang="fr" data-theme="<?= e($theme) ?>">
    <?php partial('head', ['seo' => $seo]) ?>
    <body class="page-project-detail">
    <?php partial('header') ?>

    <main id="main-content" class="project-detail">
      <article class="project-detail__article container">

        <!-- 1. Fil d'Ariane discret en haut -->
        <nav class="project-detail__breadcrumb" aria-label="Fil d'Ariane">
          <a href="<?= url('projets', true) ?>" class="project-detail__back-link">
            <span class="project-detail__back-arrow" aria-hidden="true">&larr;</span>
            <span>Retour aux projets</span>
          </a>
        </nav>

        <!-- 2. Hero secondaire -->
        <header class="project-detail__hero">
          <span class="project-detail__category"><?= e($project['category']) ?></span>
          <h1 class="project-detail__title"><?= e($project['title']) ?></h1>
          <p class="project-detail__subtitle"><?= e($project['summary']) ?></p>

          <!-- Liste de tags (stack) -->
          <ul class="project-detail__tags" aria-label="Technologies utilisées">
            <?php foreach ($project['stack'] as $tech): ?>
              <li class="project-detail__tag"><?= e($tech) ?></li>
            <?php endforeach; ?>
          </ul>

          <!-- Bloc de statut source -->
          <div class="project-detail__source-status">
            <span class="project-detail__status-dot project-detail__status-dot--<?= e($project['source_status']) ?>" aria-hidden="true"></span>
            <span class="project-detail__source-note"><?= e($project['source_note']) ?></span>
          </div>
        </header>

        <!-- Corps de l'article -->
        <div class="project-detail__body">

          <!-- 3. Section Contexte -->
          <section class="project-detail__section" aria-labelledby="section-contexte-title">
            <h2 id="section-contexte-title" class="project-detail__section-title">Contexte</h2>
            <div class="project-detail__prose">
              <?php foreach ((array)$project['context'] as $paragraph): ?>
                <p><?= e($paragraph) ?></p>
              <?php endforeach; ?>
            </div>
          </section>

          <!-- 4. Section Solution -->
          <section class="project-detail__section" aria-labelledby="section-solution-title">
            <h2 id="section-solution-title" class="project-detail__section-title">Solution</h2>
            <div class="project-detail__prose">
              <?php foreach ((array)$project['solution'] as $paragraph): ?>
                <p><?= e($paragraph) ?></p>
              <?php endforeach; ?>
            </div>
          </section>

          <!-- 5. Section Défi technique -->
          <section class="project-detail__section" aria-labelledby="section-defi-title">
            <h2 id="section-defi-title" class="project-detail__section-title">Défi technique</h2>
            <div class="project-detail__challenge-box">
              <p><?= e($project['challenge']) ?></p>
            </div>
          </section>

          <!-- 6. Section Galerie (3 blocs placeholders 16:10) -->
          <section class="project-detail__section project-detail__section--gallery" aria-labelledby="section-galerie-title">
            <h2 id="section-galerie-title" class="project-detail__section-title">Galerie</h2>
            <div class="project-detail__gallery-grid">
              <div class="project-detail__placeholder-media" aria-hidden="true">
                <span class="project-detail__placeholder-text">Capture d'écran à venir</span>
              </div>
              <div class="project-detail__placeholder-media" aria-hidden="true">
                <span class="project-detail__placeholder-text">Capture d'écran à venir</span>
              </div>
              <div class="project-detail__placeholder-media project-detail__placeholder-media--wide" aria-hidden="true">
                <span class="project-detail__placeholder-text">Capture d'écran à venir</span>
              </div>
            </div>
          </section>

          <!-- 7. Section Démonstration vidéo (bloc 16:9 placeholder) -->
          <section class="project-detail__section" aria-labelledby="section-video-title">
            <h2 id="section-video-title" class="project-detail__section-title">Démonstration vidéo</h2>
            <div class="project-detail__video-wrapper" aria-hidden="true">
              <div class="project-detail__video-placeholder">
                <span class="project-detail__placeholder-text">Vidéo de démonstration à venir</span>
              </div>
            </div>
          </section>

          <!-- 8. Section Rôle & Résultats -->
          <section class="project-detail__section" aria-labelledby="section-role-title">
            <h2 id="section-role-title" class="project-detail__section-title">Rôle &amp; Résultats</h2>
            <div class="project-detail__prose">
              <p><strong>Rôle :</strong> <?= e($project['role']) ?></p>
              <p><?= e($project['result']) ?></p>
            </div>
          </section>

        </div>

      </article>

      <!-- 9. Navigation précédent / suivant (boucle circulaire) -->
      <nav class="project-detail__pagination container" aria-label="Navigation entre projets">
        <div class="project-detail__pagination-grid">

          <!-- Précédent -->
          <a href="<?= url('projets/' . e($prev['slug'])) ?>" class="project-detail__pagination-card project-detail__pagination-card--prev">
            <span class="project-detail__pagination-direction">
              <span class="project-detail__pagination-arrow" aria-hidden="true">&larr;</span>
              <span>Précédent</span>
            </span>
            <span class="project-detail__pagination-name"><?= e($prev['title']) ?></span>
          </a>

          <!-- Suivant -->
          <a href="<?= url('projets/' . e($next['slug'])) ?>" class="project-detail__pagination-card project-detail__pagination-card--next">
            <span class="project-detail__pagination-direction">
              <span>Suivant</span>
              <span class="project-detail__pagination-arrow" aria-hidden="true">&rarr;</span>
            </span>
            <span class="project-detail__pagination-name"><?= e($next['title']) ?></span>
          </a>

        </div>
      </nav>

    </main>

    <!-- Bibliothèques GSAP pour les animations ScrollTrigger -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js" defer></script>

    <?php partial('footer') ?>
    </body>
    </html>
    <?php
}
