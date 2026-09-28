<?php
/**
 * includes/header.php — En-tête de navigation complet.
 * Architecture modulaire sans framework.
 *
 * Contient :
 * 1. Barre de progression de lecture (top 0, 2px, composited scaleX)
 * 2. Header sticky adaptatif (top vs scrolled)
 * 3. Logo monogramme "SD" vectoriel (clay morphing)
 * 4. Navigation desktop (soulignement SVG + pastille FLIP)
 * 5. Actions (basculeur de thème morphing + bouton hamburger)
 * 6. Overlay menu mobile étendu (fan-out circulaire)
 * 7. Bottom tab bar mobile fixe (navigation rapide à 4 onglets)
 */
?>

<!-- 1. Barre de progression de lecture -->
<div id="reading-progress"
     class="reading-progress"
     role="progressbar"
     aria-label="Progression de lecture"
     aria-valuenow="0"
     aria-valuemin="0"
     aria-valuemax="100"></div>

<!-- 2. Header sticky principal -->
<header id="site-header" class="site-header">
  <div class="site-header__container">

    <!-- Logo monogramme vectoriel "SD" -->
    <a href="<?= url('') ?>" class="site-logo" aria-label="Semakuba David — Retour à l'accueil">
      <svg class="logo-svg" width="40" height="40" viewBox="0 0 48 48" aria-hidden="true">
        <defs>
          <linearGradient id="logoClayH" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="oklch(0.78 0.14 45)"/>
            <stop offset="100%" stop-color="oklch(0.62 0.14 45)"/>
          </linearGradient>
        </defs>
        <rect width="48" height="48" rx="14" fill="url(#logoClayH)"/>
        <path d="M 17 16.5 C 17 14.8, 18.4 13.6, 20.4 13.6 C 22.2 13.6, 23.4 14.4, 23.4 15.6 L 21.2 15.6 C 21.2 15.0, 20.9 14.8, 20.4 14.8 C 19.8 14.8, 19.4 15.1, 19.4 15.8 C 19.4 17.5, 23.6 17.4, 23.6 20.4 C 23.6 22.5, 22.0 23.6, 20.2 23.6 C 18.0 23.6, 16.6 22.5, 16.6 20.8 L 18.8 20.8 C 18.8 21.6, 19.3 22.1, 20.2 22.1 C 21.0 22.1, 21.4 21.7, 21.4 21.0 C 21.4 19.2, 17.0 19.4, 17.0 16.5 Z" fill="oklch(0.985 0.006 45)"/>
        <path d="M 25 13.8 L 28.4 13.8 C 31.4 13.8, 32.6 15.6, 32.6 18.6 C 32.6 21.6, 31.4 23.4, 28.4 23.4 L 25 23.4 Z M 27.2 15.4 L 27.2 21.8 L 28.2 21.8 C 29.8 21.8, 30.4 20.8, 30.4 18.6 C 30.4 16.4, 29.8 15.4, 28.2 15.4 Z" fill="oklch(0.985 0.006 45)"/>
      </svg>
      
    </a>

    <!-- Navigation Desktop (≥ 1024px) -->
    <nav class="nav-desktop" aria-label="Navigation principale">
      <div class="nav-desktop__track">
        <span class="nav-desktop__indicator" aria-hidden="true"></span>
        <ul class="nav-desktop__list">
          <li class="nav-desktop__item">
            <a href="#hero" class="nav-desktop__link" data-section="hero" aria-current="section">
              <span class="nav-desktop__text">Accueil</span>
              <svg class="nav-desktop__underline" viewBox="0 0 100 2" preserveAspectRatio="none" aria-hidden="true">
                <line x1="0" y1="1" x2="100" y2="1" />
              </svg>
            </a>
          </li>
          <li class="nav-desktop__item">
            <a href="#projets" class="nav-desktop__link" data-section="projets">
              <span class="nav-desktop__text">Projets</span>
              <svg class="nav-desktop__underline" viewBox="0 0 100 2" preserveAspectRatio="none" aria-hidden="true">
                <line x1="0" y1="1" x2="100" y2="1" />
              </svg>
            </a>
          </li>
          <li class="nav-desktop__item">
            <a href="#competences" class="nav-desktop__link" data-section="competences">
              <span class="nav-desktop__text">Compétences</span>
              <svg class="nav-desktop__underline" viewBox="0 0 100 2" preserveAspectRatio="none" aria-hidden="true">
                <line x1="0" y1="1" x2="100" y2="1" />
              </svg>
            </a>
          </li>
          <li class="nav-desktop__item">
            <a href="#a-propos" class="nav-desktop__link" data-section="a-propos">
              <span class="nav-desktop__text">À propos</span>
              <svg class="nav-desktop__underline" viewBox="0 0 100 2" preserveAspectRatio="none" aria-hidden="true">
                <line x1="0" y1="1" x2="100" y2="1" />
              </svg>
            </a>
          </li>
          <li class="nav-desktop__item">
            <a href="#contact" class="nav-desktop__link" data-section="contact">
              <span class="nav-desktop__text">Contact</span>
              <svg class="nav-desktop__underline" viewBox="0 0 100 2" preserveAspectRatio="none" aria-hidden="true">
                <line x1="0" y1="1" x2="100" y2="1" />
              </svg>
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Actions header (Thème + Hamburger) -->
    <div class="header-actions">
      <!-- Basculeur de thème avec morphing SVG -->
      <button type="button"
              id="theme-toggle"
              class="header-btn theme-toggle"
              aria-label="Passer au thème sombre"
              aria-pressed="false">
        <svg class="theme-icon" viewBox="0 0 24 24" width="22" height="22" aria-hidden="true">
          <mask id="theme-toggle-mask">
            <rect x="0" y="0" width="24" height="24" fill="#ffffff" />
            <circle class="theme-icon__mask-cut" cx="24" cy="4" r="6" fill="#000000" />
          </mask>
          <circle class="theme-icon__sun-body" cx="12" cy="12" r="5" fill="currentColor" mask="url(#theme-toggle-mask)" />
          <g class="theme-icon__rays" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <line x1="12" y1="1.5" x2="12" y2="3.8" />
            <line x1="12" y1="20.2" x2="12" y2="22.5" />
            <line x1="4.57" y1="4.57" x2="6.2" y2="6.2" />
            <line x1="17.8" y1="17.8" x2="19.43" y2="19.43" />
            <line x1="1.5" y1="12" x2="3.8" y2="12" />
            <line x1="20.2" y1="12" x2="22.5" y2="12" />
            <line x1="4.57" y1="19.43" x2="6.2" y2="17.8" />
            <line x1="17.8" y1="6.2" x2="19.43" y2="4.57" />
          </g>
        </svg>
      </button>

      <!-- Hamburger mobile secondaire pour navigation étendue (< 1024px) -->
      <button type="button"
              id="hamburger-btn"
              class="header-btn hamburger-btn"
              aria-label="Ouvrir le menu"
              aria-expanded="false"
              aria-controls="mobile-drawer">
        <span class="hamburger-box" aria-hidden="true">
          <span class="hamburger-bar hamburger-bar--1"></span>
          <span class="hamburger-bar hamburger-bar--2"></span>
          <span class="hamburger-bar hamburger-bar--3"></span>
        </span>
      </button>
    </div>

  </div>
