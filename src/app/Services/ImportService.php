<?php

namespace App\Services;

use App\Services\Interfaces\ImportServiceInterface;
use App\Repositories\Interfaces\ImportRepositoryInterface as ImportRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ImportService implements ImportServiceInterface
{
    protected $importRepository;

    public function __construct(ImportRepository $importRepository)
    {
        $this->importRepository = $importRepository;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send');
            $import = $this->importRepository->create(
                [
                    'user_id' => Auth::id(),
                    'customer_id' => $payload['customer_id'],
                    'warehouse_id' => $payload['warehouse_id'],
                    'note' => $payload['note'],
                ]
            );

            foreach ($payload['inputs'] as $item) {
                $import->import_detail()->create($item);
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
            $import = $this->importRepository->find($id);

            $import->update(
                [
                    'customer_id' => $payload['customer_id'],
                    'warehouse_id' => $payload['warehouse_id'],
                    'note' => $payload['note'],
                ]
            );

            foreach ($payload['inputs'] as $item) {
                $detail = $import->import_detail()
                    ->where('import_id', $import->id)
                    ->where('rice_id', $item['rice_id'])
                    ->first();
                if ($detail) {
                    $detail->update($item);
                } else {
                    $import->import_detail()->create($item);
                }
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Update failed: ' . $e->getMessage());
            return false;
        }
    }

    // public function delete($id)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $this->riceRepository->delete($id);
    //         DB::commit();
    //         return true;
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return false;
    //     }
    // }
}