<?php
/**
 * SeoTitle class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @since 0.9.1
 */

class SeoTitle extends CWidget
{
	/**
	 * @property string the page title separator.
	 */
	public $separator = ' | ';

	/**
	 * Runs the widget.
	 */
	public function run()
	{
		$parts = array();
		$controller = $this->getController();
		$pageTitle = $controller->pageTitle;

		// We do not want to use the default page title generated by Yii
		// because it is not very SEO friendly.
		if ($this->isDefaultPageTitle($pageTitle, $controller))
			$pageTitle = null;

		if ($pageTitle !== null)
		{
			if (!is_array($pageTitle))
				$pageTitle = array($pageTitle);

			$parts = $pageTitle;
		}
		else
		{
			if (($breadcrumbs = $controller->breadcrumbs) !== array())
			{
				foreach ($breadcrumbs as $key => $value)
					$parts[] = is_string($key) || is_array($value) ? $key : $value;

				$parts = array_reverse($parts);
			}
			else
			{
				$name = ucfirst($controller->getId());
				$action = $controller->getAction();
				$module = $controller->getModule();

				if ($action !== null && strcasecmp($action->getId(), $controller->defaultAction))
					$parts[] = ucfirst($action->getId()).' '.$name;
				else if ($module !== null && strcasecmp($name, $module->defaultController))
					$parts[] = $name;

				if ($module !== null)
				{
					$pieces = explode('/', $module->getId());
					foreach (array_reverse($pieces) as $piece)
						$parts[] = ucfirst($piece);
				}
			}

			$parts[] = Yii::app()->name;
		}

		echo '<title>'.implode($parts, $this->separator).'</title>';
	}

	/**
	 * Returns whether or not the given title is the default page title.
	 * @param mixed $pageTitle the page title
	 * @param CController $controller the controller
	 * @return bool
	 */
	protected function isDefaultPageTitle($pageTitle, $controller)
	{
		$name = ucfirst(basename($controller->getId()));
		return is_string($pageTitle)
				&& ($pageTitle === Yii::app()->name.' - '.ucfirst($controller->getAction()->getId()).' '.$name
				|| $pageTitle === Yii::app()->name.' - '.$name);
	}
}
