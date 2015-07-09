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

require_once '../load.php';


if(avtivationEmail()) {
    echo "you Email Activated";
} else {
    echo "Cant Activate Your Email";
}

function avtivationEmail() {
    if(isset($_GET['activationkey'])) {
        $get = escape($_GET);

        // create database object 
        $db = DB::connect();

        // explode $_GET['activationkey'] when see 9621545 
        // why ?? look at line 87 in Sender Class -> (ns/classes/Sender.php)
        $get = explode('9621545', $get['activationkey']);

         $email = $get[0];
         $key = $get[1];

        $getSubscriber = $db->query("SELECT * FROM subscribers WHERE u_email = ? AND activation_key = ?",
                        array($email, $key))->results();
        

        // if count then subscriber found
        if(count($getSubscriber)) {
            $getSubscriber = $getSubscriber[0];
            // update u_active to 1 and remove activation_key
            if($db->update('subscribers',
                            array('activation_key' => null, 'u_active' => 1),
                            array('u_id', "=", $getSubscriber->u_id))) {
                return true;
            }
        }
    }
    return false;
}
