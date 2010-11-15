<style type="text/css">
    * 
    {
        font-family: monospace;
    }
    ul li
    {
        padding: 10px;
    }
    div
    {
        padding: 10px;
        border: 1px solid black;
        margin: 10px auto;
    }
    a[href="#top"]
    {
        float:right;
    }
</style>
<h1 id="top"> Changes from the default CI </h1>
<ul>
    <li>
        moved application directory out of system/ to project root
    </li>
    <li>
        autoloaded common helpers and libraries
    </li>
    <li>
        common styling on forms (public/css/forms.css) and tables (public/css/tables.css)
    </li>
    <li>
        Included JQuery ver 1.4.2 (public/js/jquery.js)
    </li>
    <li>
        Bare layout with proper headers for loading the css and jquery (layouts/main.php)
    </li>
    <li>
        PDO driver for SQLite3 by Xintrea, readme file at <a href="<?php echo base_url()?>system/database/drivers/pdo/readme.txt">system/database/drivers/pdo/readme.txt</a>
    </li>
    <li>
        default sqlite3 database at sqlite/database.sqlite <a href="#note-5">(5)</a>
    </li>
    <li>
        custom controller: MY_Controller <a href="#note-1">(1)</a>
    </li>
    <li>
        gate controller that handles landing, login and logout. <a href="#note-2">(2)</a>
    </li>
    <li>
        admin controller with logged in user checking, dashboard and change password. <a href="#note-3">(3)</a>
    </li>
    <li>
        auto-animation of flashdata 'message' when exists <a href="#note-4">(4)</a>
    </li>
</ul>

<hr />

<h2> Notes </h2>
<div id="note-1">
(1) This page is located at views/gate/home.php, the render function is declared in libraries/MY_Controller.php as follows:
    <pre>
	    protected $main = array();
	    protected function render($view_file = null, $template = 'layouts/main') 
	    {
		    if (isset($view_file)) $this->main['body'] = $this->load->view($view_file, $this->main, true);
		    $this->load->view($template, $this->main);
	    }
    </pre>
<br />
    You set other variables to be passed to the layout via <pre> $this->main </pre> array at the controller that extends MY_Controller.
    <br /><a href="#top">Back to top</a><br />
</div>

<div id="note-2">
(2) 
FIXME: Review the security of login/logout methods
Related files:
    <ul>
        <li>
            controller/gate.php
        </li>
        <li>
            models/admins_model.php
        </li>
        <li>
            views/gate/home.php (this file) and views/gate/login.php
        </li>
    </ul>
    <br /><a href="#top">Back to top</a><br />
</div>

<div id="note-3">
(3) Related files:
    <ul>
        <li>
            controller/admin.php
        </li>
        <li>
            models/admins_model.php
        </li>
        <li>
            views/admin/dashboard.php and views/admin/change_password.php
        </li>
    </ul>
    <br /><a href="#top">Back to top</a><br />
</div>
<div id="note-4">
(4) Set flashdata via: $this->session->set_flashdata('message','Your message here')). Display and effects code is located at layouts/main.
<br /><a href="#top">Back to top</a><br />
</div>
<div id="note-5">
(5) SQL for default database with (username,password) set as (admin,admin) is:
<pre>
DROP TABLE IF EXISTS "admin";
CREATE TABLE admin (
	id integer not null unique primary key,
	username varchar(30) unique,
	password varchar(40),
	salt varchar(40)
);
INSERT INTO "admin" VALUES(1,'admin','a39880be61aeed7d19da94912f546e8632967d30','d033e22ae348aeb5660fc2140aec35850c4da997');
</pre>
I use the Firefox plugin, <a href="http://sqlite-manager.googlecode.com/">SQLite Manager</a> to administer my sqlite databases
<br /><a href="#top">Back to top</a><br />
</div>

<pre> This readme file is located at views/gate/home.php </pre>
