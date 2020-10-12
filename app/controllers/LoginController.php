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
use Phalcon\Http\Response;
use Phalcon\Http\Response\Cookies;


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
            // error_log(__METHOD__ . ' +' . __LINE__ . ' login: ' . var_export($login, true));
            $password = $request->getPost('password');
            // error_log(__METHOD__ . ' +' . __LINE__ . ' password: ' . var_export($password, true));

            $user = User::find(['conditions' => 'login = :login: AND password = :password:',
                'bind' => ['login' => $login, 'password' => $password]
            ])->getFirst();
            // error_log(__METHOD__ . ' +' . __LINE__ . ' Found $user: ' . print_r($user, true));

            if (!$user) {
                echo '<p>User with such login and password was not found. <a href="/signup">Sign Up here</a> if you does not have account yet.</p>';
            } else {
                $now = new \DateTimeImmutable();
                $tomorrow = $now->modify('tomorrow');
                $this->cookies->set(
                    User::COOKIE_USER_KEY,
                    json_encode(
                        [
                            'user_name' => $user->first,
                        ]
                    ),
                    (int) $tomorrow->format('U')
                );

                echo '<p>Welcome back, ' . $user->first . '. <a href="/login/logout">Log Out</a>.</p>';
            }
        }
    }

    public function logoutAction()
    {
        $now = new \DateTimeImmutable();
        $yesterday = $now->modify('yesterday');
        $this->cookies->set(
            User::COOKIE_USER_KEY,
            json_encode([]),
            (int) $yesterday->format('U')
        );
        
        $response = new Response();
        $response->redirect('/login?rand=' . random_int(1, 9999));
    }
}