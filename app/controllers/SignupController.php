<?php
/**
 * Created by PhpStorm.
 * User: Taras
 * Date: 02.10.2020
 * Time: 17:26
 *
 * @author Taras Shkodenko <taras@shkodenko.com>
 */

use Phalcon\Http\Request;


class SignupController extends ControllerBase
{

    public function indexAction()
    {

    }

    public function registerAction()
    {
        // @see https://docs.phalcon.io/4.0/en/request
        $request = new Request();

        // Check whether the request was made with method POST
        if ($request->isPost()) {
            error_log(__METHOD__ . ' +' . __LINE__ . ' it is POST request');

            $user = new User();
            $user->login = $request->getPost('login');
            error_log(__METHOD__ . ' +' . __LINE__ . ' login: ' . var_export($user->login, true));
            $user->password = $request->getPost('password');
            error_log(__METHOD__ . ' +' . __LINE__ . ' password: ' . var_export($user->password, true));
            $user->firstName = $request->getPost('first');
            error_log(__METHOD__ . ' +' . __LINE__ . ' first: ' . var_export($user->firstName, true));
            $user->lastName = $request->getPost('last');
            error_log(__METHOD__ . ' +' . __LINE__ . ' last: ' . var_export($user->lastName, true));
            $user->age = $request->getPost('age');
            error_log(__METHOD__ . ' +' . __LINE__ . ' age: ' . var_export($user->age, true));
            $user->phone = $request->getPost('phone');
            error_log(__METHOD__ . ' +' . __LINE__ . ' phone: ' . var_export($user->phone, true));
            $user->driverLicense = $request->getPost('driver');
            error_log(__METHOD__ . ' +' . __LINE__ . ' driver: ' . var_export($user->driverLicense, true));
            $user->address = $request->getPost('address');
            error_log(__METHOD__ . ' +' . __LINE__ . ' address: ' . var_export($user->address, true));
            $user->created = date('Y-m-d H:i:s');
            // $result = $user->save();
            // $result = $user->save(null, ['createdAt']);
            $result = $user->create();
            if ($result === false) {
                $messages = $user->getMessages();
                $errorMessages = '';
                foreach ($messages as $message) {
                    $errorMessages .= $message . PHP_EOL;
                }
                echo 'User registration has failed with errors: ' . $errorMessages;
            } else {
                echo 'User has signed up. Now you can <a href="/login">Login</a>.';
            }
        }
    }
}