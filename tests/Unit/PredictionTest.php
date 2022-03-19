<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\PredictionRepository;
use App\Models\Prediction;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class PredictionTest extends TestCase
{
    protected $prediction;




     /**
     * A create prediction  feature test .
     *
     * @return void
     */
    public function testcreatePrediction()
    {
        $this->prediction = [
            'patient_id' => 5,
            'sonographer_id' =>6,
            'doctor_id' => 1,
            'status'=>0,
            'model_id' => 1
        ];
        // khởi tạo lớp CategoryRepository
        $this->predictionRepository = new PredictionRepository();
        $prediction = $this->predictionRepository->storePrediction($this->prediction);
        $this->assertInstanceOf(Prediction::class, $prediction);
        $this->assertEquals($this->prediction['patient_id'], $prediction->patient_id);
        $this->assertEquals($this->prediction['sonographer_id'], $prediction->sonographer_id);
        $this->assertEquals($this->prediction['doctor_id'], $prediction->doctor_id);
        $this->assertEquals($this->prediction['status'], $prediction->status);
        $this->assertEquals($this->prediction['model_id'], $prediction->model_id);
        $this->assertDatabaseHas('predictions', $this->prediction);

    }
}
