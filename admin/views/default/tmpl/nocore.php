<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license     GNU General Public License version 2 or later; see license.txt
 **/
defined( '_JEXEC' ) or die( 'Restricted access' );
?><p>
	LaoGoaL component has dependency from <b>LaoGoaL Core</b> component which is not installed yet.
<br>
	You can install it yourself downloading
	<a href="<?php echo JComponentHelper::getParams('com_laogoal')->get('lgl_url') ?>">from here</a> or run
	installation from this page
	<a class="modal " rel="{handler: 'iframe', size:{x:500, y:350}}"
	   href="<?php echo JRoute::_('index.php?option=com_laogoal&task=coreinstall', false) ?>"
		>clicking here</a>

</p>

