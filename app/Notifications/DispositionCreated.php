<?php

namespace App\Notifications;

use App\Models\Disposition;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DispositionCreated extends Notification
{
    use Queueable;

    public Disposition $disposition;

    public function __construct(Disposition $disposition)
    {
        $this->disposition = $disposition;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'disposition_id' => $this->disposition->id,
            'letter_id' => $this->disposition->letter_id,
            'reference_number' => $this->disposition->letter->reference_number,
            'content' => $this->disposition->content,
            'to' => $this->disposition->to,
            'created_by' => $this->disposition->user->name,
        ];
    }
}
