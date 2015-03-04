<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/


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