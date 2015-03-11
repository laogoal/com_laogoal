<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license     GNU General Public License version 2 or later; see license.txt
 **/ defined( '_JEXEC' ) or die( 'Restricted access' );
?><tr class="com_laogoal_standings_row
	com_laogoal_standings_row_<?php echo $this->escape($this->item->team)?>
	<?php if($this->even) :?>even<?php endif ?>">
	<td class="com_laogoal_standings_row_position">
		<?php echo $this->escape($this->item->position)?>.&nbsp;
	</td>

	<td class="com_laogoal_standings_row_team">
		<?php echo $this->escape(JText::_($this->item->team))?>
	</td>

	<td class="com_laogoal_standings_row_points">
		<?php echo $this->escape($this->item->points)?>
	</td>

	<td class="com_laogoal_standings_row_matches">
		<?php echo $this->escape($this->item->matches->played)?>
	</td>

	<td class="com_laogoal_standings_row_wdl">
		<?php echo $this->escape($this->item->matches->won)?>
		/
		<?php echo $this->escape($this->item->matches->drawn)?>
		/
		<?php echo $this->escape($this->item->matches->lost)?>
	</td>

	<td class="com_laogoal_standings_row_goals">
		<?php echo $this->escape($this->item->goals->scored)?> - <?php echo $this->escape($this->item->goals->conceded)?>
	</td>
</tr>
