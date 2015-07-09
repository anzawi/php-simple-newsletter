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

/**
 * 
 * this class have one method only 
 * to replace shortcode from emails templates .html to real information 
 *
 */

class ShortCode
{

    public static function convert($msg, $name, $email, $activation_key = '') {

        // repalce [user_name] to $name
        $msg = str_replace('[user_name]', $name, $msg);
        // repalce [user_email] to $email
        $msg = str_replace('[user_email]', $email, $msg);

        // if isset $activation_key replace it 
        if($activation_key) {
            $msg = str_replace('[activation_key_link]',
                    'http://' . $_SERVER['HTTP_HOST'] . '/activate?key=' . $activation_key,
                    $msg);
        }
        
        // return $msg with real subscriber information
        return $msg;
    }

}
