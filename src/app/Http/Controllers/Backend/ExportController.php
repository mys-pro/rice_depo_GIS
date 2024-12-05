<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreExportRequest;
use App\Http\Requests\UpdateExportRequest;
use App\Repositories\Interfaces\WarehouseRepositoryInterface as WarehouseRepository;
use App\Repositories\Interfaces\CustomerRepositoryInterface as CustomerRepository;
use App\Repositories\Interfaces\RiceRepositoryInterface as RiceRepository;
use App\Repositories\Interfaces\ExportRepositoryInterface as ExportRepository;
use App\Services\Interfaces\ExportServiceInterface as ExportService;

class ExportController extends Controller
{
    protected $warehouseRepository;
    protected $customerRepository;
    protected $riceRepository;
    protected $exportRepository;
    protected $exportService;
    protected $page;
    protected $subtitle;

    public function __construct(
        WarehouseRepository $warehouseRepository,
        CustomerRepository $customerRepository,
        RiceRepository $riceRepository,
        ExportRepository $exportRepository,
        ExportService $exportService,
    ) {
        $this->warehouseRepository = $warehouseRepository;
        $this->customerRepository = $customerRepository;
        $this->riceRepository = $riceRepository;
        $this->exportRepository = $exportRepository;
        $this->exportService = $exportService;
        $this->page = 'export';
        $this->subtitle = [
            [
                'url' => route('export.index'),
                'title' => 'Quản lý xuất kho',
            ]
        ];
    }

    public function index(Request $request)
    {
        $get = $request->input();
        $page = $this->page;
        $title = 'Quản lý xuất kho';
        $template = 'backend.export.index';
        $exports = $this->exportRepository->getByName($get['search'] ?? '');
        return view('backend.dashboard.layout', compact(
            'page',
            'title',
            'template',
            'exports',
        ));
    }

    public function create()
    {
        $page = $this->page;
        $title = 'Thêm mới xuất kho';
        $subtitle = $this->subtitle;
        $action = 'Xác nhận';
        $form = route('export.store');
        $template = 'backend.export.form';
        $config = $this->config();

        $warehouses = $this->warehouseRepository->all();
        $customers = $this->customerRepository->all();
        $rice = $this->riceRepository->all();
        return view('backend.dashboard.layout', compact(
            'page',
            'title',
            'subtitle',
            'action',
            'form',
            'template',
            'config',
            'warehouses',
            'customers',
            'rice',
        ));
    }

    public function store(StoreExportRequest $request)
    {
        if ($this->exportService->create($request)) {
            flash()->success('Thêm mới bản ghi thành công.');
            return redirect()->route('export.index');
        } else {
            flash()->error('Thêm mới bản ghi thất bại.');
            return redirect()->route('export.index');
        }
    }

    public function edit($id)
    {
        $page = $this->page;
        $title = 'Chỉnh sửa xuất kho';
        $subtitle = $this->subtitle;
        $action = 'Lưu';
        $form = route('export.update', $id);
        $template = 'backend.export.form';
        $config = $this->config();

        $warehouses = $this->warehouseRepository->all();
        $customers = $this->customerRepository->all();
        $rice = $this->riceRepository->all();
        $export = $this->exportRepository->findById($id, ['*'], ['export_detail']);
        $total = 0;
        foreach ($export->export_detail as $item) {
            $total += ($item->weight * $item->price);
        }
        $total = number_format($total, 0, '', '.');
        return view('backend.dashboard.layout', compact(
            'page',
            'title',
            'subtitle',
            'action',
            'form',
            'export',
            'template',
            'config',
            'warehouses',
            'customers',
            'rice',
            'total',
        ));
    }

    public function update($id, UpdateExportRequest $request)
    {
        if ($this->exportService->update($id, $request)) {
            flash()->success('Cập nhật bản ghi thành công.');
            return redirect()->route('export.index');
        } else {
            flash()->error('Cập nhật bản ghi thất bại.');
            return redirect()->route('export.index');
        }
    }

    public function delete($id)
    {
        if ($this->exportService->delete($id)) {
            flash()->success('Xóa bản ghi thành công.');
            return redirect()->route('export.index');
        } else {
            flash()->error('Xóa bản ghi thất bại.');
            return redirect()->route('export.index');
        }
    }

    public function config()
    {
        return [
            'js' => [
                'backend/library/multiRow.js',
            ]
        ];
    }
}
