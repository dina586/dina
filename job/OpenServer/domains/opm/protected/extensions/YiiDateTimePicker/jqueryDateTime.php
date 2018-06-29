<?php
class jqueryDateTime extends CInputWidget {

    public $attribute;
    public $name;
    public $value;
    public $htmlOptions;
    public $options;
        
    public function init() {
		if (!isset($this->options['allowTimes'])) {
            $this->options['allowTimes'] = array();
            for ($i = 6; $i < 22; $i++) {
            	$hour = $i;
                if($i<12)
                	$t = 'AM';
                else {
                	$t = 'PM';
                	$hour = $hour - 12;
                }      	
				$hour = str_pad($hour, 2, 0, STR_PAD_LEFT);
                for($m = 0; $m<60; $m +=15) {
                	$minutes = str_pad($m, 2, 0, STR_PAD_LEFT);
               		$this->options['allowTimes'][] = $hour.':'.$minutes.' '.$t;
                }

            }
        }
        return parent::init();
    }
    
    function run() {
        list($name, $id) = $this->resolveNameID();
        
        if (isset($this->htmlOptions['id']))
            $id = $this->htmlOptions['id'];
        else
            $this->htmlOptions['id'] = $id;
        if (isset($this->htmlOptions['name']))
            $name = $this->htmlOptions['name'];
        else
            $this->htmlOptions['name'] = $name;
        
        if ($this->hasModel())
            echo CHtml::activeTextField($this->model, $this->attribute, $this->htmlOptions);
        else
            echo CHtml::textField($this->name, $this->value, $this->htmlOptions);
        
        if (isset($this->htmlOptions['id']))
            $id = $this->htmlOptions['id'];
        else
            $this->htmlOptions['id'] = $id;

        $options = CJavaScript::encode($this->options);

        $cs = Yii::app()->getClientScript();

        $assetUrl = Yii::app()->assetManager->publish(Yii::getPathOfAlias('ext.YiiDateTimePicker.assets'));
        Yii::app()->clientScript->registerScriptFile($assetUrl . '/jquery.datetimepicker.js');
        Yii::app()->clientScript->registerCssFile($assetUrl . '/jquery.datetimepicker.css');

        $js = "$('#{$id}').datetimepicker($options);";
        
        $cs->registerScript(__CLASS__ . '#' . $id, $js);
    }
}
?>
