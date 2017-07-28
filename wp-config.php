<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/oceane/Documents/simplon/publicserveur/siteUrhaj/urhaj/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'urhaj');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'root');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'aA{o[q$%{oa=IHGaeybj3oUdGq8:S/?Tz[l)QB%@5}XTp>sts2WDQ8;{{{3_JNwk');
define('SECURE_AUTH_KEY',  '{vuTaH`eh~f|@P2[z9_7JndJ}mxS3Yk.884a<bFIl>!k.gOsy@i:En#c^{0_zTS=');
define('LOGGED_IN_KEY',    'Tu],YPs5VGe7kipg/>BH&9y>(Ov0t->Jjt0;0s@G,kb b.C9_~z`IhSZ`hc.nsrq');
define('NONCE_KEY',        'bCb)Q.!p@(PmO=a$({ 8B$l&9+A-PP^Fy(PIeV$0AFyK65vF;C-sPo6l]j*JQs,D');
define('AUTH_SALT',        'A87$L!U;jvY76%BJgkmD^DXb~BE|pS*TO%./N1wb( Q,rROUC!%UR<Ejr[!_[Z4P');
define('SECURE_AUTH_SALT', 's6=IrR)qUJ]|/JQjb$(/c2eZgYkT~xvN!<@Q:Y6n;LH-u*m/m$s&z_}xEa:XfwT.');
define('LOGGED_IN_SALT',   'h4),5@I=.%l_eP:6Th|5>l[5r6$x`iQR#IFo~#%:L~Ays~) G1|:itN rt2)xO Y');
define('NONCE_SALT',       'a_%Fe>VO[O S[<!ZU bB`6G!XCxuQ;^]khcFa!hRnoz5p&gENjY:Ibvte5#)5F5t');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');