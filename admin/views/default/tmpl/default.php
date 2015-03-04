<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

JHtml::_('behavior.modal');

?>
<div class="laogoal_admin">
<?php if ($this->noCore) :?>
	<?php $this->display('nocore') ?>
<?php else : ?>
	<?php $this->display('core') ?>
<?php endif;?>
</div>