<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Production config overrides & db credentials
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

// Sample global variable for Production only
// Can be used in templates like "{global:google_analytics}"
$env_global['global:google_analytics'] = 'UA-XXXXXXX-XX';

/* End of file config.local.php */
/* Location: ./config/config.local.php */
