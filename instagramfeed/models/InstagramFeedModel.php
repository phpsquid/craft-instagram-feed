<?php
namespace Craft;

class InstagramFeedModel extends BaseModel
{
	protected function defineAttributes()
	{
		return array(
			'userId'      => array(AttributeType::String, 'required' => true, 'label' => 'Instagram User ID'),
			'accessToken' => array(AttributeType::String, 'required' => true, 'label' => 'Access Token')
		);
	}
}