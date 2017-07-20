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
define('DB_NAME', 'urhaj');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'urhaj');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'TkRz8maf9ZBpdeBB');

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
define('AUTH_KEY',         '{^Z!R,fd~+(kz j{7r9!1,z.vE$|F:v5gCxtx[7LMf?))UHz4<0 %UGIOyPj73Cc');
define('SECURE_AUTH_KEY',  'c9iu}}(|TY|hp?#@-zZE~HJ5GL4vwCzJ7LR<:)>ue^[RkO7 ixgON_mr]Y#%RhFF');
define('LOGGED_IN_KEY',    'KtqY`L<:L59y_:$_Sa|3ka/4%IMFYRd{KHvU&=JxKVfw_ |K?zAX?Ph#qBC%+&p^');
define('NONCE_KEY',        'gR~*I#%1R(Cy_w@4N{D8YX:Rj)>wQq$EE!iC4r~lQ6>.(SLN%hD~}ADEnxlx<A/O');
define('AUTH_SALT',        '6iWM>2%R{%#kAMFD[[yH/9aLf?GphUG>SODA2V*]r2JhkmY48ek[;_d5jkXv|taj');
define('SECURE_AUTH_SALT', 'j^p5XnlEZ(>F`KQYSi:6e%Cy[A1c0S;TcMomG*xVdZB<KH@)^Kf[0)Zi~Hk{? LP');
define('LOGGED_IN_SALT',   'LY~~?1Z65P;f}LDjdi!N7?*bEuf_}Bh:B91O#]y7ei2zVlV43(E6(/8%tS%Q@o,w');
define('NONCE_SALT',       ',.(4ApC/P.sgtpJl n:(ohQLrza2 @dJ}/T@(2 N17JT6W0yqvcpFZp;c{i7DTEt');
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
