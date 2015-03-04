<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

$isActive = false;
if ('online' == $this->item->status) {
	if (in_array($this->item->current->period, array('1T', '2T', 'ET', 'PS'))) {
		$isActive = true;
	}
}

$matchData = array(
	'crc' => $this->item->crc,
	'sts' => $this->item->begintime,
	'current' => $this->item->current->jsonSerialize(),
	'score' => $this->item->score,
	'status' => $this->item->status
);
?>

<tr class="com_laogoal_match_item
<?php if ($isActive) :?>com_laogoal_status_active<?php endif;?>
		com_laogoal_status_<?php echo $this->escape($this->item->status)?>
		<?php if($this->even) :?>even<?php endif ?>"
	data-match_id="<?php echo $this->escape($this->item->id)?>"
	data-match='<?php echo json_encode($matchData) ?>'>
		<td class="com_laogoal_begintime">
<?php echo JHtml::date($this->item->begintime, "H:i");?>
		</td>
		<td class="com_laogoal_match_status">
			<?php if ('online' == $this->item->status) :?>
					<?php if ($this->item->current->minute > 0) :?>
						<?php echo $this->item->current->minute ?>
					<?php else :?>
						<?php echo $this->escape(JText::_($this->item->current->period))?>
					<?php endif ?>
			<?php else: ?>
				<?php echo $this->escape(JText::_($this->item->status))?>
			<?php endif;?>
		</td>
		<td class="com_laogoal_match_c">
<a class="com_laogoal_match_item_link" href="<?php echo JRoute::_(LAOGOALUrl::bindToMenu('index.php?option=com_laogoal&league=' . $this->item->league . '&view=match&match_id=' . $this->item->id, 0)) ?>">
	<span class="com_laogoal_match_team com_laogoal_match_team1 com_laogoal_match_team_<?php echo $this->escape($this->item->hosts)?>"><?php echo $this->escape(JText::_($this->item->hosts))?></span>
	<span class="com_laogoal_match_result"><?php echo $this->item->score[0]?>&nbsp;-&nbsp;<?php echo $this->item->score[1]?></span>
	<span class="com_laogoal_match_team com_laogoal_match_team2 com_laogoal_match_team_<?php echo $this->escape($this->item->guests)?>"><?php echo $this->escape(JText::_($this->item->guests))?></span>
</a>
		</td>
	</tr>
