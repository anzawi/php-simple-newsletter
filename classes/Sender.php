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
 * Sender
 * this class responsible for sending confirmation messages for subscribe
 * and notify admin about new subscriber
 * and send emails message for subscribers
 * @package newsletter
 * @author Mr Mohammad Anzawi
 * @copyright 2015
 * @version 1.0.0
 * @access public
 */
class Sender extends Subscribe
{

    // email header 
    // to add html emails support
    const HEAD = "MIME-Version: 1.0 \r\n Content-type: text/html;charset=UTF-8 \r\n From: <noreplay@phptricks.org>";

    /**
     *
     * @var array $_errors
     */
    private
    //$_db,
            $_errors = array();

    /**
     * Sender::__construct()
     * 
     * @return void
     */
    public function __construct() {
        //$this->_db = DB::connect();
        parent::__construct();
    }

    /**
     * Sender::notifyAdminAboutNewsubscribe()
     * this function called when add new subscriber correctly
     * @param string $name username
     * @param string $email user email
     * @return void
     */
    private function notifyAdminAboutNewsubscribe($name, $email) {

        // get notfy_admin.html teplate
        $message = file_get_contents(ROOT . 'email_templates/notfy_admin.html');
        // replace shortcode with information
        $message = ShortCode::convert($message, $name, $email);
        // send email
        mail("admin@email.com", 'New subscriber in your Site', $message,
                self::HEAD);
    }

    /**
     * Sender::sendThanksTemplateAndActivationKey()
     * send confirmation messages for subscribe
     * @param string $name username
     * @param string $email user email
     * @return void
     */
    public function sendThanksTemplateAndActivationKey($name, $email) {
        // create actibation key to user confirmation link
        $activation_key = sha1(uniqid()) . time();

        // get thanks.htmltemplate
        $message = file_get_contents(ROOT . 'email_templates/thanks.html');
        // replace shortcode with information
        // note -> when send  $activation_key on link we concatenate with his email
        // look to (ns/activate.php) to see how we authenticate subscriber
        // and see (ns/email_templates/thanks.html) line 10 -> and replace (http://www.your_web_site) with your website url
        $message = ShortCode::convert($message, $name, $email, $email.'9621545'.$activation_key);
        // if send email add subscriber into table
        if(mail($email, 'Thanks For subscribe With Us', $message, self::HEAD)) {

            // subscriber information
            $data = array(
                'u_name' => $name, // name
                'u_email' => $email, // email 
                'activation_key' => $activation_key // activation key
                    // u_id its auto increment
                    // active by default zero
            );

            // insert new subscriper 
            if($this->add($data)) {
                // send email for admin
                $this->notifyAdminAboutNewsubscribe($name, $email);
                return true;
            }
        }
        return false;
    }

    /**
     * 
     * @param array $users
     * @param array $message  -> $message['title'] and $message['content']
     * @return boolean true if send email correctly
     */
    public function sendNewsLitter($users = array(), $message = array()) {
        if(count($users) && count($message)) {
            $error = false;

            //$users = implode(',', $users);
            foreach($users as $user) {
                $userInfo = $this->getAllSubscribers("WHERE u_id={$user}")[0];
                $userE = $userInfo->u_email;
                $userN = $userInfo->u_name;
                $message['content'] = ShortCode::convert($message['content'], $userN, $userE);
                if(!mail($userE, $message['title'], $message['content'],
                                self::HEAD)) {
                    
                    $error = true;
                }
            }
            
            if(!$error) {
                return true;
            }
        }
        return false;
    }

    public function getErrors() {
        return $this->errors();
    }

}
