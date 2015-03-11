<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license     GNU General Public License version 2 or later; see license.txt
**/
 defined( '_JEXEC' ) or die( 'Restricted access' );

class LAOGOALDataLoaderLeague extends LAOGOALDataLoader {

	private $league;
	function __construct($league, $ab = null) {
		$this->league = $league;
		parent::__construct($ab);
	}

	protected function abFetch() {
		$selector = $this->getSelectorInstance();
		switch ($this->getAbDirection()) {
			case self::LAOGOAL_MATCHES_AB_DIRECTION_FORWARD:
				$selector->appendOrder('begintime', 'ASC');
				$selector->begintime($this->getAbTime());
				break;

			case self::LAOGOAL_MATCHES_AB_DIRECTION_BACKWARD:
				$selector->appendOrder('begintime', 'DESC');
				$selector->begintime(null, $this->getAbTime());
				break;
		}
		return $selector->select(20);
	}

	protected function noABFetch() {
		$selector = $this->getSelectorInstance();
		$selector->appendOrder('begintime', 'ASC');
		$selector->begintime(mktime(0, 0, 0, gmdate('m'), intval(gmdate('d')) - 7));
		$result = $selector->select(40);

		if (!$result->count()) {
			$selector = $this->getSelectorInstance();
			$selector->appendOrder('begintime', 'DESC');
			$selector->begintime(null, mktime(0, 0, 0, gmdate('m'), intval(gmdate('d')) + 7));
			$result = $selector->select(40);
		}
		return $result;
	}

	protected function _filter(array &$items) {
		$lastMatchDay = null;
		$lastFixture = null;
		$config = JFactory::getConfig();
		$user = JFactory::getUser();
		$date = JFactory::getDate('now', 'UTC');
		$date->setTimeZone(new DateTimeZone($user->getParam('timezone', $config->get('offset'))));
		$tzOffset = $date->getOffset();

		foreach ($items as $i => $item) {
			$currentMatchDay = floor(($item->begintime + $tzOffset)/ 86400);
			$currentFixture = $item->details->f;
			if (is_null($lastMatchDay)) {
				$lastMatchDay = $currentMatchDay;
			}
			if (is_null($lastFixture)) {
				$lastFixture = $currentFixture;
			}

			if ($currentMatchDay != $lastMatchDay && $currentFixture != $lastFixture) {
				if (is_null($this->previous) && $currentMatchDay < $lastMatchDay) {
					$this->previous = $item;
				}
				if (is_null($this->next) && $currentMatchDay > $lastMatchDay) {
						$this->next = $item;
				}
				unset($items[$i]);
			} else {
				$lastMatchDay = $currentMatchDay;
			}
		}
	}

	protected function getSelectorInstance() {
		$selector = parent::getSelectorInstance();
		$selector->leagues((array) $this->league);
		return $selector;
	}
}