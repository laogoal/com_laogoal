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
JLoader::registerPrefix('LGL', JPATH_SITE . '/components/com_lgl/lib');

/** @var $app JApplicationBase */
$app = JFactory::getApplication();

require_once(JPATH_COMPONENT . '/controller.php');

try {
	/** @var $controller LaogoalController */
	$controller = new LaogoalController();
	$controller->execute();
} catch (Exception $x) {
	echo $x->getMessage();
}

