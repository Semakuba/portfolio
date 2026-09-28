<?php
/**
 * includes/hero.php — Section Hero (Phase 2).
 * Esthétique 3D Claymation : surfaces mates, formes douces, ombres diffuses.
 */
?>

<!-- Curseur personnalisé (Desktop ≥ 1024px) -->
<div id="custom-cursor" class="custom-cursor" aria-hidden="true"></div>

<!-- Section Hero principale -->
<section id="hero" class="hero" aria-labelledby="hero-title">

  <!-- Fond avec gradient mesh animé (3 taches OKLCH déphasées) -->
  <div class="hero__mesh" aria-hidden="true">
    <span class="hero__mesh-spot hero__mesh-spot--1"></span>
    <span class="hero__mesh-spot hero__mesh-spot--2"></span>
    <span class="hero__mesh-spot hero__mesh-spot--3"></span>
  </div>

  <div class="container hero__container">
    <!-- 1. Eyebrow -->
    <p class="hero__eyebrow">Développeur Web &amp; Applications</p>

    <!-- 2. Titre principal (SplitText animé) -->
    <h1 id="hero-title" class="hero__title">Je construis des systèmes complets, du backend jusqu'au matériel.</h1>

    <!-- 3. Sous-titre -->
    <p class="hero__subtitle">
        Développeur full-stack, actuellement en Licence 3 Informatique.
        Je travaille du schéma de base de données au rendu final, en
        passant par le backend, les applications mobiles, desktop,
        et l'intégration matérielle quand le projet l'exige
    </p>

    <!-- 4. Boutons d'action claymation -->
    <div class="hero__actions">
      <a href="#projets" class="hero__btn hero__btn--primary">
        <span>Explorer mes projets</span>
      </a>
      <a href="<?= url('assets/cv/semakuba-david-cv.pdf') ?>"
         class="hero__btn hero__btn--ghost"
         target="_blank"
         rel="noopener noreferrer">
        <span>Télécharger mon CV</span>
      </a>
    </div>
  </div>

  <!-- 5. Indicateur de scroll (chevron animé) -->
  <div id="hero-scroll-indicator" class="hero__scroll" aria-hidden="true">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <polyline points="6 9 12 15 18 9"></polyline>
    </svg>
  </div>

</section>

<!-- Bibliothèque GSAP 3 pour l'animation fine et le curseur fluide -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
