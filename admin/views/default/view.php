<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

class LaogoalViewDefault extends JViewHtml {

	public $noCore;

	function __construct() {
		$this->paths = $this->loadPaths();
		$this->paths->insert(dirname(__FILE__) . '/tmpl', 0);
		JToolbarHelper::preferences('com_lgl');
	}

	function display($tpl = 'default') {
		$this->setLayout($tpl);
		echo $this->render();
	}
}