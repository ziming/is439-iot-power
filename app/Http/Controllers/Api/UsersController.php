<?php
namespace App\Http\Controllers\Api;
use App\Http\Requests;
use App\Transformers\UserTransformer;
use App\User;
use Illuminate\Http\Request;
class UsersController extends ApiController
{
    protected $userTransformer;
    public function __construct(UserTransformer $userTransformer)
    {
        $this->userTransformer = $userTransformer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Gets you the authenticated user
        auth()->user();
        return $this->respondWithPaginatedCollection(User::paginate(), $this->userTransformer);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->respondNotFound('User does not exist.');
        }
        return $this->respond(fractal()->item($user, $this->userTransformer));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}