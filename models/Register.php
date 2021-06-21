<?php
namespace app\models;
use mdm\admin\components\UserStatus;
use Yii;
use yii\helpers\ArrayHelper;
class Register extends \yii\db\ActiveRecord
{
    public $username;
    public $email;
    public $password;
    public $retypePassword;
    public static function tableName()
    {
        return 'user';
    }
    public function rules()
    {
       return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'message' => 'This username is already taken, please try another one.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['retypePassword', 'required'],
            ['retypePassword', 'compare', 'compareAttribute' => 'password'],
            [['id_data'], 'integer']
        ];
    }
    public function signup($id_data=null,$nip=null,$email=null)
    {
        if ($this->validate()) {
            $class = Yii::$app->getUser()->identityClass ? : 'mdm\admin\models\User';
            $user = new $class();
            $user->username = (!empty($nip))?$nip:$this->username;
            $user->email = (!empty($email))?$email:$nip.'@gmail.com';
            $user->id_data = (!empty($id_data))?$id_data:$this->id_data;
            $user->status = 10;
            $user->setPassword((!empty($nip))?'123456':$this->password);
            $user->generateAuthKey();
            if ($user->save(false)) {
                $level=new AuthAssignment();
                $level->item_name='karyawan';
                $level->user_id=$user->id;
                $level->created_at=time();
                $level->save(false);
                return $user;
            }
        }
        return null;
    }
}
