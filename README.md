# National Yiddish Theatre Folksbiene [NYTF]

Base repo to support the NYTF website, built in WordPress.

The following notes are more guidelines than enforced policies. Please reach out to the NYTF team for any problems, issues, suggestions.

## Repo Notes

- Noticably absent from this repo:
    - WordPress Core
        - this is by design, no need to replicate, please do not commit
        - Lastest WordPress will be installed on servers as part of deployment
        - Each dev is responsible for setting up their own local dev environment
    - `wp-content/uploads/`
        - also by design, please do not commit
    - `.gitignore` has been setup to help enforce these concepts, please update as needed or reasonable if it is causing problems.

## Development / Deployment Workflow

* Deployments to staging and production will be triggered manually by the NYTF team

## Wordpress updates

* We use wp cli to manage the wordpress core, please SSH to server and run `wp core update` in site's root to update to latest version of Wordpress

#### Branch Descriptions
* `/master`
  * contains only production ready code
  * please create pull requests to integrate requested changes after tested and approved in staging
* `/staging` 
  * changes commited to staging will be deployed to staging environment
* `/dev`
  * use the dev branch for local development, commit work frequently

### Plugin Management

**Custom Plugins**

- Custom plugins can be committed to `/wp-content/plugins/yourpluginname` 
- Update the `.gitignore` file to allow custom plugins to be committed

