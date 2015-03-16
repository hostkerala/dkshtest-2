<?php
/**
 * Class HybridAuthIdentity Provides HybridAuth Identity to be used along with default yii auth
 * @author Ionut Titei
 *
 */
class HybridAuthIdentity extends CUserIdentity
{
	const VERSION = '2.1.2';
	/**
	 * 
	 * @var Hybrid_Auth
	 */
	public $hybridAuth;
	/**
	 * 
	 * @var Hybrid_Provider_Adapter
	 */
	public $adapter;
	/**
	 * 
	 * @var Hybrid_User_Profile
	 */
	public $userProfile;

	public $allowedProviders = array('google', 'facebook');

	public $config = array();

	function __construct() 
	{
			$path = Yii::getPathOfAlias('vendors.HybridAuth');
			require_once $path . '/hybridauth-' . self::VERSION . '/hybridauth/Hybrid/Auth.php';  //path to the Auth php file within HybridAuth folder

			$this->config = Yii::app()->params['hybridAuthIdentity']['config'];

			$this->config['base_url'] = 'http://'. $_SERVER['SERVER_NAME'] . Yii::app()->getBaseUrl().'/user/auth/'.$this->config['hybridLoginAction'];

			$this->hybridAuth = new Hybrid_Auth($this->config);
	}
	/**
	 *
	 * @param string $provider
	 * @return bool 
	 */
	public function validateProviderName($provider)
	{
			if (!is_string($provider))
					return false;
			if (!in_array($provider, $this->allowedProviders))
					return false;

			return true;
	}
	/**
	 * Generate a username from a give string, f. e. User Name => user_name
	 * @param string $text the string that we're going to prepare as username
	 * @return string the username 
	 */
	public static function generateUsername($text, $spaceReplacement = "_")
	{
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
		$clean = preg_replace("/[^a-zA-Z0-9_| -]/", '', $clean);
		$clean = trim($clean);
		$clean = preg_replace("/[\/_| -]+/", $spaceReplacement, $clean);
		$username = strtolower(trim($clean));

		$users = User::model()->findAllByAttributes(array('username'=>$username));
		if($users)
			$username = $username . (count($users)+1);

		return $username;
	}	
 
}