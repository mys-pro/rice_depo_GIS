<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\WarehouseServiceInterface as WarehouseService;
use App\Repositories\Interfaces\WarehouseRepositoryInterface as WarehouseRepository;
use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    protected $warehouseService;
    protected $warehouseRepository;
    protected $subtitle;
    protected $page;

    public function __construct(WarehouseService $warehouseService, WarehouseRepository $warehouseRepository)
    {
        $this->warehouseService = $warehouseService;
        $this->warehouseRepository = $warehouseRepository;
        $this->subtitle = [
            [
                'url' => route('warehouse.index'),
                'title' => 'Quản lý kho lúa',
            ]
        ];
        $this->page = 'warehouse';
    }

    public function index(Request $request)
    {
        $get = $request->input();
        $page = $this->page;
        $title = 'Quản lý kho lúa';
        $template = 'backend.warehouse.index';
        $warehouses = $this->warehouseRepository->getPaginateByName($get['search'] ?? '');
        return view('backend.dashboard.layout', compact(
            'page',
            'title',
            'template',
            'warehouses',
        ));
    }

    public function create()
    {
        $page = $this->page;
        $title = 'Thêm kho lúa';
        $subtitle = $this->subtitle;
        $action = "Thêm kho";
        $form = route('warehouse.store');
        $template = "backend.warehouse.form";
        $config = [
            'css' => [
                'backend/vendor/mapbox-gl/css/mapbox-gl.min.css',
            ],

            'js' => [
                'backend/vendor/mapbox-gl/js/mapbox-gl.min.js',
            ],
        ];

        return view('backend.dashboard.layout', compact(
            'page',
            'title',
            'subtitle',
            'template',
            'action',
            'form',
            'config',
        ));
    }

    public function store(StoreWarehouseRequest $request)
    {
        if ($this->warehouseService->create($request)) {
            flash()->success('Thêm mới bản ghi thành công.');
            return redirect()->route('warehouse.index');
        }
        flash()->error('Thêm mới bản ghi không thành công.');
        return redirect()->route('warehouse.index');
    }

    public function edit($id)
    {
        $title = "Cập nhật kho";
        $subtitle = $this->subtitle;
        $page = $this->page;
        $action = "Cập nhật";
        $form = route('warehouse.update', $id);
        $template = 'backend.warehouse.form';
        $warehouse = $this->warehouseRepository->find($id);
        $config = [
            'css' => [
                'backend/vendor/mapbox-gl/css/mapbox-gl.min.css',
            ],

            'js' => [
                'backend/vendor/mapbox-gl/js/mapbox-gl.min.js',
            ],
        ];
        return view('backend.dashboard.layout', compact(
            'page',
            'title',
            'subtitle',
            'action',
            'form',
            'template',
            'warehouse',
            'config'
        ));
    }

    public function update($id, UpdateWarehouseRequest $request)
    {
        if ($this->warehouseService->update($id, $request)) {
            flash()->success('Cập nhật bản ghi thành công.');
            return redirect()->route('warehouse.index');
        }
        flash()->error('Cập nhật bản ghi không thành công.');
        return redirect()->route('warehouse.index');
    }

    public function delete($id)
    {
        if ($this->warehouseService->delete($id)) {
            flash()->success('Xóa bản ghi thành công.');
            return redirect()->route('warehouse.index');
        }
        flash()->error('Xóa bản ghi không thành công.');
        return redirect()->route('warehouse.index');
    }
}
