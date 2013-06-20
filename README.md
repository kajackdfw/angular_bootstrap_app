<h3>About This Demo / Site Template</h3>
<pre>
This project is intended to be a basic AngularJS site template, ready for cloning into a new site, 
with working samples of all basic methods needed for a secure AngularJS Site with secured 
Rest Services. An excellent reference for this app is the book "Instant AngularJS Starter" by 
Dan Menard. His book describes in detail most of the basic methods used in this app. 
For a preview this app goto http://www.estimutt.com/SeedApp.html  
</pre><br /> 


<h3>This demo ( git branch basic ) features :</h3>
<ul>
<li>Basic view routing, ( not page routing, as this is a single page application )</li>
<li>Static data models ( No Rest Server yet, coming soon.)</li>
<li>Twitter Bootstrap UI / CSS</li>
<li>Simple View Controller</li>
</ul>

<h3>Data Base Schema</h3>
<pre>
CREATE DATABASE seedapp ;
USE seedapp ;

CREATE TABLE user (
user_id INTEGER UNSIGNED AUTO_INCREMENT,
user_first_name VARCHAR(18),
user_last_name  VARCHAR(18),
user_email VARCHAR(128),
user_phone VARCHAR(128),
user_password VARCHAR(255),
PRIMARY KEY(user_id));
INSERT INTO user VALUES ( 1,"Sheldon","Cooper","scooper@bigbang.com","211-707-9595",SHA1("shazam99") );
  
CREATE TABLE user_session (
user_session_id INTEGER UNSIGNED AUTO_INCREMENT,
user_session_sid INTEGER NOT NULL,
user_session_key CHAR(16) DEFAULT "none",
user_session_start timestamp DEFAULT NOW(),
user_session_expires datetime,
user_id INTEGER NOT NULL,
PRIMARY KEY(user_session_id));
</pre>

<h3> Session Data in backend or remote services server</h3>
<pre>
[user] => Array    
	[id] => 1
	[first_name] => Sheldon
	[last_name] => Cooper
	
[session] => Array 
	[key] => HOKTQ:1       
	[id] => 6lsjnaka9i43p9pifbmse7sv51
</pre>