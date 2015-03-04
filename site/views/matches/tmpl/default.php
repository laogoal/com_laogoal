<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

/** @var $model LaogoalModelMatches */
$model = $this->model;
?>
<div id="com_laogoal_content" class="com_laogoal_widget com_laogoal_matches">
	<div class="com_laogoal_widget_wrapper">
	<?php if ($model->getMatchesCount()) :?>
		<?php include $this->getPath('list'); ?>
	<?php else :?>
		<?php include $this->getPath('empty'); ?>
	<?php endif; ?>
	</div>
</div>
