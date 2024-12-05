<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\export;
use App\Models\export_detail;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\ExportRepositoryInterface as ExportRepository;
use App\Repositories\Interfaces\ImportRepositoryInterface as ImportRepository;

class ExportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected $importRepository;
    protected $exportRepository;

    public function __construct(ImportRepository $importRepository, ExportRepository $exportRepository)
    {
        $this->importRepository = $importRepository;
        $this->exportRepository = $exportRepository;
    }

    public function run(): void
    {
        DB::statement('ALTER TABLE exports AUTO_INCREMENT = 1');
        export::factory()
            ->count(100)
            ->create()
            ->each(function ($export) {
                $uniqueRiceIds = collect(range(1, 14))->shuffle()->take(random_int(1, 5));
                $totalWeightToExport = 0;
                foreach ($uniqueRiceIds as $riceId) {
                    $weight = random_int(1, 1000);
                    $totalWeightToExport += $weight;

                    $totalImportWeight = $this->importRepository->getWeight($export->warehouse_id, $riceId);
                    $totalExportWeight = $this->exportRepository->getWeight($export->warehouse_id, $riceId);

                    if (($totalImportWeight - $totalExportWeight) >= $weight) {
                        export_detail::factory()->create([
                            'export_id' => $export->id,
                            'rice_id' => $riceId,
                            'weight' => $weight,
                        ]);
                    }
                }
            });
    }
}
