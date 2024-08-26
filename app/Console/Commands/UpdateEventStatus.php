<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Console\Command;

class UpdateEventStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:update-status';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status of events based on end_date';



    public function handle()
    {
        $this->info('Updating event statuses...');

        // 获取已经过期的事件
        $expiredEvents = Event::where('end_date', '<=', now())->get();

        // 更新这些事件的状态
        foreach ($expiredEvents as $event) {
            $event->update(['status' => 'expired']);
        }

        $this->info('Event statuses updated successfully.');

    }
}
