<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Development config overrides & db credentials
 * 
 * Our database credentials and any environment-specific overrides
 * 
 * @package    Focus Lab Master Config
 * @version    1.1.1
 * @author     Focus Lab, LLC <dev@focuslabllc.com>
 */

//single database usage
$env_db['hostname'] = 'localhost';
$env_db['username'] = '';
$env_db['password'] = '';
$env_db['database'] = '';


$env_config['webmaster_email'] = 'dev@domain.com';

/**
Example of multiple database usage
$env_db['expressionengine']['hostname'] = '';
$env_db['expressionengine']['username'] = '';
$env_db['expressionengine']['password'] = '';
$env_db['expressionengine']['database'] = '';

$env_db['another_db']['hostname'] = '';
$env_db['another_db']['username'] = '';
$env_db['another_db']['password'] = '';
$env_db['another_db']['database'] = '';
$env_db['another_db']['dbprefix'] = '';
$env_db['another_db']['swap_pre'] = '';
$env_db['another_db']['dbdriver'] = 'mysql';
$env_db['another_db']['pconnect'] = FALSE;
$env_db['another_db']['db_debug'] = TRUE;
$env_db['another_db']['cache_on'] = FALSE;
$env_db['another_db']['autoinit'] = FALSE;
$env_db['another_db']['char_set'] = 'utf8';
$env_db['another_db']['dbcollat'] = 'utf8_general_ci';
$env_db['another_db']['cachedir'] = '';
*/

$env_config['webmaster_email'] = 'dev@domain.com';


/* End of file config.dev.php */
/* Location: ./config/config.dev.php */