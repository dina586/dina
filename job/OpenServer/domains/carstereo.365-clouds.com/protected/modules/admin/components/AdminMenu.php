<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
Yii::import('zii.widgets.CMenu');

class AdminMenu extends CMenu {

	public $iconTag = 'i';

	protected function renderMenuItem($item) {
		if (isset($item['url'])) {
			$label = $this->linkLabelWrapper === null ? $item['label'] : CHtml::tag($this->linkLabelWrapper, $this->linkLabelWrapperHtmlOptions, $item['label']);
			if (isset($item['icon'])) {
				$item['icon'] .= ' sidebar-nav-icon';
				$label = '<' . $this->iconTag . ' class = "' . $item['icon'] . '"></' . $this->iconTag . '>' . $label;
			}
			return CHtml::link($label, $item['url'], isset($item['linkOptions']) ? $item['linkOptions'] : array());
		} else
			return CHtml::tag('span', isset($item['linkOptions']) ? $item['linkOptions'] : array(), $item['label']);
	}

}
