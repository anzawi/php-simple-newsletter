<?php 

#---------------------------------------------------------------------------#
# this Project Created by Mohammad Anzawi                                   #
#                                                                           #
# This project is intended for beginners and learners                       #
# The main objective of this project is to see the way do something similar,#
#  such as sending messages via e-mail, files Read the content and create   #
#  templates or other                                                       #
#   and saved on the server within a specific folder.                       #
# Can anyone who want to modify or development (add some functions, styles),# 
# and use it in his dite, or commercially.                                  #
#                                                                           #
#  so if you have any question -> ask me on m.anzawi2013@gmail.com          #
# or visit my blog on http://www.phptricks.org                              #
#---------------------------------------------------------------------------#

// set UTF-8 unicode
header("Content-Type: text/html; charset=utf8");

// database Information
define('HOST'   ,'localhost'); // host
define('DB'     ,'ns'); // database name
define('USER'   ,'root'); // username
define('PASS'   ,''); // password
define('CHARSET','utf-8'); // unicode utf-8 recommended



define('ROOT',__DIR__.'/'); // Root directory


/**
 * include required files
 */
// functions
require_once 'functions/functions.php';

/// autoload classes
spl_autoload_register(function($class) {
    require_once 'classes/' . $class . '.php';
});
