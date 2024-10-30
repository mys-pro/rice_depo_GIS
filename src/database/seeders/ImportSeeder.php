<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\import;
use App\Models\import_detail;
use Illuminate\Support\Facades\DB;

class ImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('ALTER TABLE imports AUTO_INCREMENT = 1');
        import::factory()
            ->count(100)
            ->create()
            ->each(function ($import) {
                $uniqueRiceIds = collect(range(1, 14))->shuffle()->take(random_int(1, 5));
                foreach ($uniqueRiceIds as $riceId) {
                    import_detail::factory()->create([
                        'import_id' => $import->id,
                        'rice_id' => $riceId,
                    ]);
                }
            });
    }
}
