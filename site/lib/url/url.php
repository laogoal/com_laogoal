<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license     GNU General Public License version 2 or later; see license.txt
**/
 defined( '_JEXEC' ) or die( 'Restricted access' );


class LAOGOALUrl {

	static function bindToMenu($url) {
		$uri = JUri::getInstance($url);
		$query = $uri->getQuery(true);
		if (!isset($query['option']) || 'com_laogoal' != $query['option']) {
			return $url;
		}

		if (!isset($query['view'])) {
			return $url;
		}

		$view = $query['view'];
		if ('match' == $view) {
			$view = 'matches';
		}
		$menu = self::getMenuItems();
		if (!isset($menu[$view])) {
			return $url;
		}

		$activeItem = null;
		if (isset($menu[$view][$query['league']])) {
			$activeItem = $menu[$view][$query['league']];
		} else {
			foreach ($menu as $leagues) {
				if (isset($leagues[$query['league']])) {
					$activeItem = $leagues[$query['league']];
					break;
				}
			}
		}

		if ($activeItem) {
			if (isset($activeItem->query['league']) && $activeItem->query['league']) {
				unset($query['league']);
			}
			if (isset($activeItem->query['view']) && $activeItem->query['view'] == $view) {
				unset($query['view']);
			}
			$query['Itemid'] = $activeItem->id;
			$uri->setQuery($query);
			$url = $uri->toString(array('path', 'query', 'fragment'));
		}
		return $url;
	}


	protected static function getMenuItems() {
		static $arr;
		if (is_null($arr)) {
			$arr = array(
				'matches' => array(),
				'standings' => array()
			);
			$menu = JFactory::getApplication()->getMenu();
			foreach ($menu->getItems(array('component'), array('com_laogoal')) as $item) {
				$query = $item->query;
				if (isset($query['view']) && isset($arr[$query['view']])) {
					if (isset($query['league']) && !empty($query['league'])) {
						$arr[$query['view']][$query['league']] = $item;
					}
				}
			}
		}
		return $arr;
	}
}
