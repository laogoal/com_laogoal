<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license     GNU General Public License version 2 or later; see license.txt
**/
 defined( '_JEXEC' ) or die( 'Restricted access' );

defined('_JEXEC') or die;

function LaogoalBuildRoute(array &$input) {
	$output = array();

	if (isset($input['match_id']) && $input['match_id']) {
		unset($input['league']);
		unset($input['view']);
	}
	return $output;
}
