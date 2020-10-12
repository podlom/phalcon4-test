<?php
declare(strict_types=1);

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        // error_log(__METHOD__ . ' User::COOKIE_USER_KEY: ' . User::COOKIE_USER_KEY);
        $cookie = $this->cookies->get(User::COOKIE_USER_KEY);
        $cookieVal = $cookie->getValue();
        error_log(__METHOD__ . ' $cookieVal: ' . print_r($cookieVal, true));
        if (is_string($cookieVal) && !empty($cookieVal)) {
            $jsonData = json_decode($cookieVal, true);
            if (is_array($jsonData) && !empty($jsonData) && isset($jsonData['user_name'])) {
                $this->view->userName = $jsonData['user_name'];
            }
        }
    }

}

