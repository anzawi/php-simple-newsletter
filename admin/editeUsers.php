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
#
// create object from Subscribe class
$subsc = new Subscribe();

/**
 * 
 * 
 * I do not know what I am documenting this file
 * so if you have any question -> ask me on m.anzawi2013@gmail.com
 * or visit my blog on http://www.phptricks.org
 * 
 * 
 */

if(isset($_GET['Activate'])) {
    $get = escape($_GET);
   // $subscriber = $subsc->getAllSubscribers("WHERE u_id={$get['activate']}");
    $data = array(
        'u_id' => $get['Activate'],
        'u_active' => 1
    );
    if($subsc->update($data)) {
        echo "Activated";
    } else {
        echo "Unable to Activate" . implode('<br>', $subsc->errors());
        
    }
     
} elseif(isset($_GET['Deactivate'])) {
    $get = escape($_GET);
    $data = array(
        'u_id' => $get['Deactivate'],
        'u_active' => 0
    );
    if($subsc->update($data)) {
        echo "Deactivatd";
    } else {
        echo "Unable to Deactivate" . implode('<br>', $subsc->errors());
    }
}
?>
<style>
    td {
        padding: 10px; text-align: center; border: 1px solid #333;
    }
</style>
<p>
    Here You Can activate or deactivate Subscribers.
</p>
<table>
    <thead>
        <tr>
            <td>User Name</td>
            <td>User Email</td>
            <td>Action</td>
        </tr>
    </thead>

    <tbody>
        <?php
        foreach($subsc->getAllSubscribers() as $subs) {
        ?>
        <tr>
            <td><?php echo $subs->u_name; ?></td>
            <td><?php echo $subs->u_email; ?></td>
            <td><a href="?page=editeUsers&<?php echo ($subs->u_active == 0 ? 'Activate=': 'Deactivate=') . $subs->u_id; ?>"><?php echo ($subs->u_active==0 ? 'Activate': 'Deactivate');?></a></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>