<?php

namespace App\Jobs;

use App\Models\Starship;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateStarshipJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $inputs)
    {
        $this->data = $inputs;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Starship::create([
            'name' => $this->inputs['name'],
            'class' => $this->inputs['class'],
            'crew' => $this->inputs['crew'],
            'value' => $this->inputs['value'],
            'status' => $this->inputs['status'],
        ])
    }
}
