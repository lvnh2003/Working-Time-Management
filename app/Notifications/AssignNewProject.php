<?php

namespace App\Notifications;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AssignNewProject extends Notification
{
    use Queueable;
    public $project;
    public $idProject;

    /**
     * Create a new notification instance.
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
        $this->idProject = $project->id;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
    
        
        return ['database'];
    }
 /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        
        return[
            
            'project'=>$this->project ,
            'idProject' => $this->idProject
        ];
    }
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'project' => $this->project,
            'idProject' => $this->idProject,
        ]);
    }

    public function toArray($notifiable)
    {
        return [
            'project' => $this->project,
            'idProject' => $this->idProject,
        ];
    }
}

