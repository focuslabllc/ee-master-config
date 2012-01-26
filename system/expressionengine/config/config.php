<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| ExpressionEngine Config Items
|--------------------------------------------------------------------------
|
| The following items are for use with ExpressionEngine.  The rest of
| the config items are for use with CodeIgniter, some of which are not
| observed by ExpressionEngine, e.g. 'permitted_uri_chars'
|
*/

$config['app_version']    = '2xx';
$config['install_lock']   = '';
$config['license_number'] = 'xxxx-xxxx-xxxx-xxxx';
$config['doc_url']        = 'http://expressionengine.com/user_guide/';
$config['site_label']     = 'Your Company';
// END EE config items



// ---------------------------------------------------------------
// Numerous CodeIgniter config settings go here. We've removed
// them for breviety in our repository code example
// 
// DO NOT DELETE THE CONFIG SETTINGS THAT WOULD TYPICALLY APPEAR
// HERE. THEY ARE CodeIgniter SETTINGS REQUIRED TO RUN EE PROPERLY
// 
// The config values start with "base_url" and go to "proxy_ips"
// ---------------------------------------------------------------



/**
 * Require the Focus Lab, LLC Master Config file
 */
require $_SERVER['DOCUMENT_ROOT'] . '/../config/config.master.php';

/* End of file config.php */
/* Location: ./system/expressionengine/config/config.php */