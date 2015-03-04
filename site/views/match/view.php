<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/


require_once(JPATH_COMPONENT . '/models/match.php');
class LaogoalViewMatch extends JViewHtml {

	protected $days = array();
	function __construct() {
		$this->paths = $this->loadPaths();
		$this->paths->insert(dirname(__FILE__) . '/tmpl', 0);
		$this->model = new LaogoalModelMatch();

		/** @var $doc JDocumentHTML */
		$doc = JFactory::getDocument();
		$doc->addStyleSheet(JUri::base(true) . '/media/com_laogoal/css/style.css');
		$doc->addStyleSheet(JUri::base(true) . '/media/com_laogoal/css/match.css');
		JHTML::_('behavior.framework',true);
		$doc->addScript(JUri::base(true) . '/media/com_lgl/js/ticker.js');
		$doc->addScript(JUri::base(true) . '/media/com_laogoal/js/updates.js');
	}
}