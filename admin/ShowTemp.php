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

<div style="float:left; width: 15%;"
<?php
$prifex = (isset($_GET['page'])? '?page=ShowTemp&temp=' : '?temp=');
$templates = new Template();

echo "<ul>";
foreach($templates->show() as $template) {
    $template = str_replace(".html", '', $template);
    echo "<li> <a href='" . $prifex . $template . "'>" . $template . "</a></li>"; 
}
echo "</ul>"
. "</div>";

if(isset($_GET['temp'])) {
    $temp = htmlspecialchars($_GET['temp']);
    if(file_exists(ROOT . 'email_templates/' . $temp . '.html')) {
        ?>
     <form method="POST" style="float:left; width: 70% !important;">
        Name :  <input type="text" name="title" value="<?php echo $temp ?>">
         <br><br>Content :<br>
         <textarea id="textEditor" name="temp_content" style="height:500px;resize:none; width: 70% !important;">
                 <?php echo $templates->getContent($temp); ?>
        </textarea>
         <br>
         <input type="submit" value="Save Template" name="save_temp">
    </form>
        
        <?php
    }else {
        echo "error No Template Found ....   ";
    }
}
