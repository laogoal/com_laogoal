<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license     GNU General Public License version 2 or later; see license.txt
**/

defined( '_JEXEC' ) or die( 'Restricted access' );


class LaogoalModelMatch extends JModelBase {

	function __construct(JRegistry $config = null) {
		parent::__construct($config);
		$this->populateState();
	}

	protected function populateState() {
		$this->setState(
			new JRegistry(
				array('match_id' => JFactory::getApplication('site')->input->get('match_id'))
			)
		);
	}

	function getMatch() {
		$matchId = $this->state->get('match_id');
		if (empty($matchId)) {
			throw new InvalidArgumentException("Match ID not specified");
		}

		$selector = new LGLDataSelectorMatch();
		$selector->id($matchId);
		$result = $selector->select(1);
		if (!$result->count()) {
			throw new InvalidArgumentException("Match not found");
		}
		$items = $result->getItems();
		return array_pop($items);
	}
}