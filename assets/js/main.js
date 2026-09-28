/**
 * main.js — Point d'entrée JavaScript unique (ES2022 strict).
 * Phase 1 : Logique Header, Progression, Navigation FLIP, Thème & Menu mobile.
 *
 * Règles :
 * - Aucun console.log en production.
 * - Scroll listeners passifs ({ passive: true }).
 * - RAF throttling systématique (aucun debounce sur le scroll).
 * - Aucune lecture de dimension non mise en cache dans les boucles de rendu.
 * - Bascule d'états par classes CSS.
 */

'use strict';

(() => {
  // ── 1. Sélecteurs DOM ───────────────────────────────────────────────────

  const docEl          = document.documentElement;
  const headerEl       = document.getElementById('site-header');
  const progressBar    = document.getElementById('reading-progress');
  const themeToggleBtn = document.getElementById('theme-toggle');
  const hamburgerBtn   = document.getElementById('hamburger-btn');
  const drawerEl       = document.getElementById('mobile-drawer');
  const scrimEl        = document.getElementById('drawer-scrim');
  const drawerCloseBtn = document.getElementById('drawer-close-btn');
  const bottomBarEl    = document.getElementById('bottom-tab-bar');

  // Navigation Desktop
  const navTrack     = document.querySelector('.nav-desktop__track');
  const navIndicator = document.querySelector('.nav-desktop__indicator');
  const desktopLinks = document.querySelectorAll('.nav-desktop__link');

  // Navigation Mobile
  const bottomTabLinks = document.querySelectorAll('.bottom-tab-bar__item');

  // ── 2. Détection prefers-reduced-motion ──────────────────────────────────

  const motionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
  const isReducedMotion = () => motionQuery.matches;

  // ── 3. Gestionnaire de Thème (localStorage > prefers-color-scheme > light) ──

  function initTheme() {
    if (!themeToggleBtn) return;

    // Ordre strict : 1. localStorage > 2. prefers-color-scheme > 3. fallback light
    let preferredTheme = 'light';
    try {
      const stored = localStorage.getItem('theme-preference');
      if (stored === 'dark' || stored === 'light') {
        preferredTheme = stored;
      } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        preferredTheme = 'dark';
      } else {
        preferredTheme = 'light';
      }
    } catch (_) {
      preferredTheme = 'light';
    }

    applyTheme(preferredTheme, false);

    themeToggleBtn.addEventListener('click', () => {
      const current = docEl.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';
      const next = current === 'dark' ? 'light' : 'dark';
      applyTheme(next, true);
    });
  }

  function applyTheme(theme, persist = true) {
    docEl.setAttribute('data-theme', theme);
    const isDark = theme === 'dark';

    if (themeToggleBtn) {
      themeToggleBtn.setAttribute('aria-pressed', isDark ? 'true' : 'false');
      themeToggleBtn.setAttribute(
        'aria-label',
        isDark ? 'Passer au thème clair' : 'Passer au thème sombre'
      );
    }

    if (persist) {
      try {
        localStorage.setItem('theme-preference', theme);
        document.cookie = `theme=${theme}; path=/; max-age=31536000; SameSite=Lax`;
      } catch (_) {}
    }
  }

  // ── 4. Barre de progression & Header scroll (rAF Throttlé) ──────────────

  let scrollTicking = false;
  let lastScrollY   = window.scrollY;

  function onScroll() {
    if (!scrollTicking) {
      requestAnimationFrame(handleScrollUpdate);
      scrollTicking = true;
    }
  }

  function handleScrollUpdate() {
    const currentScrollY = window.scrollY;

    // A. Header état sticky scrolled (scrollY >= 40px)
    if (headerEl) {
      headerEl.classList.toggle('site-header--scrolled', currentScrollY >= 40);
    }

    // B. Barre de progression (scaleX composite 0 reflow)
    if (progressBar) {
      const scrollableHeight = docEl.scrollHeight - window.innerHeight;
      if (scrollableHeight > 0) {
        progressBar.style.display = 'block';
        const progress = Math.min(Math.max(currentScrollY / scrollableHeight, 0), 1);
        progressBar.style.transform = `scaleX(${progress})`;
        progressBar.setAttribute('aria-valuenow', Math.round(progress * 100));
      } else {
        progressBar.style.display = 'none';
      }
    }

    // C. Masquage/Affichage intelligent de la bottom tab bar mobile
    if (bottomBarEl && !isReducedMotion()) {
      const delta = currentScrollY - lastScrollY;
      if (currentScrollY > 120 && delta > 6) {
        bottomBarEl.classList.add('bottom-tab-bar--hidden');
      } else if (delta < -6 || currentScrollY <= 120) {
        bottomBarEl.classList.remove('bottom-tab-bar--hidden');
      }
    }

    lastScrollY = currentScrollY;
    scrollTicking = false;
  }

  // ── 5. Indicateur de Section Active (FLIP + IntersectionObserver) ────────

  let currentActiveId = 'hero';

  function setActiveSection(sectionId, immediate = false) {
    if (currentActiveId === sectionId && !immediate) return;
    currentActiveId = sectionId;

    let activeDesktopLink = null;

    // Mise à jour de la nav desktop
    desktopLinks.forEach((link) => {
      const matches = link.getAttribute('data-section') === sectionId;
      if (matches) {
        link.setAttribute('aria-current', 'section');
        link.classList.add('is-active');
        activeDesktopLink = link;
      } else {
        link.removeAttribute('aria-current');
        link.classList.remove('is-active');
      }
    });

    // Mise à jour de la bottom tab bar mobile
    bottomTabLinks.forEach((tab) => {
      const matches = tab.getAttribute('data-section') === sectionId;
      if (matches) {
        tab.setAttribute('aria-current', 'page');
        tab.classList.add('is-active');
      } else {
        tab.removeAttribute('aria-current');
        tab.classList.remove('is-active');
      }
    });

    if (activeDesktopLink) {
      animateFlipIndicator(activeDesktopLink, immediate);
    }
  }

  function animateFlipIndicator(targetLink, immediate = false) {
    if (!navIndicator || !navTrack || !targetLink) return;

    const trackRect  = navTrack.getBoundingClientRect();
    const targetRect = targetLink.getBoundingClientRect();

    if (targetRect.width === 0) return;

    const targetLeft  = targetRect.left - trackRect.left;
    const targetWidth = targetRect.width;
    const targetTop   = targetRect.top - trackRect.top + (targetRect.height - 32) / 2;

    if (immediate || isReducedMotion()) {
      navIndicator.style.transition = 'none';
      navIndicator.style.left       = `${targetLeft}px`;
      navIndicator.style.top        = `${targetTop}px`;
      navIndicator.style.width       = `${targetWidth}px`;
      navIndicator.style.transform   = 'none';
      navIndicator.style.opacity     = '1';
      return;
    }

    // ── Étape F (First) ──
    const firstRect = navIndicator.getBoundingClientRect();
    const hasInitialPosition = navIndicator.style.opacity === '1' && firstRect.width > 0;

    // ── Étape L (Last) ──
    navIndicator.style.transition = 'none';
    navIndicator.style.left       = `${targetLeft}px`;
    navIndicator.style.top        = `${targetTop}px`;
    navIndicator.style.width       = `${targetWidth}px`;
    navIndicator.style.opacity     = '1';

    if (!hasInitialPosition) {
      navIndicator.style.transform = 'none';
      return;
    }

    const lastRect = navIndicator.getBoundingClientRect();

    // ── Étape I (Invert) ──
    const deltaX     = firstRect.left - lastRect.left;
    const scaleRatio = firstRect.width / (lastRect.width || 1);

    navIndicator.style.transform = `translateX(${deltaX}px) scaleX(${scaleRatio})`;

    // ── Étape P (Play) ──
    requestAnimationFrame(() => {
      navIndicator.style.transition =
        'transform 320ms cubic-bezier(0.23, 1, 0.32, 1), opacity 200ms ease';
      navIndicator.style.transform = 'translateX(0) scaleX(1)';
    });
  }

  function initSectionObserver() {
    const sectionIds = ['hero', 'projets', 'competences', 'a-propos', 'contact'];
    const observedElements = [];

    sectionIds.forEach((id) => {
      const el = document.getElementById(id);
      if (el) observedElements.push(el);
    });

    if (observedElements.length > 0 && 'IntersectionObserver' in window) {
      const observer = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              setActiveSection(entry.target.id);
            }
          });
        },
        {
          rootMargin: '-30% 0px -60% 0px',
          threshold: 0,
        }
      );

      observedElements.forEach((el) => observer.observe(el));
    }

    // Clics directs sur les liens pour retour tactile immédiat
    const allTrackedLinks = document.querySelectorAll(
      '.nav-desktop__link, .bottom-tab-bar__item, .drawer__link'
    );

    allTrackedLinks.forEach((link) => {
      link.addEventListener('click', () => {
        const section = link.getAttribute('data-section');
        if (section) {
          setActiveSection(section);
        }
        if (drawerEl && drawerEl.classList.contains('is-open')) {
          closeDrawer();
        }
      });
    });
  }

  // ── 6. Tiroir Latéral Mobile (Drawer), Scrim & Piège du Focus ───────────

  let previousActiveElement = null;

  function isDrawerOpen() {
    return drawerEl && drawerEl.classList.contains('is-open');
  }

  function openDrawer() {
    if (!drawerEl || !hamburgerBtn) return;
    previousActiveElement = document.activeElement;

    drawerEl.classList.add('is-open');
    drawerEl.setAttribute('aria-hidden', 'false');

    if (scrimEl) {
      scrimEl.classList.add('is-open');
      scrimEl.setAttribute('aria-hidden', 'false');
    }

    hamburgerBtn.setAttribute('aria-expanded', 'true');
    hamburgerBtn.setAttribute('aria-label', 'Fermer le menu');

    // Bloquer le défilement de l'arrière-plan sur html et body
    docEl.style.overflow = 'hidden';
    document.body.style.overflow = 'hidden';

    // Déplacer le focus sur le premier élément focusable du tiroir
    const firstFocusable = drawerEl.querySelector(
      'button, a[href], [tabindex]:not([tabindex="-1"])'
    );
    if (firstFocusable) {
      firstFocusable.focus();
    }
  }

  function closeDrawer() {
    if (!drawerEl || !hamburgerBtn) return;

    drawerEl.classList.remove('is-open');
    drawerEl.setAttribute('aria-hidden', 'true');

    if (scrimEl) {
      scrimEl.classList.remove('is-open');
      scrimEl.setAttribute('aria-hidden', 'true');
    }

    hamburgerBtn.setAttribute('aria-expanded', 'false');
    hamburgerBtn.setAttribute('aria-label', 'Ouvrir le menu');

    // Rétablir le défilement
    docEl.style.overflow = '';
    document.body.style.overflow = '';

    // Rétablir le focus sur le bouton hamburger déclencheur
    if (previousActiveElement && typeof previousActiveElement.focus === 'function') {
      previousActiveElement.focus();
    } else {
      hamburgerBtn.focus();
    }
  }

  function initDrawer() {
    if (!drawerEl || !hamburgerBtn) return;

    hamburgerBtn.addEventListener('click', () => {
      if (isDrawerOpen()) {
        closeDrawer();
      } else {
        openDrawer();
      }
    });

    if (drawerCloseBtn) {
      drawerCloseBtn.addEventListener('click', closeDrawer);
    }

    if (scrimEl) {
      scrimEl.addEventListener('click', closeDrawer);
    }

    window.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && isDrawerOpen()) {
        closeDrawer();
      }
    });

    // Piège du focus (Tab / Shift+Tab cyclique au sein du tiroir)
    drawerEl.addEventListener('keydown', (e) => {
      if (e.key !== 'Tab' || !isDrawerOpen()) return;

      const focusables = Array.from(
        drawerEl.querySelectorAll('a[href], button:not([disabled]), [tabindex]:not([tabindex="-1"])')
      );
      if (focusables.length === 0) return;

      const firstItem = focusables[0];
      const lastItem  = focusables[focusables.length - 1];

      if (e.shiftKey) {
        if (document.activeElement === firstItem) {
          e.preventDefault();
          lastItem.focus();
        }
      } else {
        if (document.activeElement === lastItem) {
          e.preventDefault();
          firstItem.focus();
        }
      }
    });
  }

  // ── 7. Curseur personnalisé (Desktop ≥ 1024px avec GSAP quickTo) ────────

  function initCustomCursor() {
    const cursor = document.getElementById('custom-cursor');
    if (!cursor) return;

    if (window.innerWidth < 1024 || isReducedMotion()) {
      cursor.style.display = 'none';
      return;
    }

    let isVisible = false;
    let xTo = null;
    let yTo = null;

    if (window.gsap) {
      xTo = gsap.quickTo(cursor, 'x', { duration: 0.4, ease: 'power3.out' });
      yTo = gsap.quickTo(cursor, 'y', { duration: 0.4, ease: 'power3.out' });
    }

    window.addEventListener('mousemove', (e) => {
      if (!isVisible) {
        cursor.style.opacity = '1';
        isVisible = true;
      }
      if (xTo && yTo) {
        xTo(e.clientX);
        yTo(e.clientY);
      } else {
        cursor.style.left = `${e.clientX}px`;
        cursor.style.top  = `${e.clientY}px`;
      }
    }, { passive: true });

    document.addEventListener('mouseleave', () => {
      cursor.style.opacity = '0';
      isVisible = false;
    });

    // Effet hover d'agrandissement sur éléments interactifs
    const hoverTargets = document.querySelectorAll('a, button, [role="button"], input, textarea');
    hoverTargets.forEach((el) => {
      el.addEventListener('mouseenter', () => cursor.classList.add('is-hover'));
      el.addEventListener('mouseleave', () => cursor.classList.remove('is-hover'));
    });
  }

  // ── 8. Hero SplitText & Timeline d'Entrée ────────────────────────────────

  function initHeroSplitText() {
    const titleEl = document.getElementById('hero-title');
    if (!titleEl) return;

    const rawText = titleEl.textContent.trim();
    titleEl.setAttribute('aria-label', rawText);
    titleEl.innerHTML = '';

    const words = rawText.split(' ');
    words.forEach((word, wIdx) => {
      const wordSpan = document.createElement('span');
      wordSpan.className = 'hero__word';
      wordSpan.setAttribute('aria-hidden', 'true');

      Array.from(word).forEach((char) => {
        const charSpan = document.createElement('span');
        charSpan.className = 'hero__char';
        charSpan.textContent = char;
        wordSpan.appendChild(charSpan);
      });

      titleEl.appendChild(wordSpan);
      if (wIdx < words.length - 1) {
        titleEl.appendChild(document.createTextNode(' '));
      }
    });
  }

  function initHeroTimeline() {
    const eyebrow  = document.querySelector('.hero__eyebrow');
    const chars    = document.querySelectorAll('.hero__char');
    const subtitle = document.querySelector('.hero__subtitle');
    const btn1     = document.querySelector('.hero__btn--primary');
    const btn2     = document.querySelector('.hero__btn--ghost');
    const chevron  = document.getElementById('hero-scroll-indicator');

    if (isReducedMotion()) {
      if (eyebrow)  { eyebrow.style.opacity = '1'; eyebrow.style.transform = 'none'; }
      chars.forEach((c) => { c.style.opacity = '1'; c.style.transform = 'none'; });
      if (subtitle) { subtitle.style.opacity = '1'; subtitle.style.transform = 'none'; }
      if (btn1)     { btn1.style.opacity = '1'; btn1.style.transform = 'none'; }
      if (btn2)     { btn2.style.opacity = '1'; btn2.style.transform = 'none'; }
      if (chevron)  { chevron.style.opacity = '0.5'; }
      return;
    }

    if (window.gsap) {
      const tl = gsap.timeline({
        defaults: { ease: 'cubic-bezier(0.23, 1, 0.32, 1)' }
      });

      // t=0ms : eyebrow (opacity 0→1, translateY 10px→0, durée 400ms)
      if (eyebrow) {
        tl.fromTo(eyebrow,
          { opacity: 0, y: 10 },
          { opacity: 1, y: 0, duration: 0.4 },
          0
        );
      }

      // t=100ms : titre (translateY(40px) rotateX(-40deg) opacity 0→1, 700ms, stagger 15ms)
      if (chars.length > 0) {
        tl.fromTo(chars,
          { opacity: 0, y: 40, rotateX: -40 },
          { opacity: 1, y: 0, rotateX: 0, duration: 0.7, stagger: 0.015 },
          0.1
        );
      }

      // t=800ms : sous-titre (opacity 0→1, translateY 20px→0, durée 500ms)
      if (subtitle) {
        tl.fromTo(subtitle,
          { opacity: 0, y: 20 },
          { opacity: 1, y: 0, duration: 0.5 },
          0.8
        );
      }

      // t=1100ms : bouton 1 (scale 0.9→1, opacity 0→1, 300ms)
      if (btn1) {
        tl.fromTo(btn1,
          { opacity: 0, scale: 0.9 },
          { opacity: 1, scale: 1, duration: 0.3 },
          1.1
        );
      }

      // t=1180ms : bouton 2 (scale 0.9→1, opacity 0→1, 300ms)
      if (btn2) {
        tl.fromTo(btn2,
          { opacity: 0, scale: 0.9 },
          { opacity: 1, scale: 1, duration: 0.3 },
          1.18
        );
      }

      // t=1500ms : chevron de scroll (opacity 0→0.5)
      if (chevron) {
        tl.fromTo(chevron,
          { opacity: 0 },
          { opacity: 0.5, duration: 0.4 },
          1.5
        );
      }
    } else {
      if (eyebrow)  { eyebrow.style.opacity = '1'; eyebrow.style.transform = 'none'; }
      chars.forEach((c) => { c.style.opacity = '1'; c.style.transform = 'none'; });
      if (subtitle) { subtitle.style.opacity = '1'; subtitle.style.transform = 'none'; }
      if (btn1)     { btn1.style.opacity = '1'; btn1.style.transform = 'none'; }
      if (btn2)     { btn2.style.opacity = '1'; btn2.style.transform = 'none'; }
      if (chevron)  { chevron.style.opacity = '0.5'; }
    }
  }

  // ── 9. Chevron de scroll (masquage au premier défilement) ────────────────

  function initHeroScrollIndicator() {
    const chevron = document.getElementById('hero-scroll-indicator');
    if (!chevron) return;

    let hasScrolled = false;
    window.addEventListener('scroll', () => {
      if (!hasScrolled && window.scrollY > 20) {
        chevron.style.opacity = '0';
        hasScrolled = true;
      }
    }, { passive: true });
  }

  // ── 10. Projets ScrollTrigger & Parallax (Phase 3.A) ────────────────────

  function initProjectsScrollTrigger() {
    const cards = document.querySelectorAll('.project-card');
    if (cards.length === 0) return;

    if (isReducedMotion()) {
      cards.forEach((card) => {
        card.style.opacity = '1';
        card.style.transform = 'none';
      });
      return;
    }

    if (window.gsap && window.ScrollTrigger) {
      gsap.registerPlugin(ScrollTrigger);

      // Animation d'entrée des cartes en stagger (80ms)
      gsap.fromTo(
        cards,
        {
          opacity: 0,
          y: 30,
          scale: 0.97,
        },
        {
          opacity: 1,
          y: 0,
          scale: 1,
          duration: 0.6,
          stagger: 0.08,
          ease: 'cubic-bezier(0.23, 1, 0.32, 1)',
          scrollTrigger: {
            trigger: '.projects__grid',
            start: 'top 85%',
            end: 'top 40%',
            toggleActions: 'play none none none',
          },
        }
      );

      // Parallax léger sur le média (amplitude max 10% : -5% à +5%)
      cards.forEach((card) => {
        const media = card.querySelector('.project-card__media');
        if (media) {
          gsap.fromTo(
            media,
            { yPercent: -5 },
            {
              yPercent: 5,
              ease: 'none',
              scrollTrigger: {
                trigger: card,
                start: 'top bottom',
                end: 'bottom top',
                scrub: true,
              },
            }
          );
        }
      });
    } else {
      cards.forEach((card) => {
        card.style.opacity = '1';
        card.style.transform = 'none';
      });
    }
  }

  // ── 11. Page Détail Projet ScrollTrigger (Phase 3.B) ───────────────────

  function initProjectDetailAnimations() {
    const detailArticle = document.querySelector('.project-detail__article');
    if (!detailArticle) return;

    const titleEl      = detailArticle.querySelector('.project-detail__title');
    const sections     = detailArticle.querySelectorAll('.project-detail__section');
    const galleryItems = detailArticle.querySelectorAll('.project-detail__placeholder-media');

    if (isReducedMotion()) {
      if (titleEl) { titleEl.style.opacity = '1'; titleEl.style.transform = 'none'; }
      sections.forEach((s) => { s.style.opacity = '1'; s.style.transform = 'none'; });
      galleryItems.forEach((g) => { g.style.opacity = '1'; g.style.transform = 'none'; });
      return;
    }

    if (window.gsap && window.ScrollTrigger) {
      gsap.registerPlugin(ScrollTrigger);

      // Titre h1 : fade + translateY(20px) → 0, durée 500ms
      if (titleEl) {
        gsap.fromTo(
          titleEl,
          { opacity: 0, y: 20 },
          {
            opacity: 1,
            y: 0,
            duration: 0.5,
            ease: 'cubic-bezier(0.23, 1, 0.32, 1)',
          }
        );
      }

      // Sections : fade + translateY(30px) → 0, stagger 100ms entre sections, ScrollTrigger start "top 85%"
      if (sections.length > 0) {
        gsap.fromTo(
          sections,
          { opacity: 0, y: 30 },
          {
            opacity: 1,
            y: 0,
            duration: 0.6,
            stagger: 0.1,
            ease: 'cubic-bezier(0.23, 1, 0.32, 1)',
            scrollTrigger: {
              trigger: '.project-detail__body',
              start: 'top 85%',
              toggleActions: 'play none none none',
            },
          }
        );
      }

      // Galerie : images en stagger 80ms au scroll
      if (galleryItems.length > 0) {
        gsap.fromTo(
          galleryItems,
          { opacity: 0, y: 20 },
          {
            opacity: 1,
            y: 0,
            duration: 0.5,
            stagger: 0.08,
            ease: 'cubic-bezier(0.23, 1, 0.32, 1)',
            scrollTrigger: {
              trigger: '.project-detail__gallery-grid',
              start: 'top 85%',
              toggleActions: 'play none none none',
            },
          }
        );
      }
    } else {
      if (titleEl) { titleEl.style.opacity = '1'; titleEl.style.transform = 'none'; }
      sections.forEach((s) => { s.style.opacity = '1'; s.style.transform = 'none'; });
      galleryItems.forEach((g) => { g.style.opacity = '1'; g.style.transform = 'none'; });
    }
  }

  // ── 12. Compétences ScrollTrigger & Bento Animations (Phase 4) ──────────

  function initSkillsTimeline() {
    const section = document.getElementById('competences');
    if (!section) return;

    const headerEls = section.querySelectorAll(
      '.skills__header .section-label, .skills__header .section-title, .skills__header .section-description'
    );
    const zones = section.querySelectorAll('.skill-zone');

    if (isReducedMotion()) {
      if (headerEls.length > 0) {
        headerEls.forEach((el) => {
          el.style.opacity = '1';
          el.style.transform = 'none';
        });
      }
      zones.forEach((zone) => {
        zone.style.opacity = '1';
        zone.style.transform = 'none';

        const countEl = zone.querySelector('.skill-zone__count');
        if (countEl) {
          const target = countEl.dataset.target || '0';
          countEl.textContent = String(target).padStart(2, '0');
        }

        const iconPaths = zone.querySelectorAll(
          '.skill-zone__icon :is(path, polyline, line, circle, ellipse, rect)'
        );
        iconPaths.forEach((path) => {
          path.style.strokeDashoffset = '0';
          path.style.strokeDasharray = 'none';
        });

        const items = zone.querySelectorAll('.skill-zone__item');
        items.forEach((item) => {
          item.style.opacity = '1';
          item.style.transform = 'none';
        });
      });
      return;
    }

    if (window.gsap && window.ScrollTrigger) {
      gsap.registerPlugin(ScrollTrigger);

      // Préparation initiale des tracés SVG et des compteurs
      zones.forEach((zone) => {
        const countEl = zone.querySelector('.skill-zone__count');
        if (countEl) {
          countEl.textContent = '00';
        }

        const icon = zone.querySelector('.skill-zone__icon');
        if (icon) {
          const paths = icon.querySelectorAll('path, polyline, line, circle, ellipse, rect');
          paths.forEach((path) => {
            const length = typeof path.getTotalLength === 'function'
              ? Math.ceil(path.getTotalLength())
              : 1000;
            path.style.strokeDasharray = length;
            path.style.strokeDashoffset = length;
          });
        }
      });

      // 1. Animation du header de section au scroll
      if (headerEls.length > 0) {
        gsap.fromTo(
          headerEls,
          { opacity: 0, y: 20 },
          {
            opacity: 1,
            y: 0,
            duration: 0.5,
            stagger: 0.08,
            ease: 'power2.out',
            scrollTrigger: {
              trigger: '#competences',
              start: 'top 85%',
              toggleActions: 'play none none none',
            },
          }
        );
      }

      // 2. Animation individuelle de chaque zone à son entrée dans le viewport (top 85%)
      zones.forEach((zone) => {
        const countEl = zone.querySelector('.skill-zone__count');
        const icon = zone.querySelector('.skill-zone__icon');
        const iconWrap = zone.querySelector('.skill-zone__icon-wrap');
        const items = zone.querySelectorAll('.skill-zone__item');

        const tl = gsap.timeline({
          scrollTrigger: {
            trigger: zone,
            start: 'top 85%',
            toggleActions: 'play none none none',
          },
        });

        // Apparition de la zone bento
        tl.fromTo(
          zone,
          { opacity: 0, scale: 0.95 },
          {
            opacity: 1,
            scale: 1,
            duration: 0.6,
            ease: 'power2.out',
          },
          0
        );

        // Cascade des items de compétences
        if (items.length > 0) {
          tl.fromTo(
            items,
            { opacity: 0, x: -8 },
            {
              opacity: 1,
              x: 0,
              duration: 0.35,
              stagger: 0.04,
              ease: 'power2.out',
            },
            0.15
          );
        }

        // Compteur animé : 00 → valeur finale en 800ms
        if (countEl) {
          const targetVal = parseInt(countEl.dataset.target, 10) || 0;
          const countData = { val: 0 };

          tl.to(
            countData,
            {
              val: targetVal,
              duration: 0.8,
              ease: 'power2.out',
              onStart: () => {
                countEl.style.willChange = 'transform';
              },
              onUpdate: () => {
                countEl.textContent = String(Math.round(countData.val)).padStart(2, '0');
              },
              onComplete: () => {
                countEl.textContent = String(targetVal).padStart(2, '0');
                countEl.style.willChange = 'auto';
              },
            },
            0.2
          );
        }

        // Draw SVG progressif des icônes
        if (icon) {
          const paths = icon.querySelectorAll('path, polyline, line, circle, ellipse, rect');
          tl.to(
            paths,
            {
              strokeDashoffset: 0,
              duration: 1.0,
              ease: 'power2.inOut',
              stagger: 0.05,
              onStart: () => {
                if (iconWrap) iconWrap.style.willChange = 'transform';
              },
              onComplete: () => {
                if (iconWrap) iconWrap.style.willChange = 'auto';
              },
            },
            0.2
          );
        }
      });
    } else {
      // Fallback sans GSAP
      if (headerEls.length > 0) {
        headerEls.forEach((el) => { el.style.opacity = '1'; el.style.transform = 'none'; });
      }
      zones.forEach((zone) => {
        zone.style.opacity = '1';
        zone.style.transform = 'none';
        const countEl = zone.querySelector('.skill-zone__count');
        if (countEl) {
          const target = countEl.dataset.target || '0';
          countEl.textContent = String(target).padStart(2, '0');
        }
        const items = zone.querySelectorAll('.skill-zone__item');
        items.forEach((item) => { item.style.opacity = '1'; item.style.transform = 'none'; });
      });
    }
  }

  // ── 13. Section À propos ScrollTrigger & Clip-Path Reveal (Phase 5) ─────

  function initAboutAnimations() {
    const section = document.getElementById('a-propos');
    if (!section) return;

    const nameEl    = section.querySelector('.about__name');
    const roleEl    = section.querySelector('.about__role');
    const wrapEl    = section.querySelector('.about__portrait-wrap');
    const introEl   = section.querySelector('.about__intro');
    const blocks    = section.querySelectorAll('.about__block');
    const projItems = section.querySelectorAll('.about__project-list li');

    if (isReducedMotion()) {
      if (nameEl)  { nameEl.style.opacity = '1'; nameEl.style.transform = 'none'; }
      if (roleEl)  { roleEl.style.opacity = '1'; roleEl.style.transform = 'none'; }
      if (wrapEl)  { wrapEl.style.clipPath = 'inset(0 0 0 0)'; }
      if (introEl) { introEl.style.opacity = '1'; introEl.style.transform = 'none'; }
      blocks.forEach((b) => { b.style.opacity = '1'; b.style.transform = 'none'; });
      projItems.forEach((p) => { p.style.opacity = '1'; p.style.transform = 'none'; });
      return;
    }

    if (window.gsap && window.ScrollTrigger) {
      gsap.registerPlugin(ScrollTrigger);

      // 1 & 2. En-tête éditorial : Nom (700ms power3.out) + Rôle (+200ms, 500ms)
      if (nameEl || roleEl) {
        const headerTl = gsap.timeline({
          scrollTrigger: {
            trigger: '.about__header',
            start: 'top 85%',
            toggleActions: 'play none none none',
          },
        });

        if (nameEl) {
          headerTl.fromTo(
            nameEl,
            { opacity: 0, y: 30 },
            {
              opacity: 1,
              y: 0,
              duration: 0.7,
              ease: 'power3.out',
            },
            0
          );
        }

        if (roleEl) {
          headerTl.fromTo(
            roleEl,
            { opacity: 0, y: 15 },
            {
              opacity: 1,
              y: 0,
              duration: 0.5,
              ease: 'power3.out',
            },
            0.2
          );
        }
      }

      // 3 & 4. Portrait révélation clip-path (900ms power3.out) + Intro (+300ms, 600ms)
      if (wrapEl) {
        gsap.set(wrapEl, { clipPath: 'inset(0 100% 0 0)' });

        const portraitTl = gsap.timeline({
          scrollTrigger: {
            trigger: wrapEl,
            start: 'top 75%',
            toggleActions: 'play none none none',
          },
        });

        portraitTl.to(wrapEl, {
          clipPath: 'inset(0 0 0 0)',
          duration: 0.9,
          ease: 'power3.out',
        });

        if (introEl) {
          portraitTl.fromTo(
            introEl,
            { opacity: 0, y: 20 },
            {
              opacity: 1,
              y: 0,
              duration: 0.6,
              ease: 'power3.out',
            },
            0.3
          );
        }
      } else if (introEl) {
        gsap.fromTo(
          introEl,
          { opacity: 0, y: 20 },
          {
            opacity: 1,
            y: 0,
            duration: 0.6,
            ease: 'power3.out',
            scrollTrigger: {
              trigger: introEl,
              start: 'top 80%',
              toggleActions: 'play none none none',
            },
          }
        );
      }

      // 5. Blocs biographiques : fade + translateY(25px) → 0, ScrollTrigger individuel (start: 'top 80%')
      blocks.forEach((block) => {
        gsap.fromTo(
          block,
          { opacity: 0, y: 25 },
          {
            opacity: 1,
            y: 0,
            duration: 0.6,
            ease: 'power3.out',
            scrollTrigger: {
              trigger: block,
              start: 'top 80%',
              toggleActions: 'play none none none',
            },
          }
        );
      });

      // 6. Liste projets : stagger 60ms, fade + translateX(-10px) → 0
      if (projItems.length > 0) {
        gsap.fromTo(
          projItems,
          { opacity: 0, x: -10 },
          {
            opacity: 1,
            x: 0,
            duration: 0.4,
            stagger: 0.06,
            ease: 'power3.out',
            scrollTrigger: {
              trigger: '.about__project-list',
              start: 'top 85%',
              toggleActions: 'play none none none',
            },
          }
        );
      }
    } else {
      // Fallback sans GSAP
      if (nameEl)  { nameEl.style.opacity = '1'; nameEl.style.transform = 'none'; }
      if (roleEl)  { roleEl.style.opacity = '1'; roleEl.style.transform = 'none'; }
      if (wrapEl)  { wrapEl.style.clipPath = 'inset(0 0 0 0)'; }
      if (introEl) { introEl.style.opacity = '1'; introEl.style.transform = 'none'; }
      blocks.forEach((b) => { b.style.opacity = '1'; b.style.transform = 'none'; });
      projItems.forEach((p) => { p.style.opacity = '1'; p.style.transform = 'none'; });
    }
  }

  // ── 14. Contact ScrollTrigger (Phase 6) ──────────────────────────────────

  function initContactAnimations() {
    const section = document.getElementById('contact');
    if (!section) return;

    const headerEls = section.querySelectorAll(
      '.contact__header .section-label, .contact__header .contact__title, .contact__header .contact__subtitle, .contact__header .section-title, .contact__header .section-description'
    );
    const cards = section.querySelectorAll('.contact-card, .contact__item');

    if (isReducedMotion()) {
      headerEls.forEach((el) => { el.style.opacity = '1'; el.style.transform = 'none'; });
      cards.forEach((el) => { el.style.opacity = '1'; el.style.transform = 'none'; });
      return;
    }

    if (window.gsap && window.ScrollTrigger) {
      gsap.registerPlugin(ScrollTrigger);

      // Header : fade + translateY(20px) → 0, 500ms, stagger léger
      if (headerEls.length > 0) {
        gsap.fromTo(
          headerEls,
          { opacity: 0, y: 20 },
          {
            opacity: 1,
            y: 0,
            duration: 0.5,
            stagger: 0.06,
            ease: 'cubic-bezier(0.23, 1, 0.32, 1)',
            scrollTrigger: {
              trigger: '#contact',
              start: 'top 85%',
              toggleActions: 'play none none none',
            },
          }
        );
      }

      // Cartes avec stagger
      if (cards.length > 0) {
        gsap.fromTo(
          cards,
          { opacity: 0, y: 20 },
          {
            opacity: 1,
            y: 0,
            duration: 0.6,
            stagger: 0.08,
            ease: 'cubic-bezier(0.23, 1, 0.32, 1)',
            scrollTrigger: {
              trigger: '.contact__grid, .contact__list',
              start: 'top 80%',
              toggleActions: 'play none none none',
            },
          }
        );
      }
    } else {
      headerEls.forEach((el) => { el.style.opacity = '1'; el.style.transform = 'none'; });
      cards.forEach((el) => { el.style.opacity = '1'; el.style.transform = 'none'; });
    }
  }

  // ── 15. Effet Glow Carte Contact (Phase 6) ─────────────────────────────────

  function initContactGlow() {
    const cards = document.querySelectorAll('.contact-card:not(.contact-card--passive)');
    if (!window.matchMedia('(hover: hover)').matches) return;
    if (isReducedMotion()) return;

    cards.forEach((card) => {
      let ticking = false;
      card.addEventListener('mousemove', (e) => {
        if (!ticking) {
          requestAnimationFrame(() => {
            const rect = card.getBoundingClientRect();
            const x = ((e.clientX - rect.left) / rect.width) * 100;
            const y = ((e.clientY - rect.top) / rect.height) * 100;
            card.style.setProperty('--mx', x + '%');
            card.style.setProperty('--my', y + '%');
            ticking = false;
          });
          ticking = true;
        }
      }, { passive: true });
    });
  }

  // ── 16. Boutons copie + Toast (Phase 6) ────────────────────────────────────

  function initCopyButtons() {
    const copyBtns = document.querySelectorAll('.contact-card__copy, .contact__copy');
    const toast    = document.getElementById('copy-toast');
    if (copyBtns.length === 0) return;

    let toastTimer = null;

    function showToast() {
      if (!toast) return;
      clearTimeout(toastTimer);
      toast.classList.add('is-visible');
      toastTimer = setTimeout(() => {
        toast.classList.remove('is-visible');
      }, 2000);
    }

    function copyText(text) {
      if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text).then(showToast).catch(() => fallbackCopy(text));
      } else {
        fallbackCopy(text);
      }
    }

    function fallbackCopy(text) {
      const ta = document.createElement('textarea');
      ta.value = text;
      ta.setAttribute('readonly', '');
      ta.style.cssText = 'position:fixed;top:-9999px;left:-9999px;opacity:0;';
      document.body.appendChild(ta);
      ta.select();
      try {
        document.execCommand('copy');
        showToast();
      } catch (_) { /* silencieux */ }
      document.body.removeChild(ta);
    }

    copyBtns.forEach((btn) => {
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const text = btn.dataset.copy || '';
        if (text) copyText(text);
      });
    });
  }

  // ── 17. Initialisation globale au chargement ────────────────────────────

  document.addEventListener('DOMContentLoaded', () => {
    initTheme();
    initDrawer();
    initHeroSplitText();
    initHeroTimeline();
    initHeroScrollIndicator();
    initProjectsScrollTrigger();
    initProjectDetailAnimations();
    initSkillsTimeline();
    initAboutAnimations();
    initContactAnimations();
    initContactGlow();
    initCopyButtons();
    initCustomCursor();
    initSectionObserver();

    // Premier positionnement de l'indicateur FLIP
    const initialLink = document.querySelector('.nav-desktop__link[aria-current="section"]');
    if (initialLink) {
      animateFlipIndicator(initialLink, true);
    }

    // Écouteur passif de défilement
    window.addEventListener('scroll', onScroll, { passive: true });
    // Premier calcul au cas où la page est déjà scrollée
    handleScrollUpdate();

    // Recalibrage de l'indicateur au redimensionnement sans animation
    window.addEventListener('resize', () => {
      const activeLink = document.querySelector('.nav-desktop__link[aria-current="section"]');
      if (activeLink) {
        animateFlipIndicator(activeLink, true);
      }
    });
  });
})();

