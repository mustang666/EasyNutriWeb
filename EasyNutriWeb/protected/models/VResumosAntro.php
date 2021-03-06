<?php

/**
 * This is the model class for table "v_resumos_antro".
 *
 * The followings are the available columns in table 'v_resumos_antro':
 * @property integer $utente_id
 * @property string $medicao
 * @property double $valor
 * @property string $data
 * @property string $local
 */
class VResumosAntro extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'v_resumos_antro';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('medicao, valor', 'required'),
			array('utente_id', 'numerical', 'integerOnly'=>true),
			array('valor', 'numerical'),
			array('medicao', 'length', 'max'=>100),
			array('local', 'length', 'max'=>8),
			array('data', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('utente_id, medicao, valor, data, local', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'utente_id' => 'Utente',
			'medicao' => 'Medicao',
			'valor' => 'Valor',
			'data' => 'Data',
			'local' => 'Local',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('utente_id',$this->utente_id);
		$criteria->compare('medicao',$this->medicao,true);
		$criteria->compare('valor',$this->valor);
		$criteria->compare('data',$this->data,true);
		$criteria->compare('local',$this->local,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VResumosAntro the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
