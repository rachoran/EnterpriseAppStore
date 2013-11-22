Enterprise App Store
==================

To host iOS and Android apps (will be adding Windows 8 phone, desktop and tablet soon!). Please remember, this is a development version only!!!!!!


At the moment the databse is not cleaned and been working on the authentication but haven't done any proper testing yet so it won't be probably completely bulletproof.
We are working on the system every day so hopefully we'll have a stable version before the December 2013.

The code should not be used in any way for any commercial project at the moment until a final stable version will be released by the end of this year, that version will contain all the neccessary unit tests to make sure the code will stay stable for good :).

Home page:
<img src="https://raw.github.com/Ridiculous-Innovations/EnterpriseAppStore/master/_orig/screens/screen1.jpg" alt="Home page" />

Applications list:
<img src="https://raw.github.com/Ridiculous-Innovations/EnterpriseAppStore/master/_orig/screens/screen2.jpg" alt="Applications page" />

Settings page:
<img src="https://raw.github.com/Ridiculous-Innovations/EnterpriseAppStore/master/_orig/screens/screen3.jpg" alt="Settings page" />

Builds calendar page:
<img src="https://raw.github.com/Ridiculous-Innovations/EnterpriseAppStore/master/_orig/screens/screen4.jpg" alt="Settings page" />

Categories page:
<img src="https://raw.github.com/Ridiculous-Innovations/EnterpriseAppStore/master/_orig/screens/screen5.jpg" alt="Settings page" />

Groups page:
<img src="https://raw.github.com/Ridiculous-Innovations/EnterpriseAppStore/master/_orig/screens/screen6.jpg" alt="Settings page" />

Edit group page:
<img src="https://raw.github.com/Ridiculous-Innovations/EnterpriseAppStore/master/_orig/screens/screen7.jpg" alt="Settings page" />



License
---
License has not yet been finalised. Eventually this system will be probably distributed under an MIT license, but any suggestions on this matter will be welcome.

Installation
---

We recommend you fork your own version of the system first, system works with some git submodules so please initialize with git submodules.

System is based on CakePHP 2.0 framework so please refer to the installation guide on http://www.cakephp.org.


Apart from that there is a few things you will have to do additionally.

* If you plan to upload Android apps, you will need to install Java on the server
* Uploading iOS apps requires a python script
* Create your MySQL database
* Try to go to the web url and go through the installation process (or Import database files)
* Change database configuration in /web/app/Config/database.php
* Change your Salt and cipherSeed codes in /web/app/Config/core.php (Please mind that changing these on a production server will fuck up your S3 folder structure as the system is using hash of these two values to generate base folders)
* Set writable permissions for Apache to the following folders
   - /web/app/tmp/
   - /web/app/Userfiles/
   - /web/app/webroot/Userfiles/
* You should be sorted !!!


```

			_░▒███████
			░██▓▒░░▒▓██
			██▓▒░__░▒▓██___██████
			██▓▒░____░▓███▓__░▒▓██
			██▓▒░___░▓██▓_____░▒▓██
			██▓▒░_______________░▒▓██
			_██▓▒░______________░▒▓██
			__██▓▒░____________░▒▓██
			___██▓▒░__________░▒▓██
			____██▓▒░________░▒▓██
			_____██▓▒░_____░▒▓██
			______██▓▒░__░▒▓██
			_______█▓▒░░▒▓██
			_________░▒▓██
			_______░▒▓██
			_____░▒▓██
			
			
```


Instruction for the used version of CakePHP
=======

[![CakePHP](http://cakephp.org/img/cake-logo.png)](http://www.cakephp.org)

CakePHP is a rapid development framework for PHP which uses commonly known design patterns like Active Record, Association Data Mapping, Front Controller and MVC.
Our primary goal is to provide a structured framework that enables PHP users at all levels to rapidly develop robust web applications, without any loss to flexibility.

Some Handy Links
----------------

[CakePHP](http://www.cakephp.org) - The rapid development PHP framework

[CookBook](http://book.cakephp.org) - THE CakePHP user documentation; start learning here!

[API](http://api.cakephp.org) - A reference to CakePHP's classes

[Plugins](http://plugins.cakephp.org/) - A repository of extensions to the framework

[The Bakery](http://bakery.cakephp.org) - Tips, tutorials and articles

[Community Center](http://community.cakephp.org) - A source for everything community related

[Training](http://training.cakephp.org) - Join a live session and get skilled with the framework

[CakeFest](http://cakefest.org) - Don't miss our annual CakePHP conference

[Cake Software Foundation](http://cakefoundation.org) - Promoting development related to CakePHP

Get Support!
------------

[#cakephp](http://webchat.freenode.net/?channels=#cakephp) on irc.freenode.net - Come chat with us, we have cake

[Google Group](https://groups.google.com/group/cake-php) - Community mailing list and forum

[GitHub Issues](https://github.com/cakephp/cakephp/issues) - Got issues? Please tell us!

[![Bake Status](https://secure.travis-ci.org/cakephp/cakephp.png?branch=master)](http://travis-ci.org/cakephp/cakephp)

![Cake Power](https://raw.github.com/cakephp/cakephp/master/lib/Cake/Console/Templates/skel/webroot/img/cake.power.gif)
