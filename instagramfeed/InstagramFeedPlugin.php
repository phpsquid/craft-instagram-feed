<?php
namespace Craft;

class InstagramFeedPlugin extends BasePlugin
{

	public function getName()
	{
		return Craft::t('Instagram Feed');
	}

	public function getVersion()
	{
		return '1.0.0';
	}

	public function getSchemaVersion()
	{
		return '1.0.0';
	}

	public function getDeveloper()
	{
		return 'Paleosun';
	}

	public function getDeveloperUrl()
	{
		return 'http://paleosun.com';
	}

	public function getPluginUrl()
	{
		return 'https://github.com/phptiny/craft-instagram-feed';
	}

	public function getDocumentationUrl()
	{
		return $this->getPluginUrl().'/blob/master/README.md';
	} 
	
	public function getSettingsHtml()
	{
		return craft()->templates->render('instagramfeed/_settings', array(
			'settings' => $this->getSettings()
		));
	}
	
	public function setSettings($values)
	{
		if (!$values)
		{
			$values = array();
		}

		if (is_array($values))
		{
			// Merge in any values that are stored in craft/config/instagramfeed.php
			foreach ($this->getSettings() as $key => $value)
			{
				$configValue = craft()->config->get($key, 'instagramfeed');

				if ($configValue !== null)
				{
					$values[$key] = $configValue;
				}
			}
		}

		parent::setSettings($values);
	}

	protected function defineSettings()
	{
		return array(
			'userId'      => array(AttributeType::String, 'required' => true),
			'accessToken' => array(AttributeType::String, 'required' => true)
		);
	}
}
