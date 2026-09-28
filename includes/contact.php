<?php
/**
 * includes/contact.php — Phase 6 : Section Contact (version premium).
 * Cartes bento avec effet glow suivant la souris.
 */
?>
<section id="contact" class="contact section section--muted"
         aria-labelledby="contact-title">
  <div class="container">

    <header class="contact__header">
      <span class="section-label">Contact</span>
      <h2 id="contact-title" class="contact__title">
        Travaillons ensemble.
      </h2>
      <p class="contact__subtitle">
        Ouvert aux projets, aux collaborations et aux
        opportunités techniques.
      </p>
    </header>

    <div class="contact__grid">

      <!-- Email : carte wide -->
      <article class="contact-card contact-card--wide">
        <div class="contact-card__glow" aria-hidden="true"></div>
        <a href="mailto:semakubadavid931@gmail.com"
           class="contact-card__link"
           aria-label="Envoyer un email à Semakuba David">
          <div class="contact-card__top">
            <span class="contact-card__icon" aria-hidden="true">
              <svg width="28" height="28" viewBox="0 0 24 24"
                   fill="none" stroke="currentColor" stroke-width="1.6"
                   stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 6h16v12H4z"/>
                <path d="m4 7 8 6 8-6"/>
              </svg>
            </span>
            <span class="contact-card__arrow" aria-hidden="true">
              <svg width="16" height="16" viewBox="0 0 24 24"
                   fill="none" stroke="currentColor" stroke-width="2"
                   stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14M12 5l7 7-7 7"/>
              </svg>
            </span>
          </div>
          <div class="contact-card__body">
            <span class="contact-card__label">Email</span>
            <span class="contact-card__value">semakubadavid931@gmail.com</span>
          </div>
        </a>
        <button type="button"
                class="contact-card__copy"
                data-copy="semakubadavid931@gmail.com"
                aria-label="Copier l'adresse email">
          <svg width="14" height="14" viewBox="0 0 24 24"
               fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round"
               aria-hidden="true">
            <rect x="9" y="9" width="13" height="13" rx="2"/>
            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/>
          </svg>
        </button>
      </article>

      <!-- Téléphone : carte wide -->
      <article class="contact-card contact-card--wide">
        <div class="contact-card__glow" aria-hidden="true"></div>
        <a href="tel:+243980709291"
           class="contact-card__link"
           aria-label="Appeler Semakuba David">
          <div class="contact-card__top">
            <span class="contact-card__icon" aria-hidden="true">
              <svg width="28" height="28" viewBox="0 0 24 24"
                   fill="none" stroke="currentColor" stroke-width="1.6"
                   stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
              </svg>
            </span>
            <span class="contact-card__arrow" aria-hidden="true">
              <svg width="16" height="16" viewBox="0 0 24 24"
                   fill="none" stroke="currentColor" stroke-width="2"
                   stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14M12 5l7 7-7 7"/>
              </svg>
            </span>
          </div>
          <div class="contact-card__body">
            <span class="contact-card__label">Téléphone</span>
            <span class="contact-card__value">+243 980 709 291</span>
          </div>
        </a>
        <button type="button"
                class="contact-card__copy"
                data-copy="+243980709291"
                aria-label="Copier le numéro de téléphone">
          <svg width="14" height="14" viewBox="0 0 24 24"
               fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round"
               aria-hidden="true">
            <rect x="9" y="9" width="13" height="13" rx="2"/>
            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/>
          </svg>
        </button>
      </article>

      <!-- GitHub : carte normale -->
      <article class="contact-card">
        <div class="contact-card__glow" aria-hidden="true"></div>
        <a href="https://github.com/Semakuba"
           class="contact-card__link"
           target="_blank"
           rel="noopener noreferrer"
           aria-label="Ouvrir le profil GitHub de Semakuba David">
          <div class="contact-card__top">
            <span class="contact-card__icon" aria-hidden="true">
              <svg width="28" height="28" viewBox="0 0 24 24"
                   fill="currentColor" aria-hidden="true">
                <path d="M12 .5C5.65.5.5 5.65.5 12c0 5.08 3.29 9.39 7.86 10.91.58.11.79-.25.79-.55 0-.27-.01-1.16-.02-2.11-3.2.7-3.87-1.36-3.87-1.36-.52-1.33-1.28-1.68-1.28-1.68-1.05-.72.08-.7.08-.7 1.16.08 1.77 1.19 1.77 1.19 1.03 1.76 2.7 1.25 3.36.96.1-.75.4-1.25.73-1.54-2.55-.29-5.23-1.28-5.23-5.69 0-1.26.45-2.29 1.19-3.1-.12-.29-.52-1.46.11-3.05 0 0 .97-.31 3.18 1.18.92-.26 1.91-.39 2.9-.39.99 0 1.98.13 2.9.39 2.21-1.49 3.18-1.18 3.18-1.18.63 1.59.23 2.76.11 3.05.74.81 1.19 1.84 1.19 3.1 0 4.42-2.69 5.39-5.25 5.68.41.35.78 1.05.78 2.12 0 1.53-.01 2.77-.01 3.15 0 .31.21.67.8.55C20.21 21.39 23.5 17.08 23.5 12 23.5 5.65 18.35.5 12 .5z"/>
              </svg>
            </span>
            <span class="contact-card__arrow contact-card__arrow--external" aria-hidden="true">
              <svg width="16" height="16" viewBox="0 0 24 24"
                   fill="none" stroke="currentColor" stroke-width="2"
                   stroke-linecap="round" stroke-linejoin="round">
                <path d="M7 17 17 7M8 7h9v9"/>
              </svg>
            </span>
          </div>
          <div class="contact-card__body">
            <span class="contact-card__label">GitHub</span>
            <span class="contact-card__value">github.com/Semakuba</span>
          </div>
        </a>
      </article>

      <!-- Localisation : carte passive -->
      <article class="contact-card contact-card--passive">
        <div class="contact-card__glow" aria-hidden="true"></div>
        <div class="contact-card__link" role="presentation">
          <div class="contact-card__top">
            <span class="contact-card__icon" aria-hidden="true">
              <svg width="28" height="28" viewBox="0 0 24 24"
                   fill="none" stroke="currentColor" stroke-width="1.6"
                   stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s7-7.58 7-12a7 7 0 1 0-14 0c0 4.42 7 12 7 12z"/>
                <circle cx="12" cy="10" r="3"/>
              </svg>
            </span>
          </div>
          <div class="contact-card__body">
            <span class="contact-card__label">Localisation</span>
            <span class="contact-card__value">République Démocratique du Congo</span>
          </div>
        </div>
      </article>

    </div>
  </div>
</section>

<!-- Toast de confirmation de copie -->
<div id="copy-toast"
     class="copy-toast"
     role="status"
     aria-live="polite"
     aria-atomic="true">
  Copié !
</div>
