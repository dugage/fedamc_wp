<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи и ABSPATH. Дополнительную информацию можно найти на странице
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется скриптом для создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения вручную.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'db_u0135561_3');

/** Имя пользователя MySQL */
define('DB_USER', 'dbu_u0135561_3');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'tU8Vov2smYU');

/** Имя сервера MySQL */
define('DB_HOST', 'mysql.u0135561.z8.ru');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '^|dW/sgZNk;xZOnr%/B9R7IUUF:&22P,G>Z7V0ts{$3Pz{1.+fH$z]NB{oLTAn/4');
define('SECURE_AUTH_KEY',  'r5*,OIi%,lihN31mN}}G2*,tl-//9ZPwgn_1|;NF8p0CXV A=*:KV . TYye7Xn.');
define('LOGGED_IN_KEY',    'KT=rxx(O+t29?hLU4,:Y=*!VH/%UBl$ab0glzp6-JNd3mO[6 |0?&G5D:lls5h$5');
define('NONCE_KEY',        'E*e:05s+7ehi/s^6/l^O4p5JP=OwST%=s+:D$I.WJ_]-~7D~x1Lktxby^U86qy`v');
define('AUTH_SALT',        ')!]O0cV@E~|U[[Rctt+oHA<Aq/D@62VX3V(8gFcO}_U<0qPXuiH);9Mj?2v7h,U@');
define('SECURE_AUTH_SALT', 'yv_6|?p/-#-|:}`~/sT+._fj0qUVI=7g`ImL;;*WRP@7s0)-WNF1e|oVi0PxS?)]');
define('LOGGED_IN_SALT',   'I={pexAx  WGg2W3$hM+AcACj,#$HbJ1}Ox_hROnrHxqm5NmzPCj REe*pl|3a/P');
define('NONCE_SALT',       '#s#r@NSIv)G[|amdS<d<tvkoAzG}Fq++-1=1Clsk2{~OMQ|58wN9He?/g?Va``L4');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', true);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
