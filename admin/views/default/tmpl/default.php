<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license     GNU General Public License version 2 or later; see license.txt
**/

defined( '_JEXEC' ) or die( 'Restricted access' );

JHtml::_('behavior.modal');

?>
<div class="laogoal_admin">
<?php if ($this->noCore) :?>
	<?php $this->display('nocore') ?>
<?php else : ?>
	<?php $this->display('core') ?>
<?php endif;?>
</div>