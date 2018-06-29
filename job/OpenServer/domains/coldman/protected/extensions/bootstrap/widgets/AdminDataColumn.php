<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */

Yii::import('zii.widgets.grid.CDataColumn');

/**
 * Bootstrap grid data column.
 */
class AdminDataColumn extends CDataColumn
{
    /**
     * @var array HTML options for filter input
     * @link {BsDataColumn::renderFilterCellContent()}
     */
    public $filterInputOptions;
	
	public $width;

    /**
     * ```php
     * echo CHtml::openTag('td', $this->filterHtmlOptions);
     * ```
     * @var array
     */
    public $filterHtmlOptions = array();

    /**
     * Renders the header cell content.
     * This method will render a link that can trigger the sorting if the column is sortable.
     */
    protected function renderHeaderCellContent()
    {
        if ($this->grid->enableSorting && $this->sortable && $this->name !== null) {
            $sort = $this->grid->dataProvider->getSort();
            $label = isset($this->header) ? $this->header : $sort->resolveLabel($this->name);

            if (isset($sort->directions[$this->name])) {
                if ($sort->directions[$this->name])
                    $label .= ' <span class="dropup"><span class="caret"></span></span>';
                else
                    $label .= ' <span class="caret"></span>';
            }

            echo $sort->link($this->name, $label, array('class' => 'sort-link'));
        } else {
            if ($this->name !== null && $this->header === null) {
                if ($this->grid->dataProvider instanceof CActiveDataProvider) {
                    echo CHtml::encode($this->grid->dataProvider->model->getAttributeLabel($this->name));
                } else {
                    echo CHtml::encode($this->name);
                }
            } else {
                parent::renderHeaderCellContent();
            }
        }
    }

    /**
     * Renders the filter cell.
     */
    public function renderFilterCell()
    {
        echo CHtml::openTag('td', $this->filterHtmlOptions);
        echo '<div class="filter-container">';
        $this->renderFilterCellContent();
        echo '</div>';
        echo CHtml::closeTag('td');
    }

    /**
     * Renders the filter cell content. Here we can provide HTML options for actual filter input
     */
    protected function renderFilterCellContent()
    {
        if (is_string($this->filter)) {
            echo $this->filter;
        } else {
            if ($this->filter !== false && $this->grid->filter !== null && $this->name !== null && strpos(
                    $this->name,
                    '.'
                ) === false
            ) {
                if ($this->filterInputOptions) {
                    $filterInputOptions = $this->filterInputOptions;
                    if (empty($filterInputOptions['id'])) {
                        $filterInputOptions['id'] = false;
                    }
                } else {
                    $filterInputOptions = array();
                }
                if (isset($filterInputOptions['class']))
                    $filterInputOptions['class'] .= ' form-control';
                else
                    $filterInputOptions['class'] = 'form-control';
                if (is_array($this->filter)) {
                    $filterInputOptions['prompt'] = '';
                    echo CHtml::activeDropDownList(
                        $this->grid->filter,
                        $this->name,
                        $this->filter,
                        $filterInputOptions
                    );
                } else {
                    if ($this->filter === null) {
                        echo CHtml::activeTextField($this->grid->filter, $this->name, $filterInputOptions);
                    }
                }
            } else {
                parent::renderFilterCellContent();
            }
        }
    }
}
