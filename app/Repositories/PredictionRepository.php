<?php

namespace App\Repositories;

use App\Models\Prediction;

class PredictionRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->model = app()->make('App\Models\Prediction');
    }

    // Tạo Prediction
    public function storePrediction($data) : Prediction
    {
        $prediction = $this->model->create($data);

        return $prediction;
    }

    // Update Prediction
    public function updatePrediction($data, $prediction) : bool
    {
        return $prediction->update($data);
    }

    // Show Prediction
    public function showPrediction($prediction_id) : Prediction
    {
        return $this->model->findOrFail($Prediction_id);
    }

    // Destroy Prediction
    public function destroyPrediction($prediction) : bool
    {
        return $this->model->delete();
    }
}