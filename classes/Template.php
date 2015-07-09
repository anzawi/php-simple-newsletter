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
 * Template
 * 
 * @package newsletter
 * @author Mohammad Anzawi
 * @copyright 2015
 * @access public
 */
class Template
{

    /**
     * Template::createOrUpdate()
     * create new or update email template
     * @param mixed $tempName
     * @param mixed $tempContent
     * @return bool
     */
    public function createOrUpdate($tempName, $tempContent) {
        //$tempContent = htmlspecialchars($tempContent);
        //echo ROOT; die();
        /*
         * open file if exist if not it well be create 
         */
        // if open or create file correctly
        if($newTemplate = fopen(ROOT . 'email_templates/' . $tempName . '.html',
                'w')) {
            // write new content
            fwrite($newTemplate, $tempContent);
            
            // close file
            fclose($newTemplate);
            return true;
        }
        
        // return false if unable to update or create file
        return false;
    }

    // view avaliable templates
    /**
     * Template::show()
     * this method well be read all files in directory (folder {email_templates})
     * store it in array
     * @return array
     */
    public function show() {
        // get all files in directory
        $templates = scandir(ROOT . 'email_templates');
        
        // remove parent folders
        $templates = array_diff($templates, array('.', '..', '...'));

        /*
          $x = 0;
          foreach($templates as $template) {
          if($template == '.' || $template == '..') {
          unset($templates[$x]);
          }
          $x++;
          }
         */

        return $templates;
    }

    /**
     * Template::getContent()
     * get code from template file
     * @param string $fileName
     * @return string if reade content bool(false) if not
     */
    public function getContent($fileName = '') {
        if($fileName) {
            // check if file exist
            $file = ROOT . 'email_templates/' . $fileName . '.html';
            if(file_exists($file)) {
                // get file content
                $content = file_get_contents($file);
                //return content
                return htmlspecialchars($content);
            }
        }

        return false;
    }

}
