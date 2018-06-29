<?php
spl_autoload_unregister(array('YiiBase', 'autoload'));
$phpExcelPath = Yii::getPathOfAlias('ext.exel.phpexcel');
require_once $phpExcelPath . DS . 'PHPExcel.php';
require_once $phpExcelPath . DS.'PHPExcel'.DS.'IOFactory.php';
spl_autoload_register(array('YiiBase', 'autoload'));

class ChunkReadFilter implements PHPExcel_Reader_IReadFilter 
{
    private $_startRow = 0; 
    private $_endRow = 0; 
    /**  Set the list of rows that we want to read  */ 
    public function setRows($startRow, $chunkSize) { 
        $this->_startRow    = $startRow; 
        $this->_endRow      = $startRow + $chunkSize; 
    } 
	public function readCell($column, $row, $worksheetName = '') { 
        //  Only read the heading row, and the rows that are configured in $this->_startRow and $this->_endRow 
        if (($row == 1) || ($row >= $this->_startRow && $row < $this->_endRow)) { 
            return true; 
        } 
        return false; 
    } 
}