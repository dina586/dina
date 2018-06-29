<?php

class SearchForm extends CFormModel
{
	public $term;
	public $sort;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('term, sort', 'safe'),
			// email has to be a valid email address
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'sort'=>'Selecting a partition to search: ',
			'term'=>'Search word',
		);
	}
}