<?php

namespace App\Services;

use App\Services\Interfaces\ExportServiceInterface;
use App\Repositories\Interfaces\ExportRepositoryInterface as ExportRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ExportService implements ExportServiceInterface
{
    protected $exportRepository;

    public function __construct(ExportRepository $exportRepository)
    {
        $this->exportRepository = $exportRepository;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send');
            $export = $this->exportRepository->create(
                [
                    'user_id' => Auth::id(),
                    'customer_id' => $payload['customer_id'],
                    'warehouse_id' => $payload['warehouse_id'],
                    'note' => $payload['note'],
                ]
            );

            foreach ($payload['inputs'] as $item) {
                $export->export_detail()->create($item);
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Import creation failed: ' . $e->getMessage());
            return false;
        }
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send');
            $export = $this->exportRepository->find($id);

            $export->update(
                [
                    'customer_id' => $payload['customer_id'],
                    'warehouse_id' => $payload['warehouse_id'],
                    'note' => $payload['note'],
                ]
            );

            $currentRiceIds = $export->export_detail()->pluck('rice_id')->toArray();

            foreach ($payload['inputs'] as $item) {
                if (in_array($item['rice_id'], $currentRiceIds)) {
                    $detail = $export->export_detail()
                        ->where('export_id', $export->id)
                        ->where('rice_id', $item['rice_id'])
                        ->first();
                    if ($detail) {
                        $detail->update($item);
                        $currentRiceIds = array_diff($currentRiceIds, [$item['rice_id']]);
                    }
                } else {
                    $export->export_detail()->create($item);
                }
            }

            if (!empty($currentRiceIds)) {
                $export->export_detail()->whereIn('rice_id', $currentRiceIds)->delete();
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Update failed: ' . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $export = $this->exportRepository->find($id);
            $export->export_detail()->delete();
            $export->delete(); 
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}