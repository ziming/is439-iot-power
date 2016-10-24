<?php
namespace App\Http\Controllers\Api;
use App\Http\Requests;
use App\Transformers\PowerSensorTransformer;
use App\PowerSensor;
use Illuminate\Http\Request;

class PowerSensorsController extends ApiController
{
    protected $powerSensorTransformer;
    public function __construct(PowerSensorTransformer $powerSensorTransformer)
    {
        $this->powerSensorTransformer = $powerSensorTransformer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->respondWithPaginatedCollection(PowerSensor::paginate(), $this->powerSensorTransformer);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $powerSensor = PowerSensor::find($id);
        if (!$powerSensor) {
            return $this->respondNotFound('PowerSensor does not exist.');
        }
        return $this->respond(fractal()->item($powerSensor, $this->powerSensorTransformer));
    }
}