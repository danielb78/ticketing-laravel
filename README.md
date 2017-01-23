# ticketing-laravel
Ticketing system develop with Laravel Framework

## Application info
 - laravel framework version 5.3.29
 - mysql version 5.17.16
 - all dependencies are installed with Homestead
 
## Homestead info
 1. install virtual box ( https://www.virtualbox.org/wiki/Downloads )
 2. install vagrant ( http://www.vagrantup.com/downloads.html )
 3. install git ( https://git-scm.com/downloads )
 4. install homestead using git clone ( https://laravel.com/docs/5.3/homestead )
   - `git clone https://github.com/laravel/homestead.git Homestead`
   - `cd ~`
   - `cd Homestead`
   - `bash init.sh`
   - `cd ../.homestead`
   - `vim ~/.homestead/Homestead.yaml`
   - change folders map `~/Code` with folder when you put your projects ( e.g. `~/projects`)
   - leave `to` as it is ( his scope is for VM )
   - change sites map `homestead.app` with your custom local domain ( e.g. `ticketing.app` )
   - change sites to `/home/vagrant/Code/Laravel/public` with your project public folder ( e.g `/home/vagrant/Code/ticketing/public`)
   - now you must add redirect request to our Homestead environment. Run `sudo vim /etc/hosts` in terminal.
   - add `192.168.10.10 ticketing.app` at the end of file. After you start the server you'll be use `ticketing.app` domain in your browser.
   - change databases `homestead` name with your own ( e.g. `ticketing_app_dev`)
 5. go to `~/Homestead` folder and run `vagrant up`
 6. go to `~/projects` ( in your case will be the name that was changing `Code` folder name )
 7. `vagrant ssh` (this will go you to VM ). Type `cd home/vagrant/projects` folder
 8. install Laravel via `laravel new appname` command
   - `composer global require "laravel/installer"`
   - `laravel new ticketing --5.3.29`
 9. now you can open the browser and type `http://ticketing.app`
10. check your version of Laravel `php artisan --version`. You must see `Laravel Framework version 5.3.29`
