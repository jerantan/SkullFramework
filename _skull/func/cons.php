<?php
// Override In Config
/* ================================================================================================ */
// Client Info
define('project', $config['project']);
define('firm', $config['firm']);
define('site', $config['site']);
/* ================================================================================================ */

// Alphanumeric
define('alphanumeric', '0123456789AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz');

// Upload Directory
define('upload', base.'share/');

// Date Set
define('date_time', 'Y-m-d H:i:s');
define('date', date(date_time));
define('now', date('m/d/Y'));

// Date Process
define('saving', 'Y-m-d');

// Date Format
define('numeric', 'm/d/Y');
define('alpha', 'M d, Y');

// JS Date Format
define('js_numeric', 'mm/dd/yy');
define('js_alpha', 'M dd, yy');

// Timeout
define('timeout', 500);

// Delay
define('delay', 1500);

// Fadeout
define('fadeout', 1500);

// Scroll
define('scroll', 500);

// Offset
define('offset', 130);

// Fine
define('fine', 'Please wait.');

// Override In Config And Spec
/* ================================================================================================ */
// Time Zone
date_default_timezone_set($config['timezone']);

// Term
define('term', $config['term']);

// Currency
define('symbol', $config['symbol']);

// Environment
define('env', $config['env']);

// DB Connection
define('dbhost', $config['dbhost']);
define('dbuser', $config['dbuser']);
define('dbpass', $config['dbpass']);
define('dbname', $config['dbname']);

// Sign in Table
define('tbl', $config['tbl']);

// Upload Format
define('image', $config['image']);
define('audio', $config['audio']);
define('video', $config['video']);

// Theme
define('html', $config['theme']['html']);
/* Default is black */
define('main', $config['theme']['main']);
/* Default is gray */
define('font', $config['theme']['font']);
/* Default is white */
define('hove', $config['theme']['hove']);
/* Default is 0.5 */
define('opac', $config['theme']['opac']);

// Spec
define('session', root.' - '.domain);
/* ================================================================================================ */
?>