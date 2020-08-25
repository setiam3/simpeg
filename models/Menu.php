<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ms_menu".
 *
 * @property int $id
 * @property string $name
 * @property int $parent
 * @property string $route
 * @property int $order
 * @property resource $data
 * @property string $icon
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ms_menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent', 'order'], 'integer'],
            [['data'], 'string'],
            [['name'], 'string', 'max' => 128],
            [['route', 'icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
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
    public static function getMenu($cnd=0)
    {
        $data2 = array();
        //$helper=new \mdm\admin\components\Helper;
        foreach(Menu::find()->where(['parent' => $cnd])->orderby('order')->all() as $haha)
        {
            $row=array();
            $row['id']      = $haha->id;
            $row['label']   = $haha->name;
            $row['icon']   = $haha->icon;
            $row['url']     = [$haha->route];
            //$row['visible']     = $helper->checkRoute($haha->route);
            if(count(Menu::getMenu2($haha->id))>0)
            {
               $row['items'] = Menu::getMenu2($haha->id);
            }
            $data2[] =$row;
        }
        return $data2;
    }
    
    public static function getMenu2($cnd=0)
    {
        $data2 = array();
        //$helper=new \mdm\admin\components\Helper;
       foreach(Menu::find()->where(['parent' => $cnd ])->orderby('order')->all() as $haha)
        {
             $row=array();
             $row['id'] = $haha->id;
             $row['label']   = $haha->name;
             $row['icon']   = $haha->icon;
             $row['url']     = [$haha->route];
             //$row['visible']     = $helper->checkRoute($haha->route);
             if(count(Menu::getMenu2($haha->id))>0)
                   $row['items'] = Menu::getMenu2($haha->id);
             $data2[] =$row;
         }
         return $data2;
    }
}
