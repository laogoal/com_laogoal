<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

defined('_JEXEC') or die('Restricted access');
require_once(__DIR__ . '/leaguechoice.php');
class JFormFieldLeagueChoiceMatches extends JFormFieldLeagueChoice {
	protected $type = 'LeagueChoiceMatches';
	protected function getOptions() {

		$options = array();
		$options[] = JHtml::_('select.option', 'all', JText::_('LAOGOAL_LEAGUECHOICE_OPTION_ALL_LABEL'));
		foreach (LGLConfig::getAvailableLeagues() as $league) {
			$options[] = JHtml::_('select.option', $league, JText::_($league));
		}
		return $options;
	}
}