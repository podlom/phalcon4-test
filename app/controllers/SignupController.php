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
            $login = $request->getPost('login');
            error_log(__METHOD__ . ' +' . __LINE__ . ' $login: ' . var_export($login, true));
            $password = $request->getPost('password');
            error_log(__METHOD__ . ' +' . __LINE__ . ' $password: ' . var_export($password, true));
        }
    }
}