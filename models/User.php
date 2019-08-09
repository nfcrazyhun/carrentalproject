<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $auth_key
 * @property string $created_at
 * @property string $modified_at
 * @property int $status
 * @property int $role
 *
 * @property Rental[] $rentals
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    //define role constants
    const ROLE_USER = 0;
    const ROLE_ADMIN = 1;

    //define status constants
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'modified_at'], 'safe'],
            [['status', 'role'], 'integer'],
            [['username', 'password', 'email', 'auth_key'], 'string', 'max' => 255],
            [['auth_key'], 'unique'],
            // username,email,password attributes are required
            [['username', 'password', 'email'] ,'required'],
            // password must be minimum 5 character
            [['password'],'string', 'min'=>5],
            // the email attribute should be a valid email address
            [['email'],'email'],
            ['role', 'default', 'value' => 0],
            ['role', 'in', 'range' => [self::ROLE_USER, self::ROLE_ADMIN]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'auth_key' => 'Auth Key',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
            'status' => 'Status',
            'role' => 'Role',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentals()
    {
        return $this->hasMany(Rental::className(), ['user_id' => 'id']);
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface|null the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException();
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled. The returned key will be stored on the
     * client side as a cookie and will be used to authenticate user even if PHP session has been expired.
     *
     * Make sure to invalidate earlier issued authKeys when you implement force user logout, password change and
     * other scenarios, that require forceful access revocation for old sessions.
     *
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }


    //from LoginForm
    /**
     * Finds user by name
     * @param $username
     * @return User|null
     */
    public static function findByUsername($username){
        return self::findOne(['username'=>$username]);
    }

    public function validatePassword($password){
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }


    /**
     * Returns user is admin or not.
     * @param $id
     * @return bool
     */
    public static function isUserAdmin($id)
    {
        if (static::findOne(['id' => $id, 'role' => self::ROLE_ADMIN])) {
            return true;
        }
        return false;
    }

    /**
     * Write proper status labels instead of ids
     * @return string|null
     */
    public function getRentalStatus(){
        $statusCode = $this->status;
        $statusText = null;

        switch ($statusCode) {
            case self::STATUS_ACTIVE:
                $statusText = 'Active';
                break;
            case self::STATUS_INACTIVE:
                $statusText = 'Inactive';
                break;
            default:
                $statusText = null;
        }

        return $statusText;
    }

    /**
     * Write proper status labels instead of ids
     * @return string|null
     */
    public function getUserStatus(){
        $statusCode = $this->status;
        $statusText = null;

        switch ($statusCode) {
            case self::STATUS_ACTIVE:
                $statusText = 'Active';
                break;
            case self::STATUS_INACTIVE:
                $statusText = 'Inactive';
                break;
            default:
                $statusText = null;
        }

        return $statusText;
    }

    /**
     * Write proper status labels instead of ids
     * @return string|null
     */
    public function getUserRole(){
        $roleCode = $this->role;
        $roleText = null;

        switch ($roleCode) {
            case self::ROLE_USER:
                $roleText = 'User';
                break;
            case self::ROLE_ADMIN:
                $roleText = 'Admin';
                break;
            default:
                $roleText = null;
        }

        return $roleText;
    }

}