</header>

<!-- 3. Tiroir latéral (Drawer) & Scrim mobile -->
<div id="drawer-scrim" class="drawer-scrim" aria-hidden="true"></div>

<aside id="mobile-drawer"
       class="drawer"
       role="dialog"
       aria-modal="true"
       aria-label="Menu de navigation"
       aria-hidden="true">
  <!-- En-tête du tiroir : logo + bouton fermer -->
  <div class="drawer__header">
    <a href="<?= url('') ?>" class="site-logo drawer__logo" aria-label="Semakuba David — Accueil">
      <svg class="logo-svg" width="36" height="36" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <rect width="40" height="40" rx="12" fill="url(#logo-clay-fill)" />
        <rect x="1" y="1" width="38" height="38" rx="11" fill="none" stroke="url(#logo-clay-sheen)" stroke-width="1.5" />
        <path class="logo-glyph"
              d="M 18.5 15.5 C 17 14 13.5 13.5 13 16.5 C 12.5 19.5 18 19 18 22 C 18 24.5 15 25.5 13 24.5"
              stroke="var(--color-bg-surface)"
              stroke-width="2.8"
              stroke-linecap="round"
              stroke-linejoin="round"
              fill="none" />
        <path class="logo-glyph"
              d="M 23.5 14.5 V 25.5 M 23.5 14.5 H 26 C 29.5 14.5 30.5 17 30.5 20 C 30.5 23 29.5 25.5 26 25.5 H 23.5"
              stroke="var(--color-bg-surface)"
              stroke-width="2.8"
              stroke-linecap="round"
              stroke-linejoin="round"
              fill="none" />
      </svg>
    </a>
    <button type="button"
            id="drawer-close-btn"
            class="header-btn drawer__close"
            aria-label="Fermer le menu">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
      </svg>
    </button>
  </div>

  <!-- Navigation principale du tiroir -->
  <nav class="drawer__nav" aria-label="Navigation du tiroir">
    <ul class="drawer__list">
      <li class="drawer__item" style="--item-i: 0;">
        <a href="#hero" class="drawer__link" data-section="hero">
          <span>Accueil</span>
        </a>
      </li>
      <li class="drawer__item" style="--item-i: 1;">
        <a href="#projets" class="drawer__link" data-section="projets">
          <span>Projets</span>
        </a>
      </li>
      <li class="drawer__item" style="--item-i: 2;">
        <a href="#competences" class="drawer__link" data-section="competences">
          <span>Compétences</span>
        </a>
      </li>
      <li class="drawer__item" style="--item-i: 3;">
        <a href="#a-propos" class="drawer__link" data-section="a-propos">
          <span>À propos</span>
        </a>
      </li>
      <li class="drawer__item" style="--item-i: 4;">
        <a href="#contact" class="drawer__link" data-section="contact">
          <span>Contact</span>
        </a>
      </li>
    </ul>
  </nav>

  <!-- Pied du tiroir : actions et liens externes -->
  <div class="drawer__footer">
    <a href="<?= url('assets/cv/semakuba-david-cv.pdf') ?>"
       class="drawer__action-btn"
       target="_blank"
       rel="noopener noreferrer"
       style="--item-i: 5;">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
        <polyline points="7 10 12 15 17 10"></polyline>
        <line x1="12" y1="15" x2="12" y2="3"></line>
      </svg>
      <span>Télécharger le CV</span>
    </a>
    <a href="https://github.com/Semakuba"
       class="drawer__action-btn drawer__action-btn--secondary"
       target="_blank"
       rel="noopener noreferrer"
       style="--item-i: 6;">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
        <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
      </svg>
      <span>GitHub</span>
    </a>
  </div>
