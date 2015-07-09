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
 * 
 * I do not know what I am documenting this file
 * so if you have any question -> ask me on m.anzawi2013@gmail.com
 * or visit my blog on http://www.phptricks.org
 * 
 * 
 */

if(isset($_POST['save_temp'])) {
    if(!empty($_POST['title']) && !empty($_POST['temp_content'])) {

        if(saveTemplates($_POST['title'], $_POST['temp_content'])) {
            echo "Saved ... !";
        } else {
            echo "error Not Saved ... !";
        }
    } else {
        echo "all fields are required";
    }
}
?>
<form method="POST" style="float:left; width: 70% !important;">
    Name :  <input type="text" name="title" value="">
    <br><br>Content :<br>
    <textarea onkeydown="tabKey()" id="textEditor" name="temp_content" style="height:500px; resize:none; width: 70% !important;">
    </textarea>
    <br>
    <input type="submit" value="Save Template" name="save_temp">
</form>

