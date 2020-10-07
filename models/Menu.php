<?php
namespace app\models;
use Yii;
class Menu extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'ms_menu';
    }
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent','order'], 'default', 'value' => null],
            [['parent', 'order'], 'integer'],
            [['data'], 'string'],
            [['name'], 'string', 'max' => 128],
            [['route', 'icon'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'parent' => 'Parent',
            'route' => 'Route',
            'order' => 'Order',
            'data' => 'Data',
            'icon' => 'Icon',
        ];
    }
    public static function getMenu($cnd=NULL)
           {
               $data2 = [];
               $helper=new \mdm\admin\components\Helper;
               foreach(Menu::find()->where(['parent' => $cnd])->orderby('order')->all() as $haha)
               {
                   $row=[];
                   $row['id']     = $haha->id;
                   $row['label']  = $haha->name;
                   $row['icon']  = $haha->icon;
                   $row['url']    = [$haha->route];
                   $row['visible']    = $helper->checkRoute($haha->route);
                   if(count(Menu::getMenu2($haha->id))>0)
                   {
                      $row['items'] = Menu::getMenu2($haha->id);
                   }
                   $data2[] =$row;
               }
               return $data2;
           }
           public static function getMenu2($cnd=NULL)
           {
               $data2 = [];
               $helper=new \mdm\admin\components\Helper;
              foreach(Menu::find()->where(['parent' => $cnd ])->orderby('order')->all() as $haha)
               {
                    $row=[];
                    $row['id'] = $haha->id;
                    $row['label']  = $haha->name;
                    $row['icon']  = $haha->icon;
                    $row['url']    = [$haha->route];
                    $row['visible']    = $helper->checkRoute($haha->route);
                    if(count(Menu::getMenu2($haha->id))>0)
                          $row['items'] = Menu::getMenu2($haha->id);
                    $data2[] =$row;
                }
                return $data2;
           }
}
