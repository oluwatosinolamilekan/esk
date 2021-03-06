<?php


namespace App\Services;


use App\Helper\File;
use App\Models\AdvertiseCampaign;
use Illuminate\Support\Facades\DB;

class EditCampaign
{
    public function run($data,$id)
    {
        DB::beginTransaction();
        $campaign = AdvertiseCampaign::find($id);
        if(!$campaign){
            throw new \Exception("The requested campaign doesn't exists");
        }
        $campaign->name = $data['name'];
        $campaign->date = $data['date'];
        $campaign->total_budget = $data['total_budget'];
        $campaign->daily_budget = $data['daily_budget'];
        $campaign->save = $data['save'];
        $campaign->save();
        DB::commit();
        return $campaign;
    }
}
