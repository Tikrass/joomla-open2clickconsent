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

    protected $tag = 'consent';

    public function onContentPrepare($context, &$article, &$params, $page = 0)
    {

        //getters
        $doc = Factory::getApplication()->getDocument();
        $wa  = $doc->getWebAssetManager();
        $pluginPath = 'plugins/content/' . $this->_name;
        $view = JFactory::getApplication()->input->get('view');
        
        $wa->registerAndUseStyle('contentplugdemo.mainstyle',$pluginPath.'/css/dsgvo-video-embed.css');
        $wa->registerAndUseScript('open2clickconsent.mainscript',$pluginPath.'/js/dsgvo-video-embed.js');
        
        if(stripos($article->text, '<iframe') === false) {
            return;
        }

        preg_match_all('/<iframe.*?\/iframe>/s', $article->text, $matches);
        
        foreach ($matches[0] as $value) {

            if ( preg_match('(youtube|vimeo)', $value) ) {
                $output = preg_replace('/src=/','data-src=',$value);
            }

            //replace the original iframe $value with the new $output in article->text
            $article->text = str_replace($value, $output, $article->text); 
        }
    }
}
