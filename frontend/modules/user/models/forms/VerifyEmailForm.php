<?php

namespace frontend\modules\user\models\forms;

use frontend\modules\user\models\records\user\User;
use yii\base\InvalidArgumentException;
use yii\base\Model;
use Yii;
/**
 * Verify Email Form
 *
 * @property string|null $token
 * @property User|null $_user
 */
class VerifyEmailForm extends Model
{
    public $token;
    private $_user;


    /**
     * Creates a form model with given token.
     *
     * @param string|null $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws InvalidArgumentException if token is empty or not valid
     */
    public function __construct( $token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException(Yii::t('user','Verify email token cannot be blank.'));
        }
        $this->_user = User::findByVerificationToken($token);
        if (!$this->_user) {
            throw new InvalidArgumentException(Yii::t('user','Wrong verify email token.'));
        }
        parent::__construct($config);
    }

    /**
     * Verify email
     *
     * @return User|null the saved model or null if saving fails
     */
    public function verifyEmail()
    {
        $user = $this->_user;
        $user->status = User::STATUS_ACTIVE;
        return $user->save(false) ? $user : null;
    }
}
