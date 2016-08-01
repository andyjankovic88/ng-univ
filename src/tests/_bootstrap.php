<?php
// This is global bootstrap for autoloading
//18/09/15 - #5390 - Jaymit - Set up PHP Unit Test Environment for API, bootstrap configuration for codeception to work with codeigniter.
//Reference url: https://github.com/fmalk/codeigniter-phpunit
/*
 *---------------------------------------------------------------
 * OVERRIDE FUNCTIONS
 *---------------------------------------------------------------
 *
 * This will "override" later functions meant to be defined
 * in core\Common.php, so they throw errors instead of output strings
 */

function show_error($message, $status_code = 500, $heading = 'An Error Was Encountered')
{
	throw new PHPUnit_Framework_Exception($message, $status_code);
}

function show_404($page = '', $log_error = TRUE)
{
	throw new PHPUnit_Framework_Exception($page, 404);
}

/*
 *---------------------------------------------------------------
 * BOOTSTRAP
 *---------------------------------------------------------------
 *
 * Bootstrap CodeIgniter from index.php as usual
 */

//18/09/15 - #5390 - Jaymit - Set up PHP Unit Test Environment for API, bootstrap configuration for codeception to work with codeigniter, important constant for unit testing bootstraping.
define('PHPUNIT_TEST',"1");
define('REMOTE_ADDR',"0.0.0.0");
require_once dirname(__FILE__) . '/../index.php';
