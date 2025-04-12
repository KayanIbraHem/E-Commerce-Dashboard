<?php

namespace App\Services\Dashboard\Employee\Notification;

class NotificationSettingsService
{
    public function changeNotificationSoundStatus($employee)
    {
        $employee->update(['notification_sound' => $employee->notification_sound == 1 ? 0 : 1]);
    }
    public function changeSendNotificationsToEmailStatus($employee)
    {
        $employee->update(['send_notifications_to_email' => $employee->send_notifications_to_email == 1 ? 0 : 1]);
    }
    public function changeShowNotificationStatus($employee)
    {
        $employee->update(['show_notification' => $employee->show_notification == 1 ? 0 : 1]);
    }
}
