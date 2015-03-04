<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

abstract class LAOGOALDataLoader {
	const LAOGOAL_MATCHES_AB_DIRECTION_FORWARD = 'forward';
	const LAOGOAL_MATCHES_AB_DIRECTION_BACKWARD = 'backward';

	abstract protected function abFetch();
	abstract protected function noABFetch();
	abstract protected function _filter(array &$items);

	function __construct($ab = null) {
		$this->setAb($ab);
	}

	private $ab;
	function getAbDirection() {
		if ($this->ab > 0) {
			return self::LAOGOAL_MATCHES_AB_DIRECTION_FORWARD;
		}
		if ($this->ab < 0) {
			return self::LAOGOAL_MATCHES_AB_DIRECTION_BACKWARD;
		}
		return null;
	}

	function getAbTime() {
		return abs($this->ab);
	}

	function setAb($ab) {
		$this->ab = $ab;
	}

	/**
	 * @var LGLDataSet
	 */
	protected $result;
	function loadItems() {
		if (is_null($this->result)) {
			if ($this->getAbDirection()) {
				$this->result = $this->abFetch();
			} else {
				$this->result = $this->noABFetch();
			}
			if (!($this->result instanceof LGLDataSet)) {
				return null;
			}
			$this->filter($this->result);
		}
		return $this->result;
	}

	protected $next;
	function loadNext() {
		$this->loadItems();
		if (is_null($this->next) && $this->result) {
			$this->next = $this->_loadPN('next');
		}
		return $this->next;
	}

	protected $previous;
	function loadPrevious() {
		$this->loadItems();
		if (is_null($this->previous) && $this->result) {
			$this->previous = $this->_loadPN('previous');
		}
		return $this->previous;
	}

	protected function _loadPN($pn) {
		$items = $this->result->getItems();
		$selector = $this->getSelectorInstance();
		if ('next' == $pn) {
			$item = array_pop($items);
			$selector->begintime($item->begintime + 10);
			$selector->appendOrder('begintime', 'ASC');
		}
		if ('previous' == $pn) {
			$item = array_shift($items);
			$selector->begintime(null, $item->begintime - 10);
			$selector->appendOrder('begintime', 'DESC');
		}
		$result  = $selector->select(1);
		if (!$result->count()) {
			return false;
		}
		$items = $result->getItems();
		return array_pop($items);
	}

	protected function getSelectorInstance() {
		$selector = new LGLDataSelectorMatch();
		$selector->published(true);
		return $selector;
	}

	protected function filter(LGLDataSet &$result) {
		$items = $result->getItems();
		$this->sortItemsByDifferenceWithAB($items);
		$this->_filter($items);
		$this->sortItemsByBeginTime($items);
		$result = new LGLDataSetMatch();
		foreach ($items as $item) {
			$result->addItem($item, $item->id);
		}
	}

	private function sortItemsByDifferenceWithAB(&$items) {
		$time = $this->getAbTime();
		if (!$time) {
			$config = JFactory::getConfig();
			$user = JFactory::getUser();
			$date = JFactory::getDate('now', 'UTC');
			$date->setTimeZone(new DateTimeZone($user->getParam('timezone', $config->get('offset'))));
			$date->setTime(12, 0, 0);
			$time = $date->getTimestamp();
		}
		usort($items, function ($a, $b) use ($time) {
			$aa = abs($a->begintime - abs($time));
			$bb = abs($b->begintime - abs($time));

			if ($aa > $bb) {
				return 1;
			}
			if ($aa < $bb) {
				return -1;
			}
			return 0;
		});
	}

	private function sortItemsByBeginTime(&$items) {
		usort($items, function ($a, $b) {
			$aa = $a->begintime;
			$bb = $b->begintime;

			if ($aa > $bb) {
				return 1;
			}
			if ($aa < $bb) {
				return -1;
			}
			return 0;
		});
	}
}
