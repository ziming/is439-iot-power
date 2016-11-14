<?php
namespace App\Http\Controllers\Api;
use App\Http\Requests;
use App\PowerSensorLog;
use App\Transformers\PowerSensorLogTransformer;

class PowerSensorLogsController extends ApiController
{
    protected $powerSensorLogTransformer;
    public function __construct(PowerSensorLogTransformer $powerSensorLogTransformer)
    {
        $this->powerSensorLogTransformer = $powerSensorLogTransformer;
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->respond(fractal()->collection(PowerSensorLog::orderBy('measurement_taken_datetime', 'desc')->get(), $this->powerSensorLogTransformer));

        //return $this->respondWithPaginatedCollection(PowerSensorLog::orderBy('measurement_taken_datetime', 'desc')->paginate(), $this->powerSensorLogTransformer);
    }

    public function indexByKwH()
    {

        #date = '2016-12-31'

        $powerSensorKwHLogs = \DB::select('SELECT power_sensor_id, DATE(measurement_taken_datetime) AS measurement_taken_date, HOUR(measurement_taken_datetime) AS measurement_taken_hour, (AVG(amp_value) * 11 / 1000) AS KwH FROM power_sensor_logs GROUP BY power_sensor_id, measurement_taken_date, measurement_taken_hour ORDER BY measurement_taken_date, measurement_taken_hour DESC;');
        $powerSensorKwHLogs = collect($powerSensorKwHLogs);
        return response()->json($powerSensorKwHLogs);
        //return $this->respond(fractal()->collection($powerSensorKwHLogs), $this->powerSensorLogTransformer);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function latest() {

        $powerSensorLog = PowerSensorLog::orderBy('measurement_taken_datetime', 'desc')->first();

        return $this->respond(fractal()->item($powerSensorLog, $this->powerSensorLogTransformer));
    }

    /**
     * @param $power_sensor_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($power_sensor_id)
    {

        $powerSensorLogs = PowerSensorLog::where('power_sensor_id', '=', $power_sensor_id);

        return $this->respond(fractal()->collection($powerSensorLogs->orderBy('measurement_taken_datetime', 'desc')->get(), $this->powerSensorLogTransformer));


//        $powerSensorLogsPaginator = $powerSensorLogs->orderBy('measurement_taken_datetime', 'desc')->paginate();

//        return $this->respondWithPaginatedCollection($powerSensorLogsPaginator, $this->powerSensorLogTransformer);

    }
}