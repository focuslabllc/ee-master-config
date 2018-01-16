<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Staging config overrides & db credentials
 *
 * Our database credentials and any environment-specific overrides
 *
 * @package    Focus Lab Master Config
 * @version    2.2.0
 * @author     Focus Lab, LLC <dev@focuslabllc.com>
 */

$env_config['database'] = array (
	'expressionengine' => array (
		'hostname' => 'localhost',
		'username' => '',
		'password' => '',
		'database' => '',
		'dbdriver' => 'mysqli',
		'dbprefix' => 'exp_',
		'pconnect' => FALSE
	),
);


// Local testing email address
$env_config['webmaster_email'] = '';


/* End of file config.local.php */
/* Location: ./config/config.local.php */
