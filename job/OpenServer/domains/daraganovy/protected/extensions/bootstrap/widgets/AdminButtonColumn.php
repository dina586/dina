<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
Yii::import('zii.widgets.grid.CButtonColumn');

/**
 * Bootstrap button column widget.
 */
class AdminButtonColumn extends CButtonColumn {

	public $htmlOptions = array('class' => 'btn-group-xs text-center l-nowrap button-column');
	//View button
	public $viewButtonIcon = 'hi hi-eye-open';
	public $viewButtonOptions = array('class' => 'btn-info view');
	//Update button
	public $updateButtonIcon = 'fa fa-pencil';
	public $updateButtonOptions = array('class' => 'update');
	//Delete Button
	public $deleteButtonIcon = 'hi hi-trash';
	public $deleteButtonOptions = array('class' => 'btn-danger delete');
	public $btnType = 'btn-default';
	
	//Ширина колонки по умолчанию
	public $width = 10;
	
	/**
	 * Вывод фильтра в колонке с кнопками. По-умолчанию выводится выпадающий список со страницами
	 * Для того, что бы убрать фильтр, нужно присвоить false
	 */
	public $filter;

	/**
	 * Кнопки со стилями по умолчанию
	 */
	protected function initDefaultButtons() {
		parent::initDefaultButtons();

		if ($this->viewButtonIcon !== false && !isset($this->buttons['view']['icon'])) {
			$this->buttons['view']['icon'] = $this->viewButtonIcon;
		}
		if ($this->updateButtonIcon !== false && !isset($this->buttons['update']['icon'])) {
			$this->buttons['update']['icon'] = $this->updateButtonIcon;
		}
		if ($this->deleteButtonIcon !== false && !isset($this->buttons['delete']['icon'])) {
			$this->buttons['delete']['icon'] = $this->deleteButtonIcon;
		}
	}

	/**
	 * Renders a link button.
	 * @param string $id the ID of the button
	 * @param array $button the button configuration which may contain 'label', 'url', 'imageUrl' and 'options' elements.
	 * @param integer $row the row number (zero-based)
	 * @param mixed $data the data object associated with the row
	 */
	protected function renderButton($id, $button, $row, $data) {

		if (isset($button['visible']) && !$this->evaluateExpression(
				$button['visible'], array('row' => $row, 'data' => $data)
			)
		) {
			return;
		}

		if (!isset($button['options']['class'])) {
			$button['options']['class'] = 'btn ' . $this->btnType;
		} else {
			if (strpos($button['options']['class'], 'btn-') === false) {
				$button['options']['class'] = $this->btnType . ' ' . $button['options']['class'];
			}
			if (strpos($button['options']['class'], 'btn ') === false) {
				$button['options']['class'] = 'btn ' . $button['options']['class'];
			}
		}

		$url = BsArray::popValue('url', $button, '#');
		if ($url !== '#') {
			$url = $this->evaluateExpression($url, array('data' => $data, 'row' => $row));
		}

		$imageUrl = BsArray::popValue('imageUrl', $button, false);
		$label = BsArray::popValue('label', $button, $id);
		$options = BsArray::popValue('options', $button, array());

		BsArray::defaultValue('data-title', $label, $options);
		BsArray::defaultValue('title', $label, $options);
		BsArray::defaultValue('data-toggle', 'tooltip', $options);

		if ($icon = BsArray::popValue('icon', $button, false)) {
			echo CHtml::link(BsHtml::icon($icon), $url, $options);
		} else {
			if ($imageUrl && is_string($imageUrl)) {
				echo CHtml::link(CHtml::image($imageUrl, $label), $url, $options);
			} else {
				echo CHtml::link($label, $url, $options);
			}
		}
	}

	protected function renderFilterCellContent() {
		if($this->filter === false)
			return;
		
		if($this->filter == '') {
			$pageSize = Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']);
			
			$this->filter = BsHtml::dropDownList('pageSize', $pageSize, Yii::app()->params['gridPager'], array(
				'onchange' => "$.fn.yiiGridView.update('{$this->grid->id}',{ data:{pageSize: $(this).val() }})",
			));
		}
		echo $this->filter;
	}

}
