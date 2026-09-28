<?php
/**
 * includes/skills.php — Section Compétences (Phase 4).
 * Bento Grid asymétrique Claymation avec démonstrations interactives.
 * Accessible, responsive, et optimisée pour GSAP + ScrollTrigger.
 */
?>
<section id="competences" class="skills section section--muted" aria-labelledby="competences-title">
  <div class="container">
    <header class="section-header skills__header">
      <span class="section-label">Compétences</span>
      <h2 id="competences-title" class="section-title">Outils et technologies maîtrisés.</h2>
      <p class="section-description">Stack utilisée en production sur des projets livrés.</p>
    </header>

    <div class="skills__grid">
      <!-- Zone 1 — Développement web (large, 2 colonnes) -->
      <article class="skill-zone skill-zone--web" data-zone="web">
        <div class="skill-zone__top">
          <div class="skill-zone__icon-wrap">
            <svg class="skill-zone__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <polyline points="16 18 22 12 16 6"></polyline>
              <polyline points="8 6 2 12 8 18"></polyline>
            </svg>
          </div>
          <span class="skill-zone__count" aria-hidden="true" data-target="5">00</span>
        </div>
        <h3 class="skill-zone__title">Développement web</h3>
        <ul class="skill-zone__list">
          <li class="skill-zone__item"><span class="skill-zone__item-text">HTML5</span></li>
          <li class="skill-zone__item"><span class="skill-zone__item-text">CSS3</span></li>
          <li class="skill-zone__item"><span class="skill-zone__item-text">PHP</span></li>
          <li class="skill-zone__item"><span class="skill-zone__item-text">JavaScript</span></li>
          <li class="skill-zone__item"><span class="skill-zone__item-text">SVG natif</span></li>
        </ul>
      </article>

      <!-- Zone 2 — Backend & données (haute, 1 colonne × 2 rangées) -->
      <article class="skill-zone skill-zone--backend" data-zone="backend">
        <div class="skill-zone__top">
          <div class="skill-zone__icon-wrap">
            <svg class="skill-zone__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
              <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
              <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
            </svg>
          </div>
          <span class="skill-zone__count" aria-hidden="true" data-target="7">00</span>
        </div>
        <h3 class="skill-zone__title">Backend & données</h3>
        <ul class="skill-zone__list">
          <li class="skill-zone__item"><span class="skill-zone__item-text">Java</span></li>
          <li class="skill-zone__item"><span class="skill-zone__item-text">Spring Boot</span></li>
          <li class="skill-zone__item"><span class="skill-zone__item-text">MySQL</span></li>
          <li class="skill-zone__item"><span class="skill-zone__item-text">PostgreSQL</span></li>
          <li class="skill-zone__item"><span class="skill-zone__item-text">SQLite</span></li>
          <li class="skill-zone__item"><span class="skill-zone__item-text">Microsoft Access</span></li>
          <li class="skill-zone__item"><span class="skill-zone__item-text">SQL Server</span></li>
        </ul>
      </article>

      <!-- Zone 3 — Mobile & desktop (normale) -->
      <article class="skill-zone skill-zone--mobile" data-zone="mobile">
        <div class="skill-zone__top">
          <div class="skill-zone__icon-wrap">
            <svg class="skill-zone__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
              <line x1="8" y1="21" x2="16" y2="21"></line>
              <line x1="12" y1="17" x2="12" y2="21"></line>
            </svg>
          </div>
          <span class="skill-zone__count" aria-hidden="true" data-target="6">00</span>
        </div>
        <h3 class="skill-zone__title">Mobile & desktop</h3>
        <ul class="skill-zone__list">
          <li class="skill-zone__item"><span class="skill-zone__item-text">Kotlin</span></li>
          <li class="skill-zone__item"><span class="skill-zone__item-text">Jetpack Compose</span></li>
          <li class="skill-zone__item"><span class="skill-zone__item-text">Ktor Client</span></li>
          <li class="skill-zone__item"><span class="skill-zone__item-text">MediaStore</span></li>
          <li class="skill-zone__item"><span class="skill-zone__item-text">WorkManager</span></li>
          <li class="skill-zone__item"><span class="skill-zone__item-text">Electron</span></li>
        </ul>
      </article>

      <!-- Zone 4 — Système & outillage (normale) -->
      <article class="skill-zone skill-zone--tools" data-zone="tools">
        <div class="skill-zone__top">
          <div class="skill-zone__icon-wrap">
            <svg class="skill-zone__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <polyline points="4 17 10 11 4 5"></polyline>
              <line x1="12" y1="19" x2="20" y2="19"></line>
            </svg>
          </div>
          <span class="skill-zone__count" aria-hidden="true" data-target="7">00</span>
        </div>
        <h3 class="skill-zone__title">Système & outillage</h3>
        <ul class="skill-zone__list">
          <li class="skill-zone__item"><span class="skill-zone__item-text">Android avancé (Magisk, LSPosed, ROM custom)</span></li>
          <li class="skill-zone__item"><span class="skill-zone__item-text">Termux</span></li>
          <li class="skill-zone__item"><span class="skill-zone__item-text">Git</span></li>
          <li class="skill-zone__item"><span class="skill-zone__item-text">VS Code</span></li>
          <li class="skill-zone__item"><span class="skill-zone__item-text">Cursor</span></li>
          <li class="skill-zone__item"><span class="skill-zone__item-text">Puppeteer</span></li>
          <li class="skill-zone__item"><span class="skill-zone__item-text">Adobe Photoshop</span></li>
        </ul>
      </article>
    </div>
  </div>
</section>
