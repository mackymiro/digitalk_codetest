<?php
namespace DTApi\Helpers;

use Carbon\Carbon;
use DTApi\Models\Job;
use DTApi\Models\User;
use DTApi\Models\Language;
use DTApi\Models\UserMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TeHelper
{
    public static function fetchLanguageFromJobId($id)
    {
        $language = Language::findOrFail($id);
        return $language1 = $language->language;
    }

    public static function getUsermeta($user_id, $key = false)
    {
        return $user = UserMeta::where('user_id', $user_id)->first()->$key;
        if (!$key)
            return $user->usermeta()->get()->all();
        else {
            $meta = $user->usermeta()->where('key', '=', $key)->get()->first();
            if ($meta)
                return $meta->value;
            else return '';
        }
    }

    public static function convertJobIdsInObjs($jobs_ids)
    {

        $jobs = array();
        foreach ($jobs_ids as $job_obj) {
            $jobs[] = Job::findOrFail($job_obj->id);
        }
        return $jobs;
    }

    public static function willExpireAt($due_time, $created_at)
    {
        $dueTime  = Carbon::parse($due_time);
        $created_at = Carbon::parse($created_at);

        $differenceInHours = $dueTime ->diffInHours($created_at);

        if($differenceInHours <= 1.5) //90 minutues
            $expiryTime = $dueTime ;
        elseif ($differenceInHours <= 24) {
            $expiryTime = $created_at->addMinutes(90);
        } elseif ($differenceInHours <= 72) {
            $expiryTime = $created_at->addHours(16);
        } else {
            $expiryTime = $due_time->subHours(48);
        }

        return $expiryTime->format('Y-m-d H:i:s');

    }

}

