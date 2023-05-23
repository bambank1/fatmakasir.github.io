<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array();

$config['home'] = 'posapp.go';
$config['api']  = 'api.posapp.go';
$config['demo'] = 'demo.posapp.com';

/*
	Define the SITE constant.
*/
foreach ($config as $site => $host)
	if ($_SERVER['HTTP_HOST'] === $host)
	{
		define('SITE', $site);

		break;
	}


/* End of file hosts.php */
/* Location: ./application/config/hosts.php */