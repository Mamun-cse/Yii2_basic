<?php

namespace app\controllers;

use yii\web\Controller;

class FibonacciController extends Controller
{
    public function actionFibonacci($number){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if($number < 0){
            return ['error' => 'Number will not be negative'];
        }
        $result = $this->calculateFibonacciNumber($number);
        return ['result' => $result];
    }
    private function calculateFibonacciNumber($number){
        if($number <= 1){
            return $number;
        }
        $first = 0;
        $second = 1;
        for($i = 2; $i <= $number; $i++){
            $temp = $first + $second;
            $first = $second;
            $second = $temp;
        }
        return $second;
    }
}