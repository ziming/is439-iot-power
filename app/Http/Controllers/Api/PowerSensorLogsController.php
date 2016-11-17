<?php
namespace App\Http\Controllers\Api;
use App\Http\Requests;
use App\PowerSensorLog;
use App\Transformers\PowerSensorLogTransformer;
use Illuminate\Support\Facades\DB;

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
//        return $this->respond(fractal()->collection(PowerSensorLog::orderBy('measurement_taken_datetime', 'desc')->get(), $this->powerSensorLogTransformer));

        return $this->respondWithPaginatedCollection(PowerSensorLog::orderBy('measurement_taken_datetime', 'desc')->paginate(60 * 24), $this->powerSensorLogTransformer);
    }

    public function indexBywH()
    {

        #date = '2016-12-31'

        $powerSensorwHLogs = DB::table('power_sensor_logs')
            ->select(DB::raw('power_sensor_id, DATE_FORMAT(measurement_taken_datetime, \'%Y-%m-%d %H:00\') as measurement_taken_date_hour, (AVG(amp_value) * 11) AS wH'))
            ->groupBy('power_sensor_id', 'measurement_taken_date_hour')
            ->orderBy('measurement_taken_date_hour', 'desc')
            ->get();

        $powerSensorwHLogs = ['data' => $powerSensorwHLogs];

        return response()->json($powerSensorwHLogs);
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

    public function showBywH($power_sensor_id)
    {

        $powerSensorwHLogs = DB::table('power_sensor_logs')
            ->select(DB::raw('power_sensor_id, DATE_FORMAT(measurement_taken_datetime, \'%Y-%m-%d %H:00\') as measurement_taken_date_hour, (AVG(amp_value) * 11) AS wH'))
            ->where('power_sensor_id', '=', $power_sensor_id)
            ->groupBy('power_sensor_id', 'measurement_taken_date_hour')
            ->orderBy('measurement_taken_date_hour', 'desc')
            ->get();


        $powerSensorwHLogs = ['data' => $powerSensorwHLogs];

        return response()->json($powerSensorwHLogs);
    }
}