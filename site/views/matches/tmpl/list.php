<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license     GNU General Public License version 2 or later; see license.txt
**/
 defined( '_JEXEC' ) or die( 'Restricted access' );

$leagueNameAsLink = false;
$showStandingsLeague = false;
/** @var $model LaogoalModelMatches */
$model = $this->model;
if ($model->isMultiLeague()) {
	$leagueNameAsLink = true;
} else {
	$showStandingsLeague = true;
}
$leagues = array();
foreach ($model->getMatches() as $item) {
	if (!isset($leagues[$item->league])) {
		$leagues[$item->league] = array(
			'league' => $item->league,
			'items' => array()
		);
	}
	$leagues[$item->league]['items'][$item->id] = $item;
}
$prevDay = null;

$config = JFactory::getConfig();
$user = JFactory::getUser();
$date = JFactory::getDate('now', 'UTC');
$date->setTimeZone(new DateTimeZone($user->getParam('timezone', $config->get('offset'))));
$tzOffset = $date->getOffset();

?>
<?php foreach ($leagues as $leagueId => $row) :
	$even = false;
	?>
	<table class="com_laogoal_match">
		<tbody>
		<tr class="com_laogoal_league com_laogoal_league_<?php echo $this->escape($leagueId)?>">
			<th colspan="3" class="com_laogoal_flag">
				<?php if ($leagueNameAsLink) :?>
					<a href="<?php echo JRoute::_(LAOGOALUrl::bindToMenu('index.php?option=com_laogoal&view=matches&league=' . urlencode($leagueId)))?>"><?php echo $this->escape(JText::_($leagueId))?></a>
				<?php else :?>
					<?php echo $this->escape(JText::_($leagueId))?>
				<?php endif ?>
				<?php if ($showStandingsLeague) :?>
					<span class="com_laogoal_show-standings">
				<a href="<?php echo JRoute::_(LAOGOALUrl::bindToMenu('index.php?option=com_laogoal&view=standings&league=' . urlencode($leagueId)))?>"><?php echo $this->escape(JText::_('Show Standings'))?></a>
			</span>
				<?php endif ?>
			</th>
		</tr>
		<?php foreach ($row['items'] as $item) :?>
			<?php if (floor(($item->begintime + $tzOffset) / 86400) != $prevDay) :
				$prevDay = floor(($item->begintime  + $tzOffset) / 86400);?>
				<tr class="com_laogoal_date-separator">
					<th colspan="3">
						<?php echo $this->escape(JHtml::date($item->begintime, 'M d, l')) ?>
					</th>
				</tr>
			<?php endif;?>
			<?php
			$this->even = $even = !$even;
			$this->item = $item;
			include $this->getPath('item');
			?>
		<?php endforeach?>
		</tbody>
	</table>
<?php endforeach;?>
<?php include $this->getPath('pagination'); ?>

<script type="text/javascript">
	var updater = window.COM_LAOGOAL_Updater.createInstance(
		'#com_laogoal_content',
		<?php echo $now ?>
	);
	window.LGLTicker.createTicker(
		'<?php echo JUri::base()?>',
		<?php echo $now ?>,
		function(data){
			updater.processUpdates(data);
		}
	);
</script>
<?php
LGLHelper::loadJSTranslations();
?>