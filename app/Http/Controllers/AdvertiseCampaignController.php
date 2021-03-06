<?php

namespace App\Http\Controllers;

use App\Helper\DisplayResponse;
use App\Http\Requests\StoreCampaignRequest;
use App\Http\Resources\CampaignResource;
use App\Services\CreateCampaign;
use App\Services\EditCampaign;
use App\Services\ListsCampaigns;
use App\Services\ShowCampaign;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdvertiseCampaignController extends Controller
{
    public function index()
    {
        $campaigns = (new ListsCampaigns())->run();
        return CampaignResource::collection($campaigns);
    }

    public function store(StoreCampaignRequest $request)
    {
        try {
            $campaign = (new CreateCampaign())->run($request);
            return new CampaignResource($campaign);
        }catch (Exception $exception){
            Log::error("Create Campaign error : {$exception->getMessage()}");
            return response()->json(DisplayResponse::reFailed($exception->getMessage()),500);
        }
    }

    public function show($id)
    {
        try {
            $campaign = (new ShowCampaign())->run($id);
            return new CampaignResource($campaign);
        }catch (Exception $exception){
            Log::error("Show Campaign error : {$exception->getMessage()}");
            return response()->json(DisplayResponse::reFailed($exception->getMessage()),500);
        }
    }

    public function update(Request $request,$id)
    {
        try {
            $campaigns = (new EditCampaign())->run($request,$id);
            return new CampaignResource($campaigns);
        }catch (Exception $exception){
            Log::error("Update Campaign error : {$exception->getMessage()}");
            return response()->json(DisplayResponse::reFailed($exception->getMessage()),500);
        }
    }

}
