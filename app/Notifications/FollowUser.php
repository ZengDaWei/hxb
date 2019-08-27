<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class FollowUser extends Notification
{
    use Queueable;

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'user_id'     => $this->user->id,
            'user_name'   => $this->user->name,
            'user_avatar' => $this->user->avatar,
        ];
    }
}
