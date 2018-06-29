<?php
class Morphy_TermFilter extends Zend_Search_Lucene_Analysis_TokenFilter {
	
	private $morphy;
	
	public function __construct()
	{
		header('Content-Type: text/html; charset=utf-8');
		//инициализируем объект phpMorphy
		require_once (Yii::getPathOfAlias('application').DS.'modules'.DS.'search'.DS.'vendors'.DS.'phpmorphy'.DS.'src'.DS.'common.php');
    	$dicts = Yii::getPathOfAlias('application').DS.'modules'.DS.'search'.DS.'vendors'.DS.'phpmorphy'.DS.'dicts'.DS.'ru';
		$lang = strtolower(Yii::app()->language).'_'.strtoupper(Yii::app()->language);
		
		$this->morphy = new phpMorphy($dicts, $lang);
	}
	
	public function normalize(Zend_Search_Lucene_Analysis_Token $srcToken) {
		// извлекаем корень слова
		$pseudo_root = $this->morphy->getPseudoRoot(mb_strtoupper($srcToken->getTermText(), "utf-8"));
		if ($pseudo_root === false)
			$newStr = mb_strtoupper($srcToken->getTermText(), "utf-8");
			// если корень извлечь не удалось, тогда используем все слово
			// целиком
		else
			$newStr = $pseudo_root[0];

			// если лексема короче 3 символов, то не используем её
		if (mb_strlen($newStr, "utf-8") < 3)
			return null;
		
		$newToken = new Zend_Search_Lucene_Analysis_Token($newStr, $srcToken->getStartOffset(), $srcToken->getEndOffset());
		
		$newToken->setPositionIncrement($srcToken->getPositionIncrement());
		
		return $newToken;
	}
}