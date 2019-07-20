<?php

defined('is_running') or die('Not an entry point...');

class CSpoiler{

    public static function GetHead(){
        global $page, $addonRelativeCode, $addonRelativeData, $addonPathData;

        if (file_exists($addonPathData . '/CSpoiler.css'))
            $page->css_user[] = $addonRelativeData . '/CSpoiler.css';
        else
            $page->css_user[] = $addonRelativeCode . '/CSpoiler.css';

    }

    public static function CKEditorPlugins($plugins){
        global $addonRelativeCode;
        $plugins['cspoiler'] = $addonRelativeCode . '/CKEditor_plugins/cspoiler/';
        $plugins['widget'] = $addonRelativeCode . '/CKEditor_plugins/widget_4.11.4/';
        $plugins['widgetselection'] = $addonRelativeCode . '/CKEditor_plugins/widgetselection_4.11.4/';
        $plugins['lineutils'] = $addonRelativeCode . '/CKEditor_plugins/lineutils_4.11.4/';
        return $plugins;
    }

}
