# Alpha Beanstalk PHP API Documentation #

## Installation ##
1. Edit the configuration options at the top of beanstalk_api.php to match your info
2. Copy beanstalk_api.php into a directory on your webserver
3. Call beanstalk_api.php in the php file you wish to use it in using `require_once('path/beanstalk_api.php');`

## Usage ##
Before using any of the following methods, you must first declare the following:
`$varname = new beanstalk_api();`

List of available function calls:

* `get_account_details();`
* `find_all_plans();`
* `find_all_users();`
* `find_single_user(user_id);`
* `find_all_repositories();`
* `find_single_repository(repo_id);`
* `find_all_changesets();`
* `find_single_repository_changeset(repo_id);`
* `find_single_changeset(revision_number, repo_id);`
* `find_all_comments(repo_id);`
* `find_all_changeset_comments(repo_id, revision);`
* `find_single_comment(repo_id, comment_id);`
* `find_all_server_environments(repo_id);`
* `find_single_server_environment(repo_id, environment_id);`
* `find_all_release_servers(repo_id, environment_id);`
* `find_single_release_server(repo_id, server_id);`
* `find_all_successful_release(repo_id);`
* `find_single_release(repo_id, release_id);`
