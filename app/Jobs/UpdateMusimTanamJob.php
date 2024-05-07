<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class UpdateMusimTanamJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $status;
    /**
     * Create a new job instance.
     */
    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::transaction(function() {
            DB::table('alokasis')->where('status','Menunggu Pembayaran')->update([
                'status' => 'Tidak Diambil'
            ]);
        });
    }
}
