<?php

namespace DTApi\Repository;

interface BookingRepositoryInteface{

    public function getUsersJobs($user_id);
    public function getUsersJobsHistory($user_id);
    public function store($user, $data);
    public function storeJobEmail($data);
    public function jobToData($job);
    public function jobEnd(array $data);
    public function getPotentialJobIdsWithUserId($user_id);
    public function sendNotificationTranslator($job, array $data, $exclude_user_id);
    public function sendSMSNotificationToTranslator($job);
    public function isNeedToDelayPush($user_id);
    public function isNeedToSendPush($user_id);
    public function sendPushNotificationToSpecificUsers($users, $job_id, $data, $msg_txt, $is_need_delay);
    public function getPotentialTranslators($job);
    public function updateJob($id, $data, $curser);
    public function sendSessionStartRemindNotification($user, $job, $language, $due, $duration);
    public function sendChangedTranslatorNotification($job, $current_translator, $new_translator);
    public function sendChangedDateNotification($job, $old_time);
    public function sendChangedLangNotification($job, $old_lang);
    public function sendExpiredNotification($job, $user);
    public function sendNotificationByAdminCancelJob($job_id);
    public function acceptJob($data, $user);
    public function acceptJobWithId($job_id, $cuser);
    public function cancelJobAjax($data, $user);
    public function getPotentialJobs($cuser);
    public function endJob($post_data);
    public function customerNotCall($post_data);
    public function getAll($limit);
    public function alerts();
    public function userLoginFailed();
    public function bookingExpireNoAccepted();
    public function ignoreExpiring($id);
    public function ignoreExpired($id);
    public function ignoreThrottle($id);
    public function reopen($request);
}