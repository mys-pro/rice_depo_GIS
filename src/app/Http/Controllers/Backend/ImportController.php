<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImportRequest;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\CustomerRepositoryInterface as CustomerRepository;
use App\Repositories\Interfaces\RiceRepositoryInterface as RiceRepository;

class ImportController extends Controller
{
    protected $customerRepository;
    protected $riceRepository;

    public function __construct(CustomerRepository $customerRepository, RiceRepository $riceRepository) {
        $this->customerRepository = $customerRepository;
        $this->riceRepository = $riceRepository;
    }

    public function index($warehouseId) {
        $title = 'Danh sách nhập kho';
        return view('backend.import.index', compact(
            'title',
            'warehouseId'
        ));
    }

    public function create($warehouseId) {
        $title = 'Nhập kho';
        $action = 'create';
        $customers = $this->customerRepository->all();
        $rice = $this->riceRepository->all();
        return view('backend.import.modal', compact(
            'title',
            'action',
            'customers',
            'rice',
            'warehouseId',
        ));
    }

    public function store($warehouseId, StoreImportRequest $request) {

    }
}
