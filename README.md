# Portfolio — Semakuba David

Portfolio personnel développé en PHP vanilla, sans framework.
En ligne sur **[semakuba.ct.ws](https://semakuba.ct.ws)**.

## Scores Lighthouse

| Métrique | Desktop | Mobile |
|---|---|---|
| Performance | 99 | 82 |
| Accessibilité | 100 | 100 |
| Bonnes pratiques | 100 | 100 |
| SEO | 100 | 100 |

## Stack technique

- **PHP 8.2+** — vanilla, architecture modulaire par inclusions
- **CSS moderne** — tokens OKLCH 4-tiers, `color-mix()`, `clamp()`, nesting natif
- **JavaScript ES2022** — modules, `IntersectionObserver`, `requestAnimationFrame`
- **GSAP 3** — ScrollTrigger, timelines orchestrées
- **Lenis** — smooth scroll

## Architecture

```text
porfolio/
├── assets/
│   ├── css/          # tokens.css, base.css, components.css, animations.css
│   ├── js/           # main.js (ES2022)
│   ├── svg/          # logo, illustrations projets, og-cover
│   ├── img/          # portrait webp
│   └── cv/           # cv pdf
├── data/
│   └── projects.php  # source unique de vérité des projets
├── includes/         # partials PHP (head, header, hero, projects, skills, about, contact, footer)
├── projets/          # index.php (archive), pages détails, _layout.php
├── config.php        # configuration globale, helpers url() et absolute_url()
├── index.php         # point d'entrée principal
├── robots.txt        # configuration robots & sitemap
├── sitemap.xml       # plan du site pour moteurs de recherche
├── llms.txt          # manifeste IA standard
└── .htaccess         # règles Apache (Clean URLs, sécurité HTTP, cache)
```

## Licence

Tous droits réservés © 2026 Semakuba David. Voir [LICENSE](LICENSE).
