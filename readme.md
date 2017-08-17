This is a exercise website (blog) created with PHP framework Laravel. The main purpose of the site is learning main concepts of the framework, its components and features. The project is deployed in VPS and doesn't have domain name yet.

Here is the brief overview that was implemented so far:


## Release 2.0

Creating site forum that has the following features:

- threads and threads replies from authenticated users
- threads has their channels
- user can filter threads by their channels, popularity or by those that don't have any reply yet
- user can like reply
- user has a profile page where he can see his activity
- user can subscribe to the thread and get notifications if somebody leave a new reply to thread

Technical aspects:

- created vue-components for threads list, one thread view, replies and add new reply, user notification, subscribe button and flash message
- implemented unit tests for forum's units and features
- made traits for record activity and favourable instances on forum
- created dedicated class for filtering threads
- introduced threads notification class
- created database factories



## Release 1.0

Setting up blog with admin panel.


Client side has following features:

- different pages have different layout types (created with nested blade templates
- article list view is paginated
- url for particular article contains slug (instead of article id)
- visitor can create account on the site or can log in with social media account (e.g facebook)
- user can filter articles by related tag name
- authenticated user can add comment to the articles which will be display after moderation
- visitor can leave feedback for the site owner that will be sent to his email after submition


In admin panel was implemented:

- separate middleware for admin routes (user authentication)
- users have roles and privileges (admin - superuser, moderator - can only see and accept comments to articles), gates and policies for user authorisation
- adding / updating / deleting blog articles; adding image to article; setting up period when article is visible on the site
- adding / updating / deleting article's tags
- custom file uploader class for storing files outside public folder
- image resizer that allows generated dinamic images via provided URL (Intervention image library was used)
- data caching with Memcached and eager loading
- sharing variables values between all views
- custom paginator for comment collections grouped by articles
- casting, mutators and local scopes for models
- visitors feedback events handler
- mail sending via Mailgun


