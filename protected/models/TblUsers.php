<?php

/**
 * This is the model class for table "tbl_users".
 *
 * The followings are the available columns in table 'tbl_users':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $activkey
 * @property integer $createtime
 * @property integer $lastvisit
 * @property integer $superuser
 * @property integer $status
 * @property integer $Location_ID
 * @property integer $Designation_ID
 * @property integer $Role_ID
 *
 * The followings are the available model relations:
 * @property MaLocation $location
 * @property MaDesignation $designation
 * @property MaRole $role
 */
class TblUsers extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return TblUsers the static model class
     */
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, password, email, Location_ID, Designation_ID, Role_ID', 'required'),
            array('createtime, lastvisit, superuser, status, Location_ID, Designation_ID, Role_ID', 'numerical', 'integerOnly'=>true),
            array('username', 'length', 'max'=>20),
            array('password, email, activkey', 'length', 'max'=>128),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, username, password, email, activkey, createtime, lastvisit, superuser, status, Location_ID, Designation_ID, Role_ID', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'location' => array(self::BELONGS_TO, 'MaLocation', 'Location_ID'),
            'designation' => array(self::BELONGS_TO, 'MaDesignation', 'Designation_ID'),
            'role' => array(self::BELONGS_TO, 'Role', 'Role_ID'),
            'branch' => array(self::BELONGS_TO, 'MaBranch', 'Branch_Id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'activkey' => 'Activkey',
            'createtime' => 'Createtime',
            'lastvisit' => 'Lastvisit',
            'superuser' => 'Superuser',
            'status' => 'Status',
            'Location_ID' => 'Location',
            'Designation_ID' => 'Designation',
            'Role_ID' => 'Role',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('username',$this->username,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('activkey',$this->activkey,true);
        $criteria->compare('createtime',$this->createtime);
        $criteria->compare('lastvisit',$this->lastvisit);
        $criteria->compare('superuser',$this->superuser);
        $criteria->compare('status',$this->status);
        $criteria->compare('Location_ID',$this->Location_ID);
        $criteria->compare('Designation_ID',$this->Designation_ID);
        $criteria->compare('Role_ID',$this->Role_ID);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public function getUsersForReport()
    {
        $LocId = (Yii::app()->getModule('user')->user()->Location_ID);
        $superuserstatus = (Yii::app()->getModule('user')->user()->superuser);

        if ($superuserstatus != 1)
        {
            $arr = Yii::app()->db->createCommand("select id, username from tbl_users where Location_ID=$LocId")->queryAll();
        }
        else
        {
            $arr = Yii::app()->db->createCommand("select id, username from tbl_users")->queryAll();
        }
        return $arr;
    }
}