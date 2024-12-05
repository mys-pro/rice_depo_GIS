<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImportRequest;
use App\Http\Requests\UpdateImportRequest;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\WarehouseRepositoryInterface as WarehouseRepository;
use App\Repositories\Interfaces\CustomerRepositoryInterface as CustomerRepository;
use App\Repositories\Interfaces\RiceRepositoryInterface as RiceRepository;
use App\Repositories\Interfaces\ImportRepositoryInterface as ImportRepository;
use App\Services\Interfaces\ImportServiceInterface as ImportService;
use Illuminate\Support\Carbon;

class ImportController extends Controller
{
    protected $warehouseRepository;
    protected $customerRepository;
    protected $riceRepository;
    protected $importRepository;
    protected $importService;
    protected $page;
    protected $subtitle;

    public function __construct(
        WarehouseRepository $warehouseRepository,
        CustomerRepository $customerRepository,
        RiceRepository $riceRepository,
        ImportRepository $importRepository,
        ImportService $importService
    ) {
        $this->warehouseRepository = $warehouseRepository;
        $this->customerRepository = $customerRepository;
        $this->riceRepository = $riceRepository;
        $this->importRepository = $importRepository;
        $this->importService = $importService;
        $this->page = 'import';
        $this->subtitle = [
            [
                'url' => route('import.index'),
                'title' => 'Quản lý nhập kho',
            ]
        ];
    }

    public function index(Request $request)
    {
        $get = $request->input();
        $page = $this->page;
        $title = 'Quản lý nhập kho';
        $template = 'backend.import.index';

        $imports = $this->importRepository->getByName($get['search'] ?? '');
        return view('backend.dashboard.layout', compact(
            'page',
            'title',
            'template',
            'imports',
        ));
    }

    public function create()
    {
        $page = $this->page;
        $title = 'Thêm mới nhập kho';
        $subtitle = $this->subtitle;
        $action = 'Xác nhận';
        $form = route('import.store');
        $template = 'backend.import.form';
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

    public function store(StoreImportRequest $request)
    {
        if ($this->importService->create($request)) {
            flash()->success('Thêm mới bản ghi thành công.');
            return redirect()->route('import.index');
        } else {
            flash()->error('Thêm mới bản ghi thất bại.');
            return redirect()->route('import.index');
        }
    }

    public function edit($id)
    {
        $page = $this->page;
        $title = 'Chỉnh sửa nhập kho';
        $subtitle = $this->subtitle;
        $action = 'Lưu';
        $form = route('import.update', $id);
        $template = 'backend.import.form';
        $config = $this->config();

        $warehouses = $this->warehouseRepository->all();
        $customers = $this->customerRepository->all();
        $rice = $this->riceRepository->all();
        $import = $this->importRepository->findById($id, ['*'], ['import_detail']);

        $total = 0;
        foreach($import->import_detail as $item) {
            $total += ($item->weight * $item->price);
        }
        $total = number_format($total, 0, '', '.');
        return view('backend.dashboard.layout', compact(
            'page',
            'title',
            'subtitle',
            'action',
            'form',
            'import',
            'template',
            'config',
            'warehouses',
            'customers',
            'rice',
            'total',
        ));
    }

    public function update($id, UpdateImportRequest $request)
    {
        if ($this->importService->update($id, $request)) {
            flash()->success('Cập nhật bản ghi thành công.');
            return redirect()->route('import.index');
        } else {
            flash()->error('Cập nhật bản ghi thất bại.');
            return redirect()->route('import.index');
        }
    }

    public function delete($id)
    {
        if ($this->importService->delete($id)) {
            flash()->success('Xóa bản ghi thành công.');
            return redirect()->route('import.index');
        } else {
            flash()->error('Xóa bản ghi thất bại.');
            return redirect()->route('import.index');
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
