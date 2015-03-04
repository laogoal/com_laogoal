<?php
/**
 * @package Soccer Scores component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2013 - Murat Erkenov
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

$even = false;
?>
<table class="com_laogoal_standings_nogroups">
	<thead>
	<tr class="com_laogoal_standings_row">
		<td class="com_laogoal_standings_row_position">&nbsp;</td>
		<td class="com_laogoal_standings_row_team"></td>
		<td class="com_laogoal_standings_row_points"><?php echo JText::_("points")?></td>
		<td class="com_laogoal_standings_row_matches"><?php echo JText::_("matches")?></td>
		<td class="com_laogoal_standings_row_wdl"><?php echo JText::_("w / d / l")?></td>
		<td class="com_laogoal_standings_row_goals"><?php echo JText::_("goals")?></td>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($this->table as $item) :?>
		<?php
		$this->even = ($even = !$even);
		$this->item = $item;
		include $this->getPath('row')
		?>
	<?php endforeach;?>
	</tbody>
</table>
