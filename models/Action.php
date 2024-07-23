<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "action".
 *
 * @property int $id
 * @property int|null $medicine_id
 * @property int|null $patient_id
 * @property bool|null $completed
 *
 * @property Medicine $medicine
 * @property Patient $patient
 */
class Action extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'action';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['medicine_id', 'patient_id'], 'default', 'value' => null],
            [['medicine_id', 'patient_id'], 'integer'],
            [['completed'], 'boolean'],
            [['medicine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medicine::class, 'targetAttribute' => ['medicine_id' => 'id']],
            [['patient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Patient::class, 'targetAttribute' => ['patient_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'medicine_id' => 'Medicine ID',
            'patient_id' => 'Patient ID',
            'completed' => 'Completed',
        ];
    }

    /**
     * Gets query for [[Medicine]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicine()
    {
        return $this->hasOne(Medicine::class, ['id' => 'medicine_id']);
    }

    /**
     * Gets query for [[Patient]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(Patient::class, ['id' => 'patient_id']);
    }
}
