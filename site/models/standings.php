<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/


class LaogoalModelStandings extends JModelBase {

	function __construct() {
		parent::__construct();
		$this->populateState();
	}

	protected function populateState() {
		/**
		 * @var $app JSite
		 */
		$app = JFactory::getApplication('site');
		$this->state->set('league', $app->input->get('league', $app->getParams()->get('league')));
	}

	/**
	 * @return LGLDataSetStandings
	 * @throws InvalidArgumentException
	 */
	function getStandingsTable() {
		$leagueId = $this->state->get('league');
		if (empty($leagueId)) {
			throw new InvalidArgumentException("League ID not specified");
		}

		$selector = new LGLDataSelectorStandings();
		$selector->league($leagueId);
		return $selector->select();
	}

	/**
	 * @return object
	 */
	function getLeagueId() {
		return $this->state->get('league');
	}

}