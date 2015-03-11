<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license     GNU General Public License version 2 or later; see license.txt
**/
 defined( '_JEXEC' ) or die( 'Restricted access' );


$groups  = array();
foreach ($this->table as $item) {
	$group = $item->details->group;
	if (!isset($groups[$group])) {
		$groups[$group] = array(
			'group' => $group,
			'items' => array()
		);
	}
	$groups[$group]['items'][] = $item;
}
?>

<?php foreach ($groups as $group) :
	$even = false;
	?>
	<table class="com_laogoal_standings_group">
		<thead>
		<tr class="com_laogoal_standings_row">
			<td class="com_laogoal_standings_row_position">&nbsp;</td>
			<td class=""><?php echo $this->escape(JText::_('Group'))?>&nbsp;<?php echo $this->escape(JText::_($group['group']))?></td>
			<td class="com_laogoal_standings_row_points"><?php echo JText::_("points")?></td>
			<td class="com_laogoal_standings_row_matches"><?php echo JText::_("matches")?></td>
			<td class="com_laogoal_standings_row_wdl"><?php echo JText::_("w / d / l")?></td>
			<td class="com_laogoal_standings_row_goals"><?php echo JText::_("goals")?></td>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($group['items'] as $item) :?>
<?php
			$this->even = ($even = !$even);
			$this->item = $item;
			include $this->getPath('row')
?>
		<?php endforeach;?>
		</tbody>
	</table>

<?php endforeach?>