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

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Panel</title>
        <style>
            /**
            
            this stile for textarea to look like code editors
            
           I have created this style to answer beginner , where they do not know how do this
            
            */
            #textEditor {
                background-color: #f4f4f4;
                background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(50%, #f4f4f4), color-stop(50%, #e5e5e5));
                background-image: -webkit-linear-gradient(#f4f4f4 50%,#e5e5e5 50%);
                background-image: -webkit-gradient(linear, left top, left bottom, color-stop(50%, #f4f4f4), color-stop(50%, #e5e5e5));
                background-image: -webkit-linear-gradient(#f4f4f4 50%, #e5e5e5 50%);
                background-image: linear-gradient(#f4f4f4 50%,#e5e5e5 50%);
                -webkit-background-size: 38px 38px;
                background-size: 38px 38px;
                border: 1px solid #c5c5c5;
                display: block;
                line-height: 19px;
                margin-bottom: 10px;
                overflow: visible;
                overflow-y: hidden;
                padding: 0 0 0 4px;
                font-family: monospace;
            }
        </style>
</head>
<body>
    <div style="float: left; width: 20%; padding: 10px">
        <ul>
            <li><h5>Manage Subscribers</h5>
                <ul>
                    <li><a href="?page=addUser">Add New Subscriber</a></li>
                    <li><a href="?page=editeUsers">Change Subscribers</a></li>
                    <li><a href="?page=deleteUser">Delete Subscriber</a></li>
                </ul>
            </li>
            <li><h5>Manage Templates</h5>
                <ul>
                    <li><a href="?page=ShowTemp">View Avaliable Message Template</a></li>
                    <li><a href="?page=CreateTemp">Create New Message Template</a></li>
                </ul>
            </li>
            <li><h5>Send New</h5>
                <ul> <li><a href="?page=sendNew">Send New Message</a></li></ul>     
            </li>

        </ul>
    </div>
    <div style="float: left; width: 70%; padding: 10px">
        <?php
        if(isset($_GET['page'])) {
            $page = htmlspecialchars($_GET['page']);

            if(file_exists($page . '.php')) {
                include_once ($page . '.php');
            } else {
                echo "the page is not exist , error 404";
            }
        } else {
            include_once 'ShowTemp.php';
        }
        ?>
    </div>
</body>
</html>
