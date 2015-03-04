<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

/**
 * @var $item LGLDataItemMatch
 */
$item = $this->model->getMatch();
$events = $item->events;

$isActive = false;
if ('online' == $item->status) {
	if (in_array($item->current->period, array('1T', '2T', 'ET', 'PS'))) {
		$isActive = true;
	}
}
$matchData = array(
	'crc' => $item->crc,
	'sts' => $item->begintime,
	'current' => $item->current->jsonSerialize(),
	'score' => $item->score,
	'status' => $item->status
);
?>
<div id="com_laogoal_content" class="com_laogoal_widget com_laogoal_match">
	<div class="com_laogoal_match_item <?php if ($isActive) :?>com_laogoal_status_active<?php endif;?>
		com_laogoal_status_<?php echo $this->escape($item->status)?>"
		data-match_id="<?php echo $this->escape($item->id)?>" data-match='<?php echo json_encode($matchData) ?>'>

		<div class="com_laogoal_match_c">
				<span class="com_laogoal_match_team com_laogoal_match_team1 com_laogoal_match_team_<?php echo $this->escape($item->hosts)?>"><?php echo $this->escape(JText::_($item->hosts))?></span>
				<span class="com_laogoal_match_result"><?php echo $item->score[0]?>&nbsp;-&nbsp;<?php echo $item->score[1]?></span>
				<span class="com_laogoal_match_team com_laogoal_match_team2 com_laogoal_match_team_<?php echo $this->escape($item->guests)?>"><?php echo $this->escape(JText::_($item->guests))?></span>
		</div>
		<div class="com_laogoal_match_status">
			<?php if ('online' == $item->status) :?>
				<?php if ($item->current->minute > 0) :?>
					<?php echo $item->current->minute ?>
				<?php else :?>
					<?php echo $this->escape(JText::_($item->current->period))?>
				<?php endif ?>
			<?php else: ?>
				<?php echo $this->escape(JText::_($item->status))?>
			<?php endif;?>
		</div>
		<br>

	<?php if ($events instanceof Countable && $events->count()) :
		/**
		 * @var ArrayIterator $events
		 */
		$events = array_reverse($events->getArrayCopy());
		$i = 0;

		?>

	   <table class="com_laogoal_match-events">
		  <?php foreach ($events as $event) : $i++?>
		  <tr class="com_laogoal_event-<?php echo $this->escape($event->e)?>
		  <?php if ($i%2) :?>even<?php endif;?>
		  com_laogoal_event_team<?php echo $event->t?>">
			 <td class="com_laogoal_event_minute">
	<?php if ('ps' != strtolower($event->m)) :?>
		<?php echo $this->escape($event->m)?>'
	<?php endif;?>
			 </td>
			 <td class="com_laogoal_event_score" >
	   <?php if (isset($event->s) && in_array($event->e, array('g', 'pg', 'og'))) :?>
		  [<?php echo $this->escape($event->s[0])?> - <?php echo $this->escape($event->s[1])?>]
	   <?php endif;?>
			 </td>
			 <td class="com_laogoal_event_player">
		  <?php echo $this->escape($event->p)?>
	<?php if (in_array($event->e, array('pg', 'og'))) :?>
		(<?php echo $this->escape(JText::_($event->e))?>)
	<?php endif;?>
			 </td>
			  <td>&nbsp;</td>
		  </tr>
		  <?php endforeach;?>
	   </table>
	<?php endif;?>
	</div>
<br />
	<div class="com_laogoal_begintime">
		<?php echo $this->escape(JHtml::date($item->begintime, 'M d, Y H:i'))?>
		<br />
		<?php echo $this->escape(JText::_($item->league)) ?>,
		<?php if ($item->details) :?>
			<?php
			$detailsStrings = array();
			?>
			<?php if ($item->details->s) :?>
				<?php $detailsStrings[] = $this->escape(JText::_('Season')) . ': ' . $this->escape($item->details->s) ?>
			<?php endif ;?>
			<?php if ($item->details->t) :?>
				<?php $detailsStrings[] = $this->escape(JText::_($item->details->t . '_ROUND')) ?>
			<?php endif ;?>
			<?php if ($item->details->u) :?>
				<?php $detailsStrings[] = $this->escape(JText::_('PLAYOFF_STAGE_' . $item->details->u)) ?>
			<?php endif ;?>
			<?php if ($item->details->l) :?>
				<?php $detailsStrings[] = $this->escape(JText::_('PLAYOFF_LEG_' . $item->details->l)) ?>
			<?php endif ;?>
			<?php if ($item->details->g) :?>
				<?php $detailsStrings[] = $this->escape(JText::_('Group')) . ': ' . $this->escape($item->details->g)?>
			<?php endif ;?>
			<?php if ($fixture = $item->details->f) :
				$fixtureString = '';
				?>
				<?php if ($fixture > 0) :?>
					<?php $fixtureString .= $this->escape(JText::_('Matchday '))?>
				<?php endif; ?>
				<?php $fixtureString .= $this->escape($item->details->f) ?>
				<?php $detailsStrings[] = $fixtureString?>
			<?php endif ;?>

			<?php echo implode(', ', $detailsStrings) ?>
		<?php endif ?>
	</div>
</div>
