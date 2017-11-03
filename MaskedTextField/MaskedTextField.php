<?php

class MaskedTextField extends CMaskedTextField
{
    public function registerClientScript()
    {
        $id = $this->htmlOptions['id'];
        $miOptions = $this->getClientOptions();
        $options = $miOptions !== array() ? ',' . CJavaScript::encode($miOptions) : '';
        $js = '';
        if(is_array($this->charMap))
            $js .= 'jQuery.mask.definitions=' . CJavaScript::encode($this->charMap) . ";\n";
        $js .= "jQuery(\"#{$id}\").inputmask(\"{$this->mask}\"{$options});";

        $cs = Yii::app()->getClientScript();
        $cs->coreScriptPosition = CClientScript::POS_END;
        $cs->registerCoreScript('jquery');

        $cs->registerScriptFile(
            Yii::app()->assetManager->publish(
                dirname(__FILE__) . '/assets/jquery.inputmask.bundle.js'
            ), CClientScript::POS_END
        );

        $cs->registerScript('Yii.MaskedTextField#' . $id, $js);
    }
}