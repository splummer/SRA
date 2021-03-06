SRA - Squirrel Registration Authority
=====================================

This convention management registration system is born out of the old GAGG registrations system. It adds functionality to create and manage conventions.

Ideally it will be a system provided hosted convention management for many different gaming conventions and events. It also could be extended to offer community features such as comments etc.

Install Steps
-------------

Download codeigniter (CodeIgniter_2.1.0 currently) zip, just google it.  
Unzip codeigniter somewhere, and steal the contents of the /system/ folder within it. Copy everything in /system/*, and paste those folders into SRA's /system/ folder to form the running core of codeigniter for SRA. (Only the /system/libraries/Zend folder need be retained)

Create Database:

* createdb sra;
* createlang plpgsql sra;
* psql sra < schema/tank_auth_schema.sql
* psql sra < schema/acls.sql
* psql sra < schema/create.sql Contents of these tables is not used yet and very much in flux.

optionally: create a dummy, insecure dev user for non-public development environments so that dummy password can be the one used in applications/config/database.php:  
createuser -P -d -a -e dev


Modify configs files:

* ln -s gitignore.dist .gitignore (or copy gitignore.dist to gitignore)
* cp htaccess.dist .htaccess
* cp application/config/config.php.dist application/config/config.php
* cp application/config/database.php.dist application/config/database.php

edit htaccess with your proper root url path  
edit database settings in application/database.php to replace them with your own local settings  
edit pathing settings in application/config.php to your local path. (pretty much just the base_url variable)  

That should be it!  Debug any issues you have, but these steps should get you most of the way there!


Features implemented
--------------------

* User sign up authentication works, but needs a great deal of display clean up.
* ACLs are starting to be implemented.

Scope of the System
-------------------

This is quick outline of the things I expect the system to be able to do.

Basic Functionality:

* Users can sign up for the site
* Users can make Organizations
* Users can add other users to the organizations with different rights
* Users can create Events (Generally these would be Conventions, but it could just be a game day or a mini con or similar event) (At this time events always belong to an organization)
* Users can define Time Slots for their event and those times slots will be shown for session submission.
* Users can create different "badges" for their event, define costs, define validity periods etc.
* Users can create sessions and then submit those sessions to events so they show up as available at that event. (I am not sure if sessions should only be allowed to belong to one event or not. It seems like too many things could be different across events (different event editors and session lengths etc) that it would just make more sense to tailor each session to an event).
* Users can sign up to play and/or run various sessions.
* Users can pay for all of this on the site.
* Users can define various resources for their event (usually these would be rooms).
* Sessions can be assigned to resources, scheduling interface for them.
* Sessions times at an event will be stored as time in the DB. Allowing for different start/end times.
* ACLs will exist to give fine grained control.
* Actions will be logged such as session/event/org modifications.
* RSS feed of events for the convention
* Rewards system to allow for free badges for running X number of events.
* Exporting of an event's sessions for making of print materials.
* Have an excellent Mobile UI.
  
Features it would be nice to have in the future
-----------------------------------------------

* Merchandizing
* Fancy scheduling/calendar interface
* Admin interface with charts and graphs of attendance/revenues
* CMS functionality - News, Travel Page, Guests/Speakers, Vendors, About
* Ability to "like" orgs, events, sessions, or GMs.
* Perhaps the ability to comment on events or sessions?
* Ability to handle the accounting of a convention
* Ability to sign up multiple users for events/sessions at once
* Ability for a users to sign up as a group for sessions.
* Free for all scheduling (no time slots)
* RSS feed of events by a person/organization, if that person allows it.
* Volunteer management. sign up/scheduling.
* Integration with Mailchimp for mailing list management.

Links for reference
-------------------

### A great series on learning Codeigniter:

* **Link:** http://net.tutsplus.com/sessions/codeigniter-from-scratch/

### Authentication system based on Tank_Auth

* **Link:** http://konyukhov.com/soft/tank_auth/

I used a version found on github with postgres support, that I further modified the sql for.
 
* **Link:** https://github.com/ericbae/TAPS

### A few items I came across that I used while reading about Tank Auth
   
#### Loading more logged in variables for all controllers: 

* **Link:** http://codeigniter.com/forums/viewreply/799018/
   
#### How to redirect to the page you were on when logging in:

* **Link:** http://codeigniter.com/forums/viewthread/59412/#801348

#### Possible Nice way of doing view loads (I used this saw it recommended elsewhere too):

* **Link:** http://codeigniter.com/forums/viewreply/722006/

I looked at community auth closely too but ultimately i could understand it less and there was a lot more to it I felt I would need to change than with tank_auth.

* **Link:** http://community-auth.com/

### ACLs use ZendACL (for now)

I am using a hybrid of these three tutorials
 
* **Link:** http://www.mattstone.me/?p=3
* **Link:** http://lucdebrouwer.nl/adding-zend-acl-to-codeigniter/
* **Link:** http://codeutopia.net/blog/2009/02/06/zend_acl-part-1-misconceptions-and-simple-acls/

#### Zend ACL intro:

* **Link:** http://framework.zend.com/manual/en/zend.acl.introduction.html

#### Some tutorials on ACLs in general

* **Link:** http://net.tutsplus.com/tutorials/php/a-better-login-system/

#### I used this site to generate the random hashes I needed:

* **Link:** https://www.grc.com/passwords.htm

### Bootstrap presentation layer

* **Link:** http://twitter.github.com/bootstrap/
* **Link:** http://www.alistapart.com/articles/building-twitter-bootstrap/
* **Link:** https://github.com/twitter/bootstrap/issues/445

#### Page for fancy bootstrap buttons
* **Link:** http://charliepark.org/bootstrap_buttons/

### Mailchimp with codeigniter:

* **Link:** https://github.com/codepotato/codeigniter-mailchimp-api

### Git branch model I would like to implement:

* **Link:** http://nvie.com/posts/a-successful-git-branching-model/

### Touch UI possibility:

* **Link:** http://jquerymobile.com/

### For credit card processing I think we should use Stripe:
* **Link:** https://stripe.com/

Random Musings, things to Look into
-----------------------------------

### Fonts/Icons:
* **Link:** http://glyphicons.com/ (cannot redistribute)
* **Link:** https://github.com/twitter/bootstrap/issues/966

### Q. Should all times be stored in GMT?

The current ACL system seems extremely inefficient. The entire ACL is generated every time it is checked. We may want to look into storing the ACL somewhere.

### Could be useful for redirection to the page someone was one when they login

Link: http://stackoverflow.com/questions/2652930/codeigniter-how-to-redirect-after-login-to-current-controller-php-self-in-regu