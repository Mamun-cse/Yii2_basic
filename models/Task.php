<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $name
 * @property string $priority
 * @property string $assigned_person
 * @property string $start_time
 * @property string $end_time
 * @property string $status
 * @property string|null $file
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    /**
     * @var UploadedFile
     */
    public $upload;
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'priority', 'assigned_person', 'start_time', 'end_time', 'status'], 'required'],
            [['priority'], 'string'],
            [['start_time', 'end_time'], 'safe'],
            //['start_time','date', 'timestampAttribute' => 'start_time'],
           // ['end_time','date', 'timestampAttribute' => 'end_time'],
            [['name', 'assigned_person', 'file'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 100],
            [['upload'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png'],
        ];
    }
    /*
    public function upload(){
        if($this->validate()){
            $this->file->saveAs('uploads/' .$this->file->baseName . '.' .$this->file->extension);
        } else {
            return false;
        }
    }*/

    /**
     * {@inheritdoc}
     */

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'priority' => 'Priority',
            'assigned_person' => 'Assigned Person',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'status' => 'Status',
            'file' => 'File',
        ];
    }
}
