# rss-feed
Create feed and content by Symfony

#### 1. Install composer by
composer install

#### 2. Create database and mention in .env file with db credential

#### 3. Update DB by run command
php bin/console doctrine:schema:update --force

#### 4. Run server
 php bin/console server:run

#### 5. Register a user by /registration. It will create a user with role ROLE_USER

#### 6. To update or delete feed change role of user as 'ROLE_ADMIN' in user table directly under roles column
