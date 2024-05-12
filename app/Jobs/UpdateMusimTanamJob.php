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
    private $musim_tanam_1 = ['01','02','03','04'];
    private $musim_tanam_2 = ['05','06','07','08'];
    private $musim_tanam_3 = ['09','10','11','12'];
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
        $current_month = now()->format('m');
        $current_year = now()->format('y');
        if(in_array($current_month, $this->musim_tanam_1)) {
            $current_month = 'MT1';
        } else if(in_array($current_month, $this->musim_tanam_2)) {
            $current_month = 'MT2';
        } else if(in_array($current_month, $this->musim_tanam_3)) {
            $current_month = 'MT3';
        }
        DB::transaction(function() use($current_month, $current_year) {
            $saat_ini = DB::table('musim_tanams')->first();
            $saat_ini->update([
                'musim_tanam' => $current_month,
                'tahun' => $current_year
            ]);
            DB::table('alokasis')->where('status','Menunggu Pembayaran')->update([
                'status' => 'Tidak Diambil'
            ]);
        });
    }
}
