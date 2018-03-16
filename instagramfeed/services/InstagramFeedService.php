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
		$instafeed = array();
		
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
			return $instafeed;
		}


		// Get user details 
		// Outside images loop to avoid duplication
		// Store them in user_details
		// You could get the id if needed
		// Use it this way
		// {{ instagramfeed.user_details.username }}
		$instafeed['user_details'] = array(
			'username' => $result->data['0']->user->username,
			'profile_picture' => $result->data['0']->user->profile_picture,
		);

		// Then store images
		// Use it this way
		// {% for image in instagramfeed.images %}
		foreach ($result->data as $row) {
			$instafeed['images'][] = array(
				'url' => $row->images->standard_resolution->url,
				'link' => $row->link,
				'likes' => $row->likes->count,
				'comments' => $row->comments->count
			);
		}

		return $instafeed;
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
