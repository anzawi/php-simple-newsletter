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

$temp = new Template();
$subsc = new Subscribe();

if(isset($_POST['send'])) {
    $send = new Sender();
    $tempName = str_replace('.html', '', $_POST['tempName']);
    $templ['content'] = $temp->getContent($tempName);
    $templ['title'] = $_POST['title'];
    $emails = $_POST['subsc'];

    if($send->sendNewsLitter($emails, $templ)) {
        echo "Send Succcessfuly";
    } else {
        echo "Unabl to Send";
    }
}
?>
<form method="POST">
    <div style="width:20%; float: left;">
        Message Title : <input type="text" name="title"><br><br>
        <h3>Choice Template</h3>


        <?php
        foreach($temp->show() as $template) {
            ?>
            <label><input type="radio" value="<?php echo $template; ?>" name="tempName"> <?php echo $template; ?></label><br>
            <?php
        }
        ?>
        <br><br>
        <a href="?page=CreateTemp">Create New Template</a>
    </div>
    <div style="width: 75%; float: left; border-left: 2px solid #333; height: 300px; overflow-y: scroll;">
        Select Subscribers<br>
        <?php
        //print_r($subsc->getAllSubscribers());die();
        foreach($subsc->getAllSubscribers('WHERE u_active=1') as $subscriper) {
            ?>
            <label>
                <input  type="checkbox" value="<?php echo $subscriper->u_id ?>" name="subsc[]">
                <?php echo $subscriper->u_name ?>
            </label>
            <br>
            <?php
        }
        ?>
    </div>

    <input type="submit" value="Send" name="send">
</form>
