<?php
namespace App\Listeners;

use App\Events\FileAssigneeCreated;
use App\Models\Assignee;
use App\Models\FileAssignee;

class CreateAssignee {

    public function __construct() {}

    public function handle(FileAssigneeCreated $event): void
    {
        try {
            
            $assignee = null;
            
            if($event->data){
                
            //   $assignee = Assignee::where(['email'=> $event->data['email']])->first()->id;
               $assignee = Assignee::firstOrCreate(
                    ['email' => $event->data['email']],
                    [
                        'name' => $event->data['name'],
                        'company_info' =>  $event->data['company_info']
                    ]
                );
            }

            if($event->data && $event->fileId)
            {
                FileAssignee::create([
                    'assignee_id' => $assignee->id,
                    'file_id' =>  $event->fileId,
                ]);
            } 
            info("event", ['assignee'=> $assignee]);

        } catch (\Exception $e){
            info("issue with CreateAssignee Listener", ['error' => $e->getMessage()]);
        }
    }
}