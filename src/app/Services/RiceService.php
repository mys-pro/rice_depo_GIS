<?php

namespace App\Services;

use App\Services\Interfaces\RiceServiceInterface;
use App\Repositories\Interfaces\RiceRepositoryInterface as RiceRepository;
use Illuminate\Support\Facades\DB;
class RiceService implements RiceServiceInterface
{
    protected $riceRepository;

    public function __construct(RiceRepository $riceRepository)
    {
        $this->riceRepository = $riceRepository;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send');
            $this->riceRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send');
            $this->riceRepository->update($id, $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $this->riceRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}