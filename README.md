LaoGoaL - Livescore component for Joomla 
------------------------------------------

[__demo__](http://demo.laogoal.com/)

LaoGoaL - is an opensource  project founded to create football(soccer) livescore extension for Joomla CMS. 

By default the product is given as a component (`com_laogoal`) which displays matches and standings, but the main goal is to create a platform which provides interaction of the your Joomla site with livescore data provider in order to push livescore updates into database of your site. That `platform` is a component named `com_lgl`, which installed automatically after you install `com_laogoal`. So you can not only use `com_laogoal` to display livescores, but you can create your own or customize other Joomla extensions to get data from Laogoal's MySQL tables and display it as you wish. 

For easy work with Laogoal's data, Laogoal Core component has its own PHP API based on Joomla Framework, which contains methods to fetch, filter and display data from database tables. 

How much this product costs
---------------------------
You can get and install both components for free from here, but subscription for automatic data updates is not free. Please visit [laogoal.com](http://laogoal.com) if you want to subscribe for paid data updates. 

What com\_lgl and com\_laogoal are
----------------------------------
COM\_LGL is a core of LaoGoaL. 
It provides interaction of your site with data provider. It allows perform activation of automatic updates and then handles all job to keep your site up to date with data provider. 
Also it does all job related with data storing and retrieving. 
It contains PHP API which can be used by other developers to work with data from LaoGoaL's tables. 
COM\_LGL is in [this repo](https://github.com/laogoal/com_lgl) 

COM\_LAOGOAL is a component which was built in order to display LaoGoaL's data on site's pages. 
It displays matches and standings. Matches are updated automatically without page reload.
Also it allows bind different competitions to menu items via menu manager. 
It can be used by other developers as example for development of their own extensions.


What data comes with LaoGoaL
----------------------------
Current version of LaoGoaL comes with data for top leagues of 5 countries: England, France, Germany, Italy and Spain. Each competition includes data about all matches (finished, live, scheduled) and standings tables for current season. 
LaoGoaL's PHP API allows extaract following details about each match:
- id
- league id
- hosts team
- visitors team
- score
- match status [online, finished, not started, postponed]
- status of live match [first or last half, current minute, etc...]
- additional details [competition stage, round, matchday number, etc...]
- events - list of events happened in match - goals, red/yellow cards with player name and minute when event happened
- begintime - timestamp of kickoff time 
- lastupdatetime - timestamp when data about match updated last time
 
...and the following data about each standings row:
- league id
- team name
- position 
- points number
- goals [scored and conceded]
- matches [played, won, lost and finished in draw]

Requirements and Installation
-----------------------------
- Both LaoGoaL components can be installed on Joomla 3.*. 
- If you want automatic updates, the server where Joomla installed must be able to connect to our data provider's URL (api.goalapi.com) and your site must be accessible from global network via constant symbolic domain name or IP address (so do not try activate automatic updates on localhost).  

In order to install the component just download it as `.zip` archive or `git checkout` branch of the component to some folder and then install component from directory or archive as you usually install Joomla components. It's also possible just copy download link of component's repo and then feed it to Joomla's installer (install from URL). 
Please note: `com_laogoal` is useless without `com_lgl`, `com_laogoal` just provides front-end interface for data which comes with `com_lgl`. 
After `com_lgl` is installed it is necessary to initialize it and activate automatic updates. 
Open Components > LaoGoaL Component in admin (if you have `com_laogoal`) or just open `/administrator/index.php?option=com_lgl`. The system will lead you through initializatioon and activation

Support and collaboration
-------------------------
You can push your questions to 
- [our forum at google groups](https://groups.google.com/forum/#!forum/laogoal)
- open an issue https://github.com/laogoal/com_laogoal/issues  
- our support email support@laogoal.com.

Most frequently and interesting questions and answers will be published on this page. 

If you want extend this product anyway, you can fork Laogoals branches. I will look forward for your pull requests. 



