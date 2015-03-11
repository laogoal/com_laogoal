<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license     GNU General Public License version 2 or later; see license.txt
**/

defined( '_JEXEC' ) or die( 'Restricted access' );


class LaogoalController extends JControllerBase {
	/**
	 * @var JApplicationCms
	 */
	protected  $app;

	function __construct() {
		JLoader::registerPrefix('LAOGOAL', JPATH_SITE . '/components/com_laogoal/lib');
		$this->app = $this->loadApplication();
		$this->input = $this->loadInput();
	}

	function execute() {

		$lang = JFactory::getLanguage();
		$lang->load('com_lgl');
		$lang->load('com_lgl_teams');
//		$lang->load('com_lgl_teams_fullname');

		$viewName = $this->input->get('view', 'matches');
		if ($this->input->get('match_id')) {
			$viewName = 'match';
		}
		require_once(JPATH_COMPONENT . '/views/' . strtolower($viewName) . '/view.php');

		$viewClass = 'LaogoalView' . ucfirst($viewName);

		/** @var $view JViewHtml */
		$view = new $viewClass();
		echo $view->render();
	}
}