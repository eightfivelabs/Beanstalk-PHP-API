# Alpha Beanstalk PHP API Documentation #

## Installation ##
1. Edit the configuration options at the top of beanstalk_api.php to match your info
2. Copy beanstalk_api.php into a directory on your webserver
3. Call beanstalk_api.php in the php file you wish to use it in using `require\_once('path/beanstalk_api.php');`

## Usage ##
Before using any of the following methods, you must first declare the following:
`$varname = new beanstalk_api();`

List of available function calls:

* `$account_details = $api->get_account_details();`
* `$account_plans = $api->find_all_plans();`
* `$users = $api->find_all_users();`
* `$user = $api->find_single_user(user_id);`
* `$repos = $api->find_all_repositories();`
* `$repo = $api->find_single_repository(repo_id);`
* `$changesets = $api->find_all_changesets();`
* `$repo_changeset = $api->find_single_repository_changeset(repo_id);`
* `$changeset = $api->find_single_changeset(revision_number, repo_id);`