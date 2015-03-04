<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

class LAOGOALDataLoaderDay extends LAOGOALDataLoader {

	protected function abFetch() {
		$selector = $this->getSelectorInstance();
		switch ($this->getAbDirection()) {
			case self::LAOGOAL_MATCHES_AB_DIRECTION_FORWARD:
				$selector->begintime($this->getAbTime());
				$selector->appendOrder('begintime', 'ASC');
				break;

			case self::LAOGOAL_MATCHES_AB_DIRECTION_BACKWARD:
				$selector->appendOrder('begintime', 'DESC');
				$selector->begintime(null, $this->getAbTime());
				break;
		}
		return $selector->select(128);
	}

	protected function noABFetch() {

		$config = JFactory::getConfig();
		$user = JFactory::getUser();
		$date = JFactory::getDate('now', 'UTC');
		$date->setTimeZone(new DateTimeZone($user->getParam('timezone', $config->get('offset'))));
		$date->setTime(0, 0, 0);
		$midnight = $date->getTimestamp();

		$selector = $this->getSelectorInstance();
		$selector->appendOrder('begintime', 'ASC');
		$selector->begintime($midnight - 86400);
		$result = $selector->select(256);

		if (!$result->count()) {
			$selector = $this->getSelectorInstance();
			$selector->appendOrder('begintime', 'DESC');
			$selector->begintime(null, $midnight + 86400);
			$result = $selector->select(256);
		}
		return $result;
	}

	protected function _filter(array &$items) {
		$actualMatchDay = null;
		$config = JFactory::getConfig();
		$user = JFactory::getUser();
		$date = JFactory::getDate('now', 'UTC');
		$date->setTimeZone(new DateTimeZone($user->getParam('timezone', $config->get('offset'))));
		$tzOffset = $date->getOffset();
		foreach ($items as $i => $item) {
			$currentItemBeginTime = $item->begintime;
			$currentMatchDay = floor(($currentItemBeginTime + $tzOffset) / 86400);
			if (is_null($actualMatchDay)) {
				$actualMatchDay = $currentMatchDay;
			}
			if ($actualMatchDay != $currentMatchDay) {
				if ($currentMatchDay < $actualMatchDay) {
					if (is_null($this->previous)) {
						$this->previous = $item;
					} else if ($currentItemBeginTime > $this->previous->begintime) {
						$this->previous = $item;
					}
				}
				if ($currentMatchDay > $actualMatchDay) {
					if (is_null($this->next)) {
						$this->next = $item;
					} else if ($currentItemBeginTime < $this->next->begintime) {
						$this->next = $item;
					}
				}
				unset($items[$i]);
			}
		}
	}

	protected function getSelectorInstance() {
		$selector = parent::getSelectorInstance();
		$selector->leagues(LGLConfig::getAvailableLeagues());
		return $selector;
	}
}