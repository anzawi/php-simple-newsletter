<?php
/**
 * DEMO FILE .. 
 */
require_once 'load.php';
$data = array(
    'u_name' => 'test',
    'u_email' => 'test',
    'activation_key' => 'test'
);

if(isset($_POST['add_user'])) {
    $errors = array();
    $post_ = escape($_POST);

    if(!preg_match("/^[a-zA-Z_\-.0-9]/", $post_['user_name'])) {
        $errors[] = "the username must be Latin characters , Numbers and ( . , - , _ ) charcters  ONLY ";
    }
    if(!filter_var($post_['user_email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "invalid email address";
    }

    if(!count($errors)) {
        $send = new Sender();
         if($send->sendThanksTemplateAndActivationKey($post_['user_name'],
            $post_['user_email']))
         {
         echo "Added Successfuly ... See your Email ....";
         } else {
             echo implode('<br>', $send->getErrors());
         }
    
    } else {
        echo implode('<br>', $errors);
    }
}
?>

<form action="?subscribe=on" method="POST">

    <input type="text" name="user_name"> <br>
    <input type="text" name="user_email"> <br>


    <input type="submit" name="add_user" value="subscribe"> 

</form>