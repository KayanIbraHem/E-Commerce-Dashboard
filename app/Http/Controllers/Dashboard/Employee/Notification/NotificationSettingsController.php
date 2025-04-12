<?php

namespace App\Http\Controllers\Dashboard\Employee\Notification;

use Illuminate\Http\Request;
use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\Employee\Notification\NotificationSettingsService;

class NotificationSettingsController extends Controller
{
    use ApiResponse;
    public function __construct(private NotificationSettingsService $notificationSettingsService) {}
    public function changeNotificationSoundStatus()
    {
        try {
            $employee = auth('employee')->user();
            $this->notificationSettingsService->changeNotificationSoundStatus($employee);
            return $this->successResponse('changeNotificationSound',  200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function changeSendNotificationsToEmailStatus()
    {
        try {
            $employee = auth('employee')->user();
            $this->notificationSettingsService->changeSendNotificationsToEmailStatus($employee);
            return $this->successResponse('changeSendNotificationsToEmail',  200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function changeShowNotificationStatus()
    {
        try {
            $employee = auth('employee')->user();
            $this->notificationSettingsService->changeShowNotificationStatus($employee);
            return $this->successResponse('changeSendNotificationsToEmail',  200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
