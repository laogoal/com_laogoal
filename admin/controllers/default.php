<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license     GNU General Public License version 2 or later; see license.txt
**/

defined( '_JEXEC' ) or die( 'Restricted access' );


class LaogoalControllerDefault extends JControllerBase {
	/**
	 * @var JApplicationCms
	 */
	protected  $app;

	function __construct() {
		$this->app = $this->loadApplication();
		$this->input = $this->loadInput();
	}

	function execute() {
		JToolbarHelper::title(JText::_('LaoGoaL'), 'inbox.png');
		require_once(JPATH_COMPONENT . '/views/default/view.php');
		$view = new LaogoalViewDefault();
		$lglLibPath = JPATH_SITE . '/components/com_lgl/lib';
		if (is_readable($lglLibPath)) {
			JLoader::registerPrefix('LGL', $lglLibPath);
			$view->noCore = false;
		} else {
			$view->noCore = true;
		}
		$view->display();
	}
}