<?php
/**
 * includes/footer.php — Phase 7 : Footer minimal.
 * © + lien retour haut de page. Aucune mention géographique.
 * Script principal différé chargé ici.
 */
?>
<footer class="site-footer">
  <div class="container">
    <div class="site-footer__inner">
      <a href="<?= url('') ?>" class="footer-logo" aria-label="Semakuba David — Accueil">
        <img src="<?= url('assets/favicon.svg') ?>" alt="" width="28" height="28" aria-hidden="true">
      </a>
      <p class="site-footer__copy">© <?= date('Y') ?> Semakuba David</p>
      <a href="#hero"
         class="site-footer__back"
         aria-label="Retour en haut de la page">
        <span>Haut de page</span>
        <svg width="14" height="14" viewBox="0 0 24 24"
             aria-hidden="true" fill="none" stroke="currentColor"
             stroke-width="2" stroke-linecap="round"
             stroke-linejoin="round">
          <path d="M12 19V5M5 12l7-7 7 7"/>
        </svg>
      </a>
    </div>
  </div>
</footer>

<!-- Script principal unique (chargement différé) -->
<script src="<?= url('assets/js/main.js') ?>" defer></script>
