<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license     GNU General Public License version 2 or later; see license.txt
**/
 defined( '_JEXEC' ) or die( 'Restricted access' );

class LaogoalModelMatches extends JModelBase {

	function __construct(JRegistry $config = null) {
		parent::__construct($config);
		$this->populateState();
		$this->initLoader();
	}

	protected function populateState() {
		/**
		 * @var $app JApplicationWeb
		 */
		$app = JFactory::getApplication('site');
		$input = $app->input;
		$league = $input->get('league', $app->getParams()->get('league'));

		$stateVars = array();
		$stateVars['ab'] = $this->getAB();
		if ($league && 'all' != $league) {
			$stateVars['method'] = 'league';
			$stateVars['league'] = $league;
		} else {
			$stateVars['method'] = 'day';
			$stateVars['league'] = 'all';
		}
		$this->setState(new JRegistry($stateVars));
	}

	function isMultiLeague() {
		if (!isset($this->state['league']) || 'all' == $this->state['league']) {
			return true;
		}
		return false;
	}

	/**
	 * @var LAOGOALDataLoader
	 */
	private $loader;

	private function initLoader() {
		$fetcher = null;
		switch ($this->state['method']) {
			case 'day':
				$this->loader = new LAOGOALDataLoaderDay($this->state['ab']);
				break;

			case 'league':
				$this->loader = new LAOGOALDataLoaderLeague($this->state['league'], $this->state['ab']);
				break;
		}
	}


	function getAB() {

		$ab = JFactory::getApplication()->input->getInt('ab', null);

		if (($ababs = abs($ab)) && strlen($ababs) == 8) {
			list($year, $month, $day) = array(substr($ababs, 0, 4), substr($ababs, 4, 2), substr($ababs, 6, 2));
			if ($year > 2012 && $month > 0 && $month <= 12 && $day > 0 && $day <= 31) {
				$config = JFactory::getConfig();
				$user = JFactory::getUser();
				$date = JFactory::getDate('now', 'UTC');
				$date->setTimeZone(new DateTimeZone($user->getParam('timezone', $config->get('offset'))));
				$date->setDate($year, $month, $day);
				$date->setTime(0, 0, 0);
				$ababs = $date->getTimestamp();
				if ($ab < 0) {
					$ab = -($ababs + 86399);
				} else {
					$ab = $ababs;
				}
			}
		} else {
			$ab = null;
		}
		return $ab;
	}

	/**
	 * @var LGLDataSetMatch
	 */
	public $data;

	public function loadData() {
		if (is_null($this->data)) {
			$this->data = $this->loader->loadItems();
		}
	}

	/**
	 * @return LGLDataSetMatch
	 */
	function getMatches() {
		$this->loadData();
		return $this->data;
	}

	function getMatchesCount() {
		$this->loadData();
		return $this->data->count();
	}

	function getNext() {
		return $this->loader->loadNext();
	}

	function getPrevious() {
		return $this->loader->loadPrevious();
	}

	function getFirst() {
		return $this->getOne('first');
	}

	function getLast() {
		return $this->getOne('last');
	}

	/**
	 * @param string $which
	 * @return LGLDataItemMatch
	 */
	protected function getOne($which) {
		$this->loadData();
		if (!$this->data->count()) {
			return null;
		}
		$items = $this->data->getItems();
		$one = null;
		switch ($which) {
			case 'first':
				$one = array_shift($items);
				break;

			case 'last':
				$one = array_pop($items);
				break;
		}
		return $one;
	}
}
