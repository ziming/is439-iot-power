# IS439 BigBelly Singapore Smartbin Power Monitoring App

## Setup Instructions

### Mac Setup for Loc

#### Install Homebrew and update it

/usr/bin/ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"

brew update

#### Install PHP 7.0

brew install homebrew/php/php70

#### Install and update composer

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

php -r "if (hash_file('SHA384', 'composer-setup.php') === 'e115a8dc7871f15d853148a7fbac7da27d6c0030b848d9b3dc09e2a0388afed865e6a3d6b3c0fad45c48e2b5fc1196ae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"

php composer-setup.php

php -r "unlink('composer-setup.php');"

#### Install Valet via Composer

composer global require laravel/valet

valet install

#### Install & run Mysql

Mariadb is a varian of mysql so it works too.

brew install mariadb

brew services start mariadb

#### Create database called is439

mysql -u root -p

CREATE DATABASE is439;

#### [Optional] Install PHPStorm and get a free student account.

It makes Laravel development much easier

https://www.jetbrains.com/phpstorm/

https://www.jetbrains.com/student/

#### Go to your PHPStorm projects folder and run the following command

git clone git@github.com:ziming/is439-iot-power.git

#### Go into that git repo folder and run the following

composer install or composer update

npm install // Assuming you had nodejs installed already

#### Go back to your PHPStorms projects folder and run

valet park

That command will monitor all your laravel project folders and then 
can be accessible via say http://is439-iot-power.dev

You only need to do it once.

#### Go back into the is439-iot-power folder

run node mqtt.js to run the mqtt subscriber


#### Should be finished!

Oh wait create the database tables and seed the tables

php artisan migrate --seed

and subsequently if you update your database tables

php artisan migrate:refresh --seed

if you meet some errors in your laravel development sometimes this command fixes things

composer dump-autoload

Play with the app. The API routes are accessible at routes/api.php

More questions you can ask me here.

### Deploying to my digital Ocean Server

1. Message me for the ssh keys
2. Put them in your ~/.ssh folder
3. Create a file named "config" in ~/.ssh folder

Paste the following into your config file.

Host is439-admin
	HostName 139.59.238.27
	User is439admin
	IdentitiesOnly yes
	IdentityFile ~/.ssh/id_is439

Host is439-app
	HostName 139.59.238.27
	User is439user
	IdentitiesOnly yes
	IdentityFile ~/.ssh/id_is439
	

4. ssh is439-admin to login as is439admin with sudo rights
5. ssh is439-app to login as is439user as normal user
6. To deploy latest code to server
7. ssh is439-app
8. cd is439app.com/current/repo
9. git pull
10. composer update

Site should be accessible via either 1 of the following links

is439app.139.59.238.27.xip.io

is439app.139.59.238.27.nip.io

### Restart MQTT Subscriber

Currently on production server I used Forever to monitor and restart the mqtt subscriber if it ever went down.

But in case it went down and can't recover do this:

1. ssh is439-admin
2. Run this command

sudo forever start -l /var/log/forever/forever.log -a \
-o /var/log/webhook/out.log -e /var/log/webhook/error.log \
--sourceDir /home/is439user/is439app.com/current/repo mqtt.js


