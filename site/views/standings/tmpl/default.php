<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license     GNU General Public License version 2 or later; see license.txt
**/
 defined( '_JEXEC' ) or die( 'Restricted access' );

defined('_JEXEC') or die;
$this->table = $this->model->getStandingsTable();
$leagueId = $this->model->getLeagueId();
?>
<div class="com_laogoal_widget com_laogoal_standings com_laogoal_league com_laogoal_league_<?php echo $this->escape($leagueId)?>">
		<span class="com_laogoal_flag">
<?php echo $this->escape(JText::_($leagueId))?>
			</span>
			<span class="com_laogoal_show-matches">
				<a href="<?php echo JRoute::_(LAOGOALUrl::bindToMenu('index.php?option=com_laogoal&view=matches&league=' . urlencode($leagueId)))?>"><?php echo $this->escape(JText::_('Show Matches'))?></a>
			</span>

<?php if ($this->table->hasGroups()) :?>
	<?php include $this->getPath('groups'); ?>
<?php else :?>
	<?php include $this->getPath('nogroups'); ?>
<?php endif?>
</div>
