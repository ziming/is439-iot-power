<?php
namespace App\Http\Controllers\Api;
use App\Http\Requests;
use App\Transformers\PowerSensorLogTransformer;
use App\PowerSensorLog;
use Illuminate\Http\Request;

class PowerSensorLogsController extends ApiController
{
    protected $powerSensorLogTransformer;
    public function __construct(PowerSensorLogTransformer $powerSensorLogTransformer)
    {
        $this->powerSensorLogTransformer = $powerSensorLogTransformer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->respondWithPaginatedCollection(PowerSensorLog::orderBy('measurement_taken_datetime', 'desc')->paginate(), $this->powerSensorLogTransformer);
    }

    public function latest() {

        $powerSensorLog = PowerSensorLog::orderBy('measurement_taken_datetime', 'desc')->first();

        return $this->respond(fractal()->item($powerSensorLog, $this->powerSensorLogTransformer));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $power_sensor_id
     * @return \Illuminate\Http\Response
     */
    public function show($power_sensor_id)
    {
        $powerSensorLogsPaginator = PowerSensorLog::where('power_sensor_id', '=', $power_sensor_id)
            ->orderBy('measurement_taken_datetime', 'desc')->paginate();

        return $this->respondWithPaginatedCollection($powerSensorLogsPaginator, $this->powerSensorLogTransformer);

    }
}