<?php

use \Phalcon\Http\Response\Cookies;
use \Phalcon\Validation;
use \Phalcon\Validation\Validator\Uniqueness,
    \Phalcon\Validation\Validator\PresenceOf,
    \Phalcon\Validation\Validator\StringLength;


class User extends \Phalcon\Mvc\Model
{
    const COOKIE_USER_KEY = 'admin_user';

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $login;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var string
     */
    public $first;

    /**
     *
     * @var string
     */
    public $last;

    /**
     *
     * @var integer
     */
    public $age;

    /**
     *
     * @var string
     */
    public $phone;

    /**
     *
     * @var string
     */
    public $driver;

    /**
     *
     * @var string
     */
    public $address;

    /**
     *
     * @var string
     */
    public $created;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("phalcon_db1");
        $this->setSource("user");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return User[]|User|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return User|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Validate user model
     *
     * @return bool
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add('login',
            new Uniqueness([
                'model' => $this,
                'message' => 'Your login is already in use',
            ])
        );

        $validator->add('login',
            new PresenceOf([
                'model' => $this,
                'message' => 'The login is required',
            ])
        );

        $validator->add('login',
            new StringLength([
                'model' => $this,
                'min' => 2,
                'max' => 32,
                'minMessage' => 'Your login must be at least 2 characters',
                'maxMessage' => 'Your login must be less than 32 characters',
            ])
        );

        $validator->add('password',
            new PresenceOf([
                'model' => $this,
                'message' => 'The password is required',
            ])
        );

        $validator->add('password',
            new StringLength([
                'model' => $this,
                'min' => 6,
                'max' => 18,
                'minMessage' => 'Your password must be at least 6 characters',
                'maxMessage' => 'Your password must be less than 18 characters',
            ])
        );

        $validator->add('first',
            new PresenceOf([
                'model' => $this,
                'message' => 'The first name is required',
            ])
        );

        $validator->add('first',
            new StringLength([
                'model' => $this,
                'min' => 2,
                'max' => 50,
                'minMessage' => 'Your first name must be at least 2 characters',
                'maxMessage' => 'Your first name must be less than 50 characters',
            ])
        );

        $validator->add('last',
            new PresenceOf([
                'model' => $this,
                'message' => 'The last name is required',
            ])
        );

        $validator->add('last',
            new StringLength([
                'model' => $this,
                'min' => 2,
                'max' => 50,
                'minMessage' => 'Your last name must be at least 2 characters',
                'maxMessage' => 'Your last name must be less than 50 characters',
            ])
        );

        $validator->add('age',
            new PresenceOf([
                'model' => $this,
                'message' => 'The age is required',
            ])
        );

        $validator->add('age',
            new StringLength([
                'model' => $this,
                'min' => 1,
                'max' => 2,
                'minMessage' => 'Your age must be at least 1 character',
                'maxMessage' => 'Your age must be less than 2 characters',
            ])
        );

        $validator->add('phone',
            new PresenceOf([
                'model' => $this,
                'message' => 'The phone is required',
            ])
        );

        $validator->add('driver',
            new PresenceOf([
                'model' => $this,
                'message' => 'The driver license number is required',
            ])
        );

        return $this->validate($validator);
    }

    public static function rememberUser($name)
    {
        $now = new \DateTimeImmutable();
        $tomorrow = $now->modify('tomorrow');

        $cookies = new Cookies();
        $cookies->set(
            self::COOKIE_USER_KEY,
            json_encode(
                [
                    'user_name' => $name,
                ]
            ),
            (int) $tomorrow->format('U')
        );
    }
}
