<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

defined('_JEXEC') or die;

function LaogoalBuildRoute(array &$input) {
	$output = array();

	if (isset($input['match_id']) && $input['match_id']) {
		unset($input['league']);
		unset($input['view']);
	}
	return $output;
}
