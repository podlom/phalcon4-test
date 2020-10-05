<?php

use \Phalcon\Validation;
use \Phalcon\Validation\Validator\Uniqueness,
    \Phalcon\Validation\Validator\PresenceOf,
    \Phalcon\Validation\Validator\StringLength;


class User extends \Phalcon\Mvc\Model
{

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

        return $this->validate($validator);
    }

}
