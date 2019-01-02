<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\DB;

class VacationRequested extends Notification
{
    use Queueable;

    private $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        
        $mail_data = [
            'user' => $this->data['last_name']." ".$this->data['first_name'],
            'vacation_start' =>$this->data['vacation_start'],
            'vacation_end' => $this->data['vacation_end'],
            'reason' => $this->data['reason'],
            'approve' => url('/application/approve/'.$this->data['application_id']),
            'reject' => url('/application/reject/'.$this->data['application_id'])
        ];
        return (new MailMessage)
                    ->line("Dear supervisor, employee {$mail_data['user']} requested for some time off, starting on
                    {$mail_data['vacation_start']} and ending on {$mail_data['vacation_end']}, stating the reason:
                    {$mail_data['reason']}'Click on one of the below links to approve or reject the application:
                    {$mail_data['approve']} - {$mail_data['reject']}")
                    /*->action('Approve', url('/application/approved'))
                    ->action('Reject',url('/application/rejected'))*/
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
