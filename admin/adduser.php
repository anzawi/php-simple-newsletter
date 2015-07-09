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

if(isset($_POST['addNewUser'])) {
    $post_ = escape($_POST);
    $errors = array();
    if(!preg_match("/^[a-zA-Z_\-.0-9]/", $post_['UserName'])) {
        $errors[] = "the username must be Latin characters , Numbers and ( . , - , _ ) charcters  ONLY ";
    }
    if(!filter_var($post_['UserEmail'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "invalid email address";
    }

    if(!count($errors)) {
        $send = new Sender();
        if($send->sendThanksTemplateAndActivationKey($post_['UserName'],
                        $post_['UserEmail'])) {
            echo "Added Successfuly ... See your Email ....";
        } else {
            echo implode('<br>', $send->getErrors());
        }
    } else {
        echo implode('<br>', $errors);
    }
}
?>

<form method="POST">
    User Name: <input name="UserName" type="text"> 
    <br><br>
    User Email: <input name="UserEmail" type="text">
    <br>
    <br>
    <br>
    <input name="addNewUser" type="submit" value="Add New Subscriber">
</form>