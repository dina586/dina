<?php
/**
 * The EAuthWidget widget prints buttons to authenticate user with OpenID and OAuth providers.
 * @package application.extensions.eauth
 */
class SocialNetworkWidget extends CWidget {
		
	/**
	 * @var string EAuth component name.
	 */
	public $component = 'eauth';
	
	/**
	 * @var array the services.
	 * @see EAuth::getServices() 
	 */
	public $services = null;
	
	/**
	 * @var boolean whether to use popup window for authorization dialog. Javascript required.
	 */
	public $popup = null;
	
	/**
	 * @var string the action to use for dialog destination. Default: the current route.
	 */
	public $action = null;

	/**
	 * Initializes the widget.
	 * This method is called by {@link CBaseController::createWidget}
	 * and {@link CBaseController::beginWidget} after the widget's
	 * properties have been initialized.
	 */
	public function init() {
		parent::init();
		
		// EAuth component
		$component = Yii::app()->{$this->component};
		
		// Some default properties from component configuration
		if (!isset($this->services))
			$this->services = $component->getServices();
		
		if (!isset($this->popup))
			$this->popup = $component->popup;
		
		// Set the current route, if it is not set.
		if (!isset($this->action))
			$this->action = Yii::app()->urlManager->parseUrl(Yii::app()->request);
	}
	
	/**
	 * Executes the widget.
	 * This method is called by {@link CBaseController::endWidget}.
	 */
    public function run() {
		parent::run();
		
		$this->registerAssets();
		$this->render('auth', array(
			'id' => $this->getId(),
			'services' => $this->services,
			'action' => $this->action,
		));
    }
	
	/**
	 * Register CSS and JS files.
	 */
	protected function registerAssets() {
	
		// Open the authorization dilalog in popup window.
		if ($this->popup) {
			//Yii::app()->clientScript->registerScriptFile($url.'/js/auth.js', CClientScript::POS_HEAD);
			$js = '';
			foreach ($this->services as $name => $service) {
				$args = $service->jsArguments;
				$args['id'] = $service->id;
				
				$js .= '$(".auth-service.'.$service->id.' a").eauth('.json_encode($args).');'."\n";
			}
			JS::add('eauth-services', $js, CClientScript::POS_READY);
		}
	}
}
