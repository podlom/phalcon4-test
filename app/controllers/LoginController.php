<?php
/**
 * Created by PhpStorm.
 * User: Taras
 * Date: 07.10.2020
 * Time: 16:20
 *
 * @author Taras Shkodenko <taras@shkodenko.com>
 */

use Phalcon\Http\Request;


class LoginController extends ControllerBase
{
    public function indexAction()
    {

    }

    public function loginAction()
    {
        $request = new Request();

        if ($request->isPost()) {
            $login = $request->getPost('login');
            error_log(__METHOD__ . ' +' . __LINE__ . ' login: ' . var_export($login, true));
            $password = $request->getPost('password');
            error_log(__METHOD__ . ' +' . __LINE__ . ' password: ' . var_export($password, true));

            $user = User::find(['conditions' => 'login = :login: AND password = :password:',
                'bind' => ['login' => $login, 'password' => $password]
            ]);

            error_log(__METHOD__ . ' +' . __LINE__ . ' found user: ' . print_r($user, true));
        }
    }
}