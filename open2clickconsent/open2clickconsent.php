<?php
/**
 * @package    open2clickconsent (plugin)
 * @author     Thibaud Kehler - tkehler.de
 * @copyright  Copyright (c) 2023 Thibaud Kehler
 * @license    MIT license
 */
//kill direct access
defined('_JEXEC') || die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;


class PlgContentOpen2ClickConsent extends CMSPlugin
{

    public function onContentPrepare($context, &$article, &$params, $page = 0)
    {

        //getters
        $doc = Factory::getApplication()->getDocument();
        $wa  = $doc->getWebAssetManager();
        $pluginPath = 'plugins/content/' . $this->_name;
        $view = JFactory::getApplication()->input->get('view');
    }
}
