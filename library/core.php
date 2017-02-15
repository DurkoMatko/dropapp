<?

define('CORE',true);

session_name('core');
session_start();

# load configuration file
require('config.php');

# load database library
require('lib/database.php');

# connect to database
db_connect($settings['db_host'],$settings['db_user'],$settings['db_pass'],$settings['db_database']);

# get settings from settings table
$result = db_query('SELECT code, value FROM settings');
while($row = db_fetch($result)) $settings[$row['code']] = $row['value'];
$settings['showhistory'] = db_tableexists('history');

$locale = db_row('SELECT locale FROM languages WHERE code = :lan',array('lan'=>$settings['cms_language']));
setlocale(LC_ALL, $locale);
mb_internal_encoding("UTF-8");

# load translate library
require('lib/translate.php');

# load Smarty (depends on database and translate)
require 'smarty/libs/Smarty.class.php';

# load other libraries
require('lib/smarty.php');
require('lib/errorhandling.php');
require('lib/session.php');
require('lib/tools.php');
require('lib/mail.php');

# load CMS specific libraries
require('lib/form.php');
require('lib/list.php');
require('lib/formhandler.php');

if (!$login) checksession(); #check if a valid session exists; if none, redirect to loginpage