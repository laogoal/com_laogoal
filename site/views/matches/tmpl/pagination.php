<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

$now = time();
/** @var $model LaogoalModelMatches */
$model = $this->model;
$nextOne = $model->getNext();
$previousOne = $model->getPrevious();
$showToday = false;
if (floor($model->getFirst()->begintime/86400) != floor($now/86400)) {
	$showToday = true;
}
$isMultiLeague = $model->isMultiLeague();
?>
<div class="com_laogoal_pagination">
	<ul>
		<li class="com_laogoal_pagination_previous">
	<?php if ($previousOne) :?>
			<a href="<?php echo $this->abUrl($previousOne->begintime, 'backward')?>">
	<?php if ($isMultiLeague) :?>
			<?php echo $this->escape(ucfirst(JHtml::date($previousOne->begintime, 'F d')))?>
		<?php else :?>
			<?php echo $this->escape(JText::_('Day'))?>
			<?php echo $this->escape(JText::_($previousOne->details->f))?>
	<?php endif; ?>
				&larr;&nbsp;
			</a>
	<?php endif; ?>
		</li>
		<li class="com_laogoal_pagination_today">
	<?php if ($showToday) :?>
			<a href="<?php echo $this->abUrl()?>"><?php echo $this->escape(JText::_('today'))?></a>
	<?php endif?>
		</li>
		<li class="com_laogoal_pagination_next">
	<?php if ($nextOne) :?>
			<a href="<?php echo $this->abUrl($nextOne->begintime, 'forward')?>">
				&nbsp;&rarr;
				<?php if ($isMultiLeague) :?>
					<?php echo $this->escape(ucfirst(JHtml::date($nextOne->begintime, 'F d')))?>
				<?php else :?>
					<?php echo $this->escape(JText::_('Day'))?>
					<?php echo $this->escape(JText::_($nextOne->details->f))?>
				<?php endif; ?>
			</a>
	<?php endif; ?>
		</li>
	</ul>
</div>
<div style="clear: both;"></div>