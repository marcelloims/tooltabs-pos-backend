<?php

namespace App\Http\Controllers\UserMaster;

use App\Http\Controllers\Controller;
use App\Services\UserMaster\UserMasterService;
use Illuminate\Http\Request;

class UserMasterController extends Controller
{
    protected $userMasterService;

    public function __construct(UserMasterService $_userMasterService)
    {
        $this->userMasterService = $_userMasterService;
    }

    public function getAll()
    {
        $response   = $this->userMasterService->getAll();

        return response()->json($response, $response['code']);
    }

    public function fetch(Request $request)
    {
        $response   = $this->userMasterService->fetch($request);

        return response()->json($response, $response['code']);
    }

    public function store(Request $request)
    {
        $response   = $this->userMasterService->save($request);

        return response()->json($response, $response['code']);
    }

    public function edit($id)
    {
        $response   = $this->userMasterService->getData($id);

        return response()->json($response, $response['code']);
    }

    public function update(Request $request)
    {
        $response = $this->userMasterService->update($request);

        return response()->json($response, $response['code']);
    }

    public function detail($id)
    {
        $response = $this->userMasterService->getData($id);

        return response()->json($response, $response['code']);
    }

    public function destroy($id)
    {
        $response   = $this->userMasterService->destory($id);

        return response()->json($response, $response['code']);
    }
}
