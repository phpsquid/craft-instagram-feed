<?php
namespace Craft;

class InstagramFeedService extends BaseApplicationComponent
{
	// returns an array of URL's from instagram
	public function getFeed($limit)
	{
		// plugin settings
		$settings = craft()->plugins->getPlugin('instagramfeed')->getSettings();
		
		// array to be returned
		$images = array();
		
		// build url for curl request
		$url = "https://api.instagram.com/v1/users/$settings->userId/media/recent/?access_token=$settings->accessToken&count=$limit";
		
		// send curl request
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		$result = curl_exec($ch);
		curl_close($ch);
		
		$result = json_decode($result);
		
		if ( ! $result || ! isset($result->data) ) {
			return $images;
		}
		
		foreach ($result->data as $row) {
			$images[] = array(
				'url' => $row->images->standard_resolution->url,
				'link' => $row->link,
				'likes' => $row->likes->count,
				'comments' => $row->comments->count
			);
		}

		return $images;
	}
	
	// returns true if the connection to instagram is working
	public function isConnected()
	{
		if ( ! empty($this->getFeed(1)) ) {
			return true;
		} else {
			return false;
		}
	}
}
