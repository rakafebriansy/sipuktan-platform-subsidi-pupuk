<?php

namespace App\Charts;

use App\Models\Alokasi;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class AlokasiPupukSubsidiPerTahunChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $tahun = now()->format('Y');
        $alokasi_pupuk_per_tahun_mt1 = intval( Alokasi::where('tahun',$tahun)->where('musim_tanam','MT1')->sum('jumlah_pupuk'));
        $alokasi_pupuk_per_tahun_mt2 = intval(Alokasi::where('tahun',$tahun)->where('musim_tanam','MT2')->sum('jumlah_pupuk'));
        $alokasi_pupuk_per_tahun_mt3 = intval(Alokasi::where('tahun',$tahun)->where('musim_tanam','MT3')->sum('jumlah_pupuk'));

        return $this->chart->pieChart()
            ->setTitle('Alokasi Pupuk Subsidi Tahun '.$tahun)
            ->setSubtitle('Satuan kg')
            ->addData([$alokasi_pupuk_per_tahun_mt1, $alokasi_pupuk_per_tahun_mt2, $alokasi_pupuk_per_tahun_mt3])
            ->setLabels(['Musim Tanam 1', 'Musim Tanam 2', 'Musim Tanam 3']);
    }
}
