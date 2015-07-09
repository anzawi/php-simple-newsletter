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
 * escape function accespted an array ($_POST, $_GET)
 * and use htmlspecialchars for all array elements
 * @param array $data
 * @return array
 */
function escape($data = array()) {
    // if $data isset
    if(count($data)) {

        // get $data array keys
        $keysGet = array_keys($data);
        /**
         * @var integer $x count of $keysGet
         */
        $x = sizeof($keysGet);

        // for loop to escape all values
        for($i = 0; $i < $x; $i++) {
            $data[$keysGet[$i]] = htmlspecialchars($data[$keysGet[$i]],
                    ENT_QUOTES);
        }
    }

    // return $data
    return $data;
}

// create or update email templates
/**
 * 
 * @param string $temp name of file
 * @param string  $content the new content of template
 * @return boolean
 */
function saveTemplates($temp = '', $content = '') {
    if($temp && $content) {
        // create object from Template class
        $tepmlate = new Template();
        // call createOrUpdate method
        // this method on (ns/classes/Template)
        $tepmlate->createOrUpdate($temp, $content);
        return true;
    }

    return false;
}
