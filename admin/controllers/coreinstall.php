<?php
/**
 * @package LaoGoaL component for Joomla 3
 * @author Murat Erkenov (murat@11bits.net)
 * @copyright (C) 2014 - Murat Erkenov
 * @license     GNU General Public License version 2 or later; see license.txt
**/

   defined( '_JEXEC' ) or die( 'Restricted access' );


class LaogoalControllerCoreInstall extends JControllerBase {

	/**
	 * @var JApplicationCms
	 */
	protected  $app;

	function __construct() {
		$this->app = $this->loadApplication();
		$this->app->input->set('tmpl', 'component');
	}

	function execute() {
		$result = $this->install();
		if (!$result) {
			$result = 'Can not install LaoGoal Core component';
		}
		echo $result;
	}

	private function install() {
		$url = JComponentHelper::getParams('com_laogoal')->get('lgl_url');
		$pFile = JInstallerHelper::downloadPackage($url);
		if (!$pFile) {
			return false;
		}

		$config = JFactory::getConfig();
		$tmpDestination = $config->get('tmp_path');
		$package = JInstallerHelper::unpack($tmpDestination . '/' . $pFile, true);
		if (!isset($package['dir'])) {
			JInstallerHelper::cleanupInstall($package['packagefile'], $package['extractdir']);
			return false;
		}

		$installer = JInstaller::getInstance();
		if (!$installer->install($package['dir'])) {
			return false;
		}
		$message = $installer->get('extension_message');
		$message .= '<br /><a target="_top" href="' . JRoute::_('index.php?option=com_laogoal', false) . '">';
		$message .= 'Click here continue</a>';

		return $message;
	}
}