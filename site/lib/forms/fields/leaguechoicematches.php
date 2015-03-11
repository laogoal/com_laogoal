<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license     GNU General Public License version 2 or later; see license.txt
**/
 defined( '_JEXEC' ) or die( 'Restricted access' );

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