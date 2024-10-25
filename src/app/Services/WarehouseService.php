<?php

namespace App\Services;

use App\Services\Interfaces\WarehouseServiceInterface;
use App\Repositories\Interfaces\WarehouseRepositoryInterface as WarehouseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 * Class WarehouseService
 * @package App\Services
 */
class WarehouseService implements WarehouseServiceInterface
{
    protected $warehouseRepository;

    public function __construct(WarehouseRepository $warehouseRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 'send', 'confirm');
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $imageName);
                $payload['image'] = 'uploads/' . $imageName;
            }
            $this->warehouseRepository->create($payload);
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
            $warehouse = $this->warehouseRepository->find($id);
            $oldImage = $warehouse->image;
            $payload = $request->except('_token', 'send', 'image');
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $request->file('image')->move(public_path('uploads'), $imageName);

                $payload['image'] = 'uploads/' . $imageName;

                $oldImagePath = public_path($oldImage);
                if (isset($oldImage) && file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            } else {
                $payload['image'] = $oldImage;
            }

            $this->warehouseRepository->update($id, $payload);
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
            $warehouse = $this->warehouseRepository->find($id);
            $image = $warehouse->image;
            if (isset($image)) {
                $imagePath = public_path($image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $this->warehouseRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }

    }
}
