<?php
class beanstalk_api {
	/**
	 * Beanstalk account configuration
	 *
	 * Please enter your account name, username and password below.
	 */

	private $account_name	= 'example';		// Beanstalk account name (first segment of your beanstalk URL - http://example.beanstalkapp.com)
	private $username		= 'username';		// Beanstalk username
	private $password		= 'password';		// Beanstalk password

	/**
	 * Returns Beanstalk account details.
	 *
	 * @return xml
	 */
	function get_account_details() {
		return $this->_execute_curl("account.xml");
	}

	/**
	 * Allows a user to update their account details by sending specific parameters
	 *
	 * @param string $name			required
	 * @param string $time_zone		required
	 * @return xml
	 */
	function update_account_details($name, $time_zone) {
		if(empty($name) || empty($time_zone))
			return "Name and time zone required";
	}

	/**
	 * Returns Beanstalk account plans
	 *
	 * @returns xml
	 */
	function find_all_plans() {
		return $this->_execute_curl("plans.xml");
	}

	/**
	 * Returns Beanstalk account user list.
	 *
	 * @return xml
	 */
	function find_all_users() {
		return $this->_execute_curl("users.xml");
	}

	/**
	 * Returns a Beanstalk account user based on a specific user ID
	 *
	 * @param string $user_id		required
	 * @return xml
	 */
	function find_single_user($user_id) {
		if(empty($user_id))
			return "User ID required";
		else
			return $this->_execute_curl("users", $user_id . ".xml");
	}

	/**
	 * Returns Beanstalk account repository list
	 *
	 * @return xml
	 */
	function find_all_repositories() {
		return $this->_execute_curl("repositories.xml");
	}

	/**
	 * Returns a Beanstalk account repository based on a specific repository ID
	 *
	 * @param string $repo_id		required
	 * @return xml
	 */
	function find_single_repository($repo_id) {
		if(empty($repo_id))
			return "Repository ID required";
		else
			return $this->_execute_curl("repositories", $repo_id . ".xml");
	}

	/**
	 * Returns Beanstalk account changeset list
	 *
	 * @return xml
	 */
	function find_all_changesets() {
		return $this->_execute_curl("changesets.xml");
	}

	/**
	 * Returns a Beanstalk repository changeset based on a specific repository ID
	 *
	 * @param string $repo_id		required
	 * @return xml
	 */
	function find_single_repository_changeset($repo_id) {
		if(empty($repo_id))
			return "Repository ID required";
		else
			return $this->_execute_curl("changesets", "repository.xml?repository_id=" . $repo_id);
	}

	/**
	 * Returns a Beanstalk repository's specific changeset based on a specific repository ID and changeset ID
	 *
	 * @param string $repo_id		required
	 * @return xml
	 */
	function find_single_changeset($changeset_id, $repo_id) {
		if(empty($repo_id) || empty($changeset_id))
			return "Changeset ID and repository ID required";
		else
			return $this->_execute_curl("changesets", $changeset_id . ".xml?repository_id=" . $repo_id);
	}
	
   /**
	* Returns a Beanstalk repository's comment listing
	*
	* @param string $repo_id		required
	* @return xml
	*/
	function find_all_comments($repo_id) {
		if(empty($repo_id))
			return "Repository ID required";
		else
			return $this->_execute_curl($repo_id, "comments.xml");
	}
		
	/**
	* Returns a Beanstalk repository's comment listing for a specific changeset
	*
	* @param string $repo_id		required
	* @param string $revision		required
	* @return xml
	*/
	function find_all_changeset_comments($repo_id, $revision) {
		if(empty($repo_id) || empty($revision))
			return "Repository ID and revision ID required";
		else
			return $this->_execute_curl($repo_id, "comments.xml?revision=" . $revision);
	}
		
	/**
	* Returns a Beanstalk repository's comment based on a specific comment ID
	*
	* @param string $repo_id		required
	* @param string $revision		required
	* @return xml
	*/
	function find_single_comment($repo_id, $comment_id) {
		if(empty($repo_id) || empty($comment_id))
			return "Repository ID and comment ID required";
		else
			return $this->_execute_curl($repo_id, "comments/" . $comment_id . ".xml");
	}
		
	/**
	* Returns a Beanstalk repository's server environment listing
	*
	* @param string $repo_id		required
	* @return xml
	*/
	function find_all_server_environments($repo_id) {
		if(empty($repo_id))
			return "Repository ID required";
		else
			return $this->_execute_curl($repo_id, "server_environments.xml");
	}
		
	/**
	* Returns a Beanstalk repository's server environment listing based on a specific environment ID
	*
	* @param string $repo_id		required
	* @param string $environment_id	required
	* @return xml
	*/
	function find_single_server_environment($repo_id, $environment_id) {
		if(empty($repo_id) || empty($environment_id))
			return "Repository ID required";
		else
			return $this->_execute_curl($repo_id, "server_environments/" . $environment_id . ".xml");
	}
		
	/**
	* Returns a Beanstalk repository's release server listing
	*
	* @param string $repo_id		required
	* @param string $environment_id	required
	* @return xml
	*/
	function find_all_release_servers($repo_id, $environment_id) {
		if(empty($repo_id) || empty($environment_id))
			return "Repository ID and environment ID required";
		else
			return $this->_execute_curl($repo_id, "release_servers.xml?environment_id=" . $environment_id);
	}
		
	/**
	* Returns a Beanstalk repository's release server listing based on a specific server ID
	*
	* @param string $repo_id		required
	* @param string $server_id		required
	* @return xml
	*/
	function find_single_release_server($repo_id, $server_id) {
		if(empty($repo_id) || empty($server_id))
			return "Repository ID and server ID required";
		else
			return $this->_execute_curl($repo_id, "release_servers/" . $server_id . ".xml";
	}
		
	/**
	* Returns a Beanstalk repository's successful releases listing
	*
	* @param string $repo_id		required
	* @return xml
	*/
	function find_all_sucessful_releases($repo_id) {
		if(empty($repo_id))
			return "Repository ID required";
		else
			return $this->_execute_curl($repo_id, "releases.xml");
	}
		
	/**
	* Returns a Beanstalk repository's release based on a specific release id
	*
	* @param string $repo_id		required
	* @param string $release_id		required
	* @return xml
	*/
	function find_single_release($repo_id, $release_id) {
		if(empty($repo_id) || empty($release_id))
			return "Repository ID and release ID required";
		else
			return $this->_execute_curl($repo_id, $release_id . ".xml");
	}
	
	/**
	 * Sets up and executes the cURL requests and returns the response
	 *
	 * @param string $api_name
	 * @param null $api_params
	 * @param null $curl_param
	 * @return mixed
	 */
	function _execute_curl($api_name, $api_params = NULL, $curl_param = NULL) {
		if( ! isset($api_params))
			$ch = curl_init("http://" . $this->account_name . ".beanstalkapp.com/api/" . $api_name);
		else
			$ch = curl_init("http://" . $this->account_name . ".beanstalkapp.com/api/" . $api_name . "/" . $api_params);
		var_dump($ch);
		$headers = array('Content-type: application/xml');
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		if($curl_param == "PUT")
			curl_setopt($ch, CURLOPT_PUT, 1);

		$data = curl_exec($ch);
		curl_close($ch);

		return $data;
	}
}