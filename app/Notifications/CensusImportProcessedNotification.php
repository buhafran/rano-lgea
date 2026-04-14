<?php

namespace App\Notifications;

use App\Models\AnnualCensusImport;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CensusImportProcessedNotification extends Notification
{
    use Queueable;

    public function __construct(public AnnualCensusImport $import) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Census Import Processed')
            ->line('The census import "' . $this->import->title . '" has been processed.')
            ->line('Import type: ' . ($this->import->import_type ?? 'N/A'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'annual_census_import_id' => $this->import->id,
            'title' => $this->import->title,
            'import_type' => $this->import->import_type,
            'message' => 'Census import processed successfully.',
        ];
    }
}