<?php

namespace Addon\CSpoiler;

defined('is_running') or die('Not an entry point...');

class Style{

    public function __construct(){
        global $addonRelativeCode, $addonPathCode, $addonPathData, $langmessage, $title, $page;
        $page->head_js[] = $addonRelativeCode.'/CSpoiler.js';
        $lang = $this->getLang();

        switch(\common::GetCommand()){

            case 'saveCss':
                if (isset($_POST['css']) && \gpFiles::Save($addonPathData . '/CSpoiler.css', $_POST['css'])){
                    message($langmessage['SAVED']);
                    break;
                }
                message($langmessage['OOPS']);
                break;

            case 'styleReset':
                if (file_exists($addonPathData . '/CSpoiler.css')){
                    unlink($addonPathData . '/CSpoiler.css');
                    message($lang['Style restored!']);
                }
                break;
        }

        echo '<form class="text-center" action="' . \common::GetUrl($title) . '" method="post">';

        echo '<p><textarea class="full_width" rows="36" id="css-editor" required disabled name="css">';
        
        if (file_exists($addonPathData . '/CSpoiler.css'))
            echo file_get_contents($addonPathData . '/CSpoiler.css');
        else 
            echo file_get_contents($addonPathCode . '/CSpoiler.css');

        echo '</textarea></p>';

        echo '<input type="hidden" name="cmd" value="saveCss"/>
				<input type="submit" value="' . $langmessage['save_changes'] . '" class="gpsubmit"/>
				<input type="button"  onClick="location.href=\'' . \common::GetUrl($title) . '\'" name="cmd"
                value="' . $langmessage['cancel'] . '" class="admin_box_close gpcancel" />';
        echo '<a id="editcss" class="gpsubmit">'.$lang['Edit mode'].'</a>';
        echo \common::Link($title, '<span class="gpsubmit">'.$lang['Restore style'].'</span>', 'cmd=styleReset');
        echo '</form>';
        echo '<div class="text-right">Made by <a href="https://sestolab.pp.ua" target="_blank">Sestolab</a></div>';
    }
    
    function getLang(){
		global $config;
        
        if(file_exists(dirname(__FILE__).'/languages/'.$config['language'].'.php'))
			include dirname(__FILE__).'/languages/'.$config['language'].'.php';
		else
            include dirname(__FILE__).'/languages/en.php';
            
		return $lang_dict;
    }
    
}
