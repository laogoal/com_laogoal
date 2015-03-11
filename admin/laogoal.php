<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license     GNU General Public License version 2 or later; see license.txt
**/

defined( '_JEXEC' ) or die( 'Restricted access' );


defined('_JEXEC') or die;

if (!defined('JPATH_COMPONENT')) {
	define('JPATH_COMPONENT', dirname(__FILE__));
}

/** @var $app JApplicationBase */
$app = JFactory::getApplication();

$controllerName = $app->input->get('view', $app->input->get('task', 'default'));
require_once(JPATH_COMPONENT . '/controllers/' . strtolower($controllerName) . '.php');
$controllerClass = 'LaogoalController' . ucfirst($controllerName);

/** @var $controller JControllerBase */
$controller = new $controllerClass();
$controller->execute();

