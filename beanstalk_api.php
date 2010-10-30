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
	 * Allows a user to update their account details by sending specific parameters.
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
	 * Returns Beanstalk account plans.
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
	 * Returns a Beanstalk account user based on a specific user ID.
	 *
	 * @param string $user_id		required
	 * @return xml
	 */
	function find_single_user($user_id) {
		if(empty($user_id))
			return "User ID required";
		else {
			$api_params = $user_id . ".xml";
			return $this->_execute_curl("users", $api_params);
		}
	}

	/**
	 * Returns Beanstalk account repository list.
	 *
	 * @return xml
	 */
	function find_all_repositories() {
		return $this->_execute_curl("repositories.xml");
	}

	/**
	 * Returns a Beanstalk account repository based on a specific repository ID.
	 *
	 * @param string $repo_id		required
	 * @return xml
	 */
	function find_single_repository($repo_id) {
		if(empty($repo_id))
			return "Repository ID required";
		else {
			$api_params = $repo_id . ".xml";
			return $this->_execute_curl("repositories", $api_params);
		}
	}

	/**
	 * Returns Beanstalk account changeset list.
	 *
	 * @return xml
	 */
	function find_all_changesets() {
		return $this->_execute_curl("changesets.xml");
	}

	/**
	 * Returns a Beanstalk repository changeset based on a specific repository ID.
	 *
	 * @param string $repo_id		required
	 * @return xml
	 */
	function find_single_repository_changeset($repo_id) {
		if(empty($repo_id))
			return "Repository ID required";
		else {
			$api_params = "repository.xml?repository_id=" . $repo_id;
			return $this->_execute_curl("changesets", $api_params);
		}
	}

	/**
	 * Returns a Beanstalk repository's specific changeset based on a specific repository ID and changeset ID.
	 *
	 * @param string $repo_id		required
	 * @return xml
	 */
	function find_single_changeset($changeset_id, $repo_id) {
		if(empty($repo_id) || empty($changeset_id))
			return "Changeset ID and repository ID required";
		else {
			$api_params = $changeset_id . ".xml?repository_id=" . $repo_id;
			return $this->_execute_curl("changesets", $api_params);
		}
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