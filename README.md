### PHP Web App

NOTE: Requires [Composer](https://getcomposer.org/), uses [Lustre Framework](https://github.com/Sunnepah/lustre)

#### Set Up
$ `git clone https://github.com/Sunnepah/forum-webapp.git`

$ `cd forum-webapp`

$ `composer install`

$ `create MYSQL database 'forum_db' in your machine and import forum_db20161112.sql file`

$ `Change your database credentials in 'application/Config/DBConfig.php'`

$ `Configure your Aws S3 credentials in 'application/Config/ServiceConfig.php'`
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- S3_BUCKET (S3 Bucket name)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- AccessKey_ID (AWS developer ID)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- SecretAccess_Key (AWS developer Key)

$ `php -S 0.0.0.0:8080 -t web/`

$ Visit `0.0.0.0:8080` on your browser

#### To run tests
$ `./vendor/bin/phpunit tests`
