<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link https://fr.wordpress.org/support/article/editing-wp-config-php/ Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'delta-theme-wp23' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'U0JZB($]Kgt4%d)aVOLzHAz]ijC!Y<n7/i3x?+gIYt>2yyHGvUVK(&2c8U9HwvOo' );
define( 'SECURE_AUTH_KEY',  'Em<3*1>@OOb+s=@~ c|z6{XupqK6y_`9o?P+.@}(l(]UX96HM&h;FC>SGB)D{G<g' );
define( 'LOGGED_IN_KEY',    '?KtXI$4C_oc+JRT;_xg}/a(2xUG!XIM5Wqjk|iF,ga5fTs!DBCi(&s5.`PXN58sg' );
define( 'NONCE_KEY',        'epPl8ML8[,<8S>U~RL!U_]<hPIPC/GaUCV8}e9@}[WN[xMx__y,6cbHDrj61YJE%' );
define( 'AUTH_SALT',        '|#~cl<9{Z4Xb<Z^>LQYb`kb{lvMs_Sy$8>{IL j*hs}g|usc(vUp49Gvn7m=Dtj}' );
define( 'SECURE_AUTH_SALT', '@EJby^WI|bP+EKSzHV;Bd?16O[kN7l<S|X2MVsbD*YzCb4Nnt@DMe{wlkWImjEgB' );
define( 'LOGGED_IN_SALT',   'I7sSkicE7}BvfR73K{_m{!+cii E_Rwk&.!i!t]&hPq?Lg|P&ely<lniO~{E0L0l' );
define( 'NONCE_SALT',       'II[TlWIG&x41R7L}aYu>XeDK`w 3LxiCO?2Y&[`gfa&#^C2-Kn>4/<bWGcjxDUn ' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_023';

/**
 * Pour les développeurs et développeuses : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur la documentation.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', true);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
