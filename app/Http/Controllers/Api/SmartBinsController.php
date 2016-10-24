<?php
namespace App\Http\Controllers\Api;
use App\Http\Requests;
use App\Transformers\SmartBinTransformer;
use App\SmartBin;
use Illuminate\Http\Request;

class SmartBinsController extends ApiController
{
    protected $smartBinTransformer;
    public function __construct(SmartBinTransformer $smartBinTransformer)
    {
        $this->smartBinTransformer = $smartBinTransformer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->respondWithPaginatedCollection(SmartBin::paginate(), $this->smartBinTransformer);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $smartBin = SmartBin::find($id);

        if (!$smartBin) {
            return $this->respondNotFound('SmartBin does not exist.');
        }
        return $this->respond(fractal()->item($smartBin, $this->smartBinTransformer));
    }
}