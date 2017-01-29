<?php
namespace Craft;

class InstagramFeedVariable
{
	/* accessable in templates as craft.instagramfeed.getFeed()
	** returns an array of instagram image urls
	*/
	public function getFeed($limit)
	{
		return craft()->instagramFeed->getFeed($limit);
	}
	
	public function isConnected()
	{
		return craft()->instagramFeed->isConnected();
	}
}