<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/


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

