<?php

Yii::import('zii.widgets.CPortlet');

class TagCloud extends CPortlet
{
	//public $title='Tags';
	public $maxTags = 20;
	public $portfolio_type = 0;

	protected function renderContent()
	{
		$tags=Tag::model()->findTagWeights($this->maxTags, $this->portfolio_type);

		foreach($tags as $tag=>$weight)
		{
			$weight = $weight + 3;
			$link= CHtml::link(CHtml::encode($tag).'<br/>', array('view/tags','tag'=>$tag, 'type'=>Yii::app()->request->getParam('type')));
			echo CHtml::tag('span', array(
				'class'=>'tag',
				'style'=>"font-size:{$weight}pt",
			), $link)."\n";
		}
	}
}