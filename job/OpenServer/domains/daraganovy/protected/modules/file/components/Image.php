<?php 
/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class Image extends CApplicationComponent {

	/**
	 * @var array object instances array with key set to $_filepath
	 */
	private static $_instances = array();
	
	//@var obj Imagick object
	private $imagick;
	
	private $path;
	
	//Качество после сжатия
	public $quality = 80;
	
	//@var boolean если true конвертируем изображения к jpg формату
	public $convertToJpg = true;
		
	//Используемый фильтр при ресайзе изображения
	public $filter = 11; //'FILTER_CATROM';
	
	/**
	 * @param str $image путь к изображению
	 */
	public function __construct($image) {
		$this->imagick = new Imagick($image);
		$this->path = $image;
		if(isset(Yii::app()->params['convertToJPG']))
			$this->convertToJpg = Yii::app()->params['convertToJpg'];
	}
	
	/**
	 * Ресайз изображения
	 * @param string $image
	 * @param string $savePath
	 * @param string $imageName новое имя изображения
	 * @param string $type тип для ресайза crop, auto
	 * @param int $width
	 * @param int $height
	 * @return string
	 */
	
	public function resize($width, $height, $savePath, $imageName, $type = 'auto', $ext = false) {
		$imageName = $this->normalizeName($imageName, Yii::app()->cFile->set($this->path)->getExtension());
		
		/*if(Yii::app()->cFile->set($this->path)->getExtension() == 'png') {
			$this->imagick->setImageBackgroundColor('white');
			$this->imagick->setImageAlphaChannel(Imagick::ALPHACHANNEL_REMOVE);
			$this->imagick->mergeImageLayers(Imagick::LAYERMETHOD_FLATTEN);
		}*/

		if(!$ext) {
			if($this->convertToJpg)
				$ext = 'jpg';
			else
				$ext = Yii::app()->cFile->set($this->path)->getExtension();
		}
				
		$this->resizeType($width, $height, $type);
	
		$this->imagick->writeImage(trim($savePath, DS).DS.$imageName.'.'.$ext);
		return $imageName.'.'.$ext;
	}
			
	/**
	 * Нормализация параметров при ресайзе для изображений меньшего размера
	 * @param int $width
	 * @param int $height
	 */
	
	private function getImageGeometry($newWidth, $newHeight, $option)
	{
	
		switch ($option)
		{
			case 'crop':
				$optimalWidth = $newWidth;
				$optimalHeight= $newHeight;
				break;
			case 'portrait':
				$optimalWidth = $this->getSizeByFixedHeight($newHeight);
				$optimalHeight= $newHeight;
				break;
			case 'landscape':
				$optimalWidth = $newWidth;
				$optimalHeight= $this->getSizeByFixedWidth($newWidth);
				break;
			case 'auto':
				$optionArray = $this->getSizeByAuto($newWidth, $newHeight);
				$optimalWidth = $optionArray['optimalWidth'];
				$optimalHeight = $optionArray['optimalHeight'];
				break;
		}
		return array('width' => $optimalWidth, 'height' => $optimalHeight);
	}
	
	
	private function getSizeByFixedHeight($newHeight)
	{
		$ratio = $this->imagick->getImageWidth() / $this->imagick->getImageHeight();
		$newWidth = $newHeight * $ratio;
		return $newWidth;
	}
	
	private function getSizeByFixedWidth($newWidth)
	{
		$ratio = $this->imagick->getImageWidth() / $this->imagick->getImageHeight();
		$newHeight = $newWidth * $ratio;
		return $newHeight;
	}
	
	private function getSizeByAuto($newWidth, $newHeight)
	{
		if ($this->imagick->getImageHeight() > $newHeight || $this->imagick->getImageWidth() >$newWidth)
		{
			if(($this->imagick->getImageWidth()/$this->imagick->getImageHeight()) < ($newWidth/$newHeight))
			{
				$ratioWidth = $newWidth/$this->imagick->getImageWidth();
				$ratioHeight = $newHeight/$this->imagick->getImageHeight();
				$ratio = min($ratioHeight, $ratioWidth);
				$optimalWidth = $ratio * $this->imagick->getImageWidth();
				$optimalHeight = $ratio * $this->imagick->getImageHeight();
			}
			elseif ($this->imagick->getImageHeight() < $this->imagick->getImageWidth())
			{
				$optimalWidth = $newWidth;
				$optimalHeight= $this->getSizeByFixedWidth($newWidth);
			}
			elseif ($this->imagick->getImageHeight() > $this->imagick->getImageWidth())
			{
				$optimalWidth = $this->getSizeByFixedHeight($newHeight);
				$optimalHeight= $newHeight;
			}
			else
			{
				if ($newHeight > $newWidth) {
					$optimalWidth = $newWidth;
					$optimalHeight= $this->getSizeByFixedWidth($newWidth);
				} else if ($newHeight < $newWidth) {
					$optimalWidth = $this->getSizeByFixedHeight($newHeight);
					$optimalHeight= $newHeight;
				} else {
					$optimalWidth = $newWidth;
					$optimalHeight= $newHeight;
				}
			}
		}
		else
		{
			$optimalWidth = $this->imagick->getImageWidth();
			$optimalHeight= $this->imagick->getImageHeight();
		}
	
		return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
	}
	
	
	private function getOptimalCrop($newWidth, $newHeight)
	{
	
		$heightRatio = $this->imagick->getImageHeight() / $newHeight;
		$widthRatio  = $this->imagick->getImageWidth() /  $newWidth;
	
		if ($heightRatio < $widthRatio) {
			$optimalRatio = $heightRatio;
		} else {
			$optimalRatio = $widthRatio;
		}
	
		$optimalHeight = $this->imagick->getImageHeight() / $optimalRatio;
		$optimalWidth  = $this->imagick->getImageWidth()  / $optimalRatio;
	
		return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
	}
	
	/**
	 * Приводим имя к базовому (если в имени случайно передали расширение)
	 * @param string $imageName
	 * @return string
	 */
	private function normalizeName($imageName, $ext) {
		$imageName = str_replace('.'.$ext, '', $imageName);
		$pos = strpos($imageName, '.');
		if($pos === true) {
			$nameArr = explode('.', $imageName);
			$imageName = implode('', array_pop($nameArr));
		}
		return $imageName;
	}
	
	/**
	 * Выполенение ресайза
	 * @param int $width
	 * @param int $height
	 * @param string $type
	 */
	protected function resizeType($width, $height, $type) {
		$imageGetometry = $this->getImageGeometry($width, $height, $type);
		if($type == 'crop')
			$this->imagick->cropThumbnailImage($imageGetometry['width'], $imageGetometry['height']);
		else
			$this->imagick->resizeImage ($imageGetometry['width'], $imageGetometry['height'], $this->filter, 1, true);
		$this->imagick->setImageCompressionQuality($this->quality);
	}
	
	public function getWidth() {
		return $this->imagick->getImageWidth();
	}
	
	public function getHeight() {
		return $this->imagick->getImageheight();
	}
	
}