<?php

namespace App\Observers;

use App\Models\Survey;
use App\Models\Dashboard;
use Illuminate\Support\Str;

class SurveyObserver
{
    /**
     * Handle the Survey "created" event.
     *
     * @param  \App\Models\Survey  $survey
     * @return void
     */
    public function created(Survey $survey)
    {
        $dashboard = Dashboard::where('status', $survey->status)
                    ->where('type', Str::snake(class_basename($survey)))
                    ->whereDate('created_at',$survey->created_at)
                    ->first();
        if($dashboard && $dashboard->count >= 0){
            $dashboard->update([
                'count' => $dashboard->count+1,
            ]);
        }else{
            Dashboard::create([
                'count' => 1,
                'status' => $survey->status,
                'type' => Str::snake(class_basename($survey)),
                'date' => $survey->created_at
            ]);
        }
    }

    /**
     * Handle the Survey "updated" event.
     *
     * @param  \App\Models\Survey  $survey
     * @return void
     */
    public function updated(Survey $survey)
    {
        if($survey->wasChanged('status')){
            $oldStatus = $survey->getOriginal('status');
            $newStatus = $survey->status;
            $deCount = Dashboard::where('status', $oldStatus)
                    ->where('type', Str::snake(class_basename($survey)))
                    ->whereDate('date',$survey->created_at)->first();
            $deCount->update([
                'count' => $deCount->count-1,
            ]);
            
            $inCount = Dashboard::where('status', $newStatus)
                    ->where('type', Str::snake(class_basename($survey)))
                    ->whereDate('date',$survey->created_at)->first();
            if($inCount && $inCount->count >= 0){
                $inCount->update([
                    'count' => $inCount->count+1,
                ]);
            }else{
                Dashboard::create([
                    'count' => 1,
                    'status' => $survey->status,
                    'type' => Str::snake(class_basename($survey)),
                    'date' => $survey->created_at
                ]);
            }
        }
    }

    /**
     * Handle the Survey "deleted" event.
     *
     * @param  \App\Models\Survey  $survey
     * @return void
     */
    public function deleted(Survey $survey)
    {
        // dd("Deleted Successfully");
    }

    /**
     * Handle the Survey "restored" event.
     *
     * @param  \App\Models\Survey  $survey
     * @return void
     */
    public function restored(Survey $survey)
    {
        //
    }

    /**
     * Handle the Survey "force deleted" event.
     *
     * @param  \App\Models\Survey  $survey
     * @return void
     */
    public function forceDeleted(Survey $survey)
    {
        //
    }
}
