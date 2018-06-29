<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
Class cText {
	/* Обрезка фразы по словам */

	public static function wordTrim($string, $count, $ellipsis = FALSE) {
		$words = explode(' ', $string);
		if (count($words) > $count) {
			array_splice($words, $count);
			$string = implode(' ', $words);
			if (is_string($ellipsis)) {
				$string .= $ellipsis;
			} elseif ($ellipsis) {
				$string .= '&hellip;';
			}
		}
		return $string;
	}

	/* Обрезка фразы до n символов */

	public static function cropStr($string, $limit) {
		//режем строку от 0 до limit
		$substring_limited = substr($string, 0, $limit);
		//берем часть обрезанной строки от 0 до последнего пробела
		if (substr_count($string, ' ') == 0) {
			return substr($string, 0, $limit);
		} else {
			return substr($substring_limited, 0, strrpos($substring_limited, ' '));
		}
	}

}
