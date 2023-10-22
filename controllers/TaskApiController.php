<?php

namespace app\controllers;
use yii;

use app\models\Task;
use yii\web\UploadedFile;
use yii\rest\ActiveController;
use GuzzleHttp\Client;
class TaskApiController extends yii\web\Controller
{
    public $enableCsrfValidation = false;
    public $modelClass = 'app\models\Task';


    // Get List of task
    public function actionIndex()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return Task::find()->all();
    }


    // Get Details of a Tasks
    public function actionView($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $task = Task::findOne($id);

        if ($task === null) {

            return $this->error('Task not found.', 404);
        }
        return $task;
    }

    //Create A Task including Uploading file from API
    public function actionCreate()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $requestBody = $this->request->getBodyParams();


        try {
            $task = new Task();
            $task->load(['Task'=>$requestBody]);
            if (!$task->validate()) {
                return $this->error($task->errors, 400);
            }
            $file = UploadedFile::getInstanceByName('file');
            //print_r($file);exit();
            if($file){
                $filePath = 'uploads/' . $file->baseName . '.' . $file->extension;
                if (!$file->saveAs($filePath)) {
                    return $this->error('Failed to save file.', 500);
                }
                $task->file = $filePath;
            }



        }catch (Exception $e){
            echo 'Message: fg' .$e->getMessage();
        }
        $task->save();

        return $task;

    }

    // Only Update a Task Status
    public function actionUpdateStatus($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $task = Task::findOne($id);

        if ($task === null) {
            return $this->error('Task not found.', 404);
        }
        $requestBody = $this->request->getBodyParams();

        $task->status = $requestBody['status'];

        if (!$task->validate()) {
            return $this->error($task->errors, 400);
        }
        $task->save();

        return $task;
    }

    //Update a Task information but can not update Status and assigned Person in this task.
    public function actionUpdateInformation($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $task = Task::findOne($id);
        if ($task === null) {
            return $this->error('Task not found.', 404);
        }
        $requestBody = $this->request->getBodyParams();

        $task->name = $requestBody['name'];
        $task->priority = $requestBody['priority'];
        $task->start_time = $requestBody['start_time'];
        $task->end_time = $requestBody['end_time'];

        if (!$task->validate()) {
            return $this->error($task->errors, 400);
        }
        $task->save();

        return $task;
    }

    public function error($message, $code = 400)
    {
        return $this->asJson([
            'error' => [
                'message' => $message,
                'code' => $code,
            ],
        ], $code);
    }


}