<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license     GNU General Public License version 2 or later; see license.txt
**/
 defined( '_JEXEC' ) or die( 'Restricted access' );

defined('_JEXEC') or die('Restricted access');
JLoader::registerPrefix('LGL', JPATH_SITE . '/components/com_lgl/lib');
JFactory::getLanguage()->load('com_laogoal.sys', JPATH_SITE, null, false, false);
JFactory::getLanguage()->load('com_lgl', JPATH_SITE, null, false, false);

require_once(JPATH_LIBRARIES . '/joomla/form/fields/list.php');

class JFormFieldLeagueChoice extends JFormFieldList {

	protected $type = 'LeagueChoice';

	protected function getOptions() {

		$options = array();
		foreach (LGLConfig::getAvailableLeagues() as $league) {
			$options[] = JHtml::_('select.option', $league, JText::_($league));
		}
		return $options;
	}
}