</aside>

<!-- 4. Bottom tab bar mobile (< 1024px) -->
<nav id="bottom-tab-bar" class="bottom-tab-bar" aria-label="Navigation rapide mobile">
  <div class="bottom-tab-bar__container">

    <a href="#hero" class="bottom-tab-bar__item" data-section="hero" aria-current="page">
      <svg class="bottom-tab-bar__icon" viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M3 10.5L12 3l9 7.5v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-9z" />
        <polyline points="9 21 9 12 15 12 15 21" />
      </svg>
      <span class="bottom-tab-bar__label">Accueil</span>
    </a>

    <a href="#projets" class="bottom-tab-bar__item" data-section="projets">
      <svg class="bottom-tab-bar__icon" viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <rect x="3" y="3" width="7" height="7" rx="1.5" />
        <rect x="14" y="3" width="7" height="7" rx="1.5" />
        <rect x="14" y="14" width="7" height="7" rx="1.5" />
        <rect x="3" y="14" width="7" height="7" rx="1.5" />
      </svg>
      <span class="bottom-tab-bar__label">Projets</span>
    </a>

    <a href="#competences" class="bottom-tab-bar__item" data-section="competences">
      <svg class="bottom-tab-bar__icon" viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <polyline points="16 18 22 12 16 6" />
        <polyline points="8 6 2 12 8 18" />
        <line x1="14" y1="4" x2="10" y2="20" />
      </svg>
      <span class="bottom-tab-bar__label">Compétences</span>
    </a>

    <a href="#contact" class="bottom-tab-bar__item" data-section="contact">
      <svg class="bottom-tab-bar__icon" viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
        <polyline points="22,6 12,13 2,6" />
      </svg>
      <span class="bottom-tab-bar__label">Contact</span>
    </a>

  </div>
</nav>
