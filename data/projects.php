<?php
/**
 * data/projects.php — Source unique de vérité des projets.
 * Chargé via get_projects() défini dans config.php.
 * Retourne un tableau associatif indexé par slug.
 */

return [

    [
        'slug'          => 'tramo-2-0',
        'title'         => 'TRAMO 2.0',
        'category'      => 'Transport & mobilité',
        'featured'      => true,
        'summary'       => 'Plateforme de gestion du transport avec authentification '
                         . 'et contrôle d\'accès par rôles. Génération automatisée '
                         . 'de cartes PVC et supports promotionnels.',
        'role'          => 'Conception et développement complets',
        'challenge'     => 'Concevoir un système multi-rôles sécurisé avec contrôle d\'accès granulaire, et automatiser la génération de cartes PVC physiques à partir des données utilisateur.',
        'result'        => 'Système complet livré et validé côté métier. En attente de validation finale pour le déploiement.',
        'source_status' => 'client_owned',
        'source_note'   => 'Code source propriétaire du client. Démonstration technique sur demande.',
        'context'       => [
            'Système de gestion des flux de transport regroupant plusieurs '
            . 'profils utilisateurs avec des niveaux d\'accès distincts : '
            . 'administrateur, opérateur et agent de terrain.',
            'La production des cartes PVC était jusqu\'alors manuelle, '
            . 'chronophage et source d\'erreurs. Le système devait automatiser '
            . 'cette chaîne depuis la saisie jusqu\'à l\'impression physique.',
            'Le client exigeait un contrôle fin des droits sans dépendance '
            . 'à un service cloud tiers pour l\'authentification.',
        ],
        'solution'      => [
            'Backend Java Spring Boot sécurisé par rôles (Spring Security + JWT). '
            . 'Chaque rôle expose un ensemble de routes strictement délimité.',
            'Frontend PHP consommant l\'API REST interne. Interface responsive '
            . 'avec tableaux de bord différenciés selon le profil connecté.',
            'Génération PVC automatisée via Puppeteer : un template HTML/CSS '
            . 'est rendu headless, converti en PDF haute résolution, puis '
            . 'transmis à l\'imprimante. Zéro intervention manuelle.',
        ],
        'stack'         => ['Java', 'Spring Boot', 'Spring Security', 'PHP', 'PostgreSQL', 'Puppeteer', 'JWT'],
        'status'        => 'Déploiement en attente de validation côté client',
        'status_type'   => 'pending',   // pending | live | done
        'results'       => [
            'Architecture validée par le client.',
            'Génération de cartes PVC testée et fonctionnelle.',
            'Déploiement suspendu à la validation finale du client.',
        ],
        'order'         => 1,
    ],

    [
        'slug'          => 'stivo-bridge',
        'title'         => 'STIVO Bridge',
        'category'      => 'Extension navigateur',
        'featured'      => true,
        'summary'       => 'Extension Chrome qui intercepte les impressions '
                         . 'de reçus thermiques sur le portail Phoenix Congo, '
                         . 'là où le portail n\'offrait aucun support natif.',
        'role'          => 'Développeur unique',
        'challenge'     => 'Intercepter le flux d\'impression du portail Phoenix Congo sans modifier le portail lui-même, et rediriger les reçus vers une imprimante thermique en respectant le protocole ESC/POS.',
        'result'        => 'Extension livrée en version 0.1.0, déployée en production sur le portail.',
        'source_status' => 'private',
        'source_note'   => 'Code source privé. Démonstration disponible en vidéo.',
        'context'       => [
            'Le portail Phoenix Congo ne proposait pas d\'impression correcte '
            . 'des reçus thermiques au format 58 mm ou 80 mm. Les agents '
            . 'imprimaient sur papier A4, gaspillant papier et temps.',
            'Modifier le portail était hors périmètre : accès au code source '
            . 'inexistant, hébergement tiers, contraintes légales.',
        ],
        'solution'      => [
            'Extension Chrome en JavaScript pur (Manifest V3). Injection '
            . 'd\'un content script qui intercepte l\'événement d\'impression '
            . 'avant qu\'il n\'atteigne le dialogue navigateur.',
            'Reformatage à la volée du contenu du reçu : suppression des '
            . 'marges A4, application d\'une feuille de style thermique '
            . '58/80 mm, déclenchement de window.print() sur le nœud isolé.',
            'Aucune modification côté serveur. Aucune dépendance externe. '
            . 'L\'extension fonctionne en hors-ligne complet.',
        ],
        'stack'         => ['JavaScript', 'Chrome Extensions API', 'Manifest V3', 'CSS Print'],
        'status'        => 'Version 0.1.0 livrée',
        'status_type'   => 'done',
        'results'       => [
            'Version 0.1.0 distribuée aux agents cibles.',
            'Temps d\'impression réduit, élimination des marges A4.',
            'Aucune régression sur le portail Phoenix Congo.',
        ],
        'order'         => 2,
    ],

    [
        'slug'          => 'flux-devmedia',
        'title'         => 'Flux (DevMedia)',
        'category'      => 'Application Android',
        'featured'      => true,
        'summary'       => 'Application de téléchargement et de gestion de vidéos '
                         . 'avec intégration système complète : stockage média, '
                         . 'tâches en arrière-plan, reprise sur interruption.',
        'role'          => 'Développeur unique',
        'challenge'     => 'Intégrer le téléchargement de vidéos avec le système Android natif : stockage MediaStore, tâches en arrière-plan via WorkManager, reprise automatique sur interruption réseau.',
        'result'        => 'Application fonctionnelle, utilisée en usage personnel quotidien.',
        'source_status' => 'private',
        'source_note'   => 'Application personnelle, non publiée. Démonstration disponible en vidéo.',
        'context'       => [
            'Les applications de téléchargement vidéo Android disponibles '
            . 'imposent des comptes, affichent des publicités ou refusent '
            . 'd\'écrire dans le MediaStore standard.',
            'Besoin d\'une solution locale, sans compte, capable de reprendre '
            . 'un téléchargement interrompu et d\'exposer les fichiers '
            . 'à la galerie système sans permission racine.',
        ],
        'solution'      => [
            'Application native Kotlin, UI en Jetpack Compose. Architecture '
            . 'MVVM avec StateFlow pour les états de téléchargement.',
            'Réseau via Ktor Client. Extraction des flux via NewPipeExtractor '
            . 'et yt-dlp bundlé. Écriture dans MediaStore via ContentResolver.',
            'WorkManager pour les tâches longues : reprise automatique après '
            . 'coupure réseau ou mise en veille du système.',
        ],
        'stack'         => ['Kotlin', 'Jetpack Compose', 'Ktor Client', 'MediaStore', 'WorkManager', 'yt-dlp', 'NewPipeExtractor'],
        'status'        => 'Fonctionnelle',
        'status_type'   => 'live',
        'results'       => [
            'Application fonctionnelle sur Android 10+.',
            'Téléchargement en arrière-plan avec reprise sur interruption.',
            'Fichiers accessibles depuis la galerie système sans root.',
        ],
        'order'         => 3,
    ],

    [
        'slug'          => 'pos-print',
        'title'         => 'POS Print by David',
        'category'      => 'Application desktop',
        'featured'      => true,
        'summary'       => 'Application d\'impression thermique via Bluetooth '
                         . 'avec encodage raster ESC/POS.',
        'role'          => 'Développeur unique',
        'challenge'     => 'Communiquer avec une imprimante thermique Bluetooth depuis une application desktop Electron, en générant les commandes raster ESC/POS manuellement.',
        'result'        => 'Version fonctionnelle en cours de finalisation. L\'impression Bluetooth est opérationnelle.',
        'source_status' => 'in_progress',
        'source_note'   => 'Projet en développement. Démonstration disponible en vidéo.',
        'context'       => [
            'Les petits commerces disposent d\'imprimantes thermiques Bluetooth '
            . 'mais aucun logiciel simple ne permettait l\'impression de reçus '
            . 'sans serveur central ni configuration réseau.',
            'Les solutions existantes nécessitent un serveur local ou des '
            . 'pilotes propriétaires incompatibles avec Windows en mode kiosque.',
        ],
        'solution'      => [
            'Application Electron encapsulant la logique d\'encodage ESC/POS '
            . 'en raster bitmap. Communication Bluetooth directe via Web '
            . 'Bluetooth API dans la webview Chromium d\'Electron.',
            'Interface minimaliste : saisie des lignes du reçu, aperçu '
            . 'temps réel, impression en un clic. Aucune dépendance réseau.',
        ],
        'stack'         => ['Electron', 'JavaScript', 'ESC/POS', 'Web Bluetooth API'],
        'status'        => 'Fonctionnelle',
        'status_type'   => 'live',
        'results'       => [
            'Impression thermique Bluetooth opérationnelle.',
            'Déploiement possible en mode kiosque Windows.',
            'Aucune dépendance à un service externe.',
        ],
        'order'         => 4,
    ],

];
