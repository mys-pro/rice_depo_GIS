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
    protected $page;
    protected $subtitle;

    public function __construct(CustomerRepository $customerRepository, RiceRepository $riceRepository) {
        $this->customerRepository = $customerRepository;
        $this->riceRepository = $riceRepository;
        $this->page = 'import';
        $this->subtitle = [
            [
                'url' => route('import.index'),
                'title' => 'Quản lý nhập kho',
            ]            
        ];
    }

    public function index() {
        $page = $this->page;
        $title = 'Quản lý nhập kho';
        $template = 'backend.import.index';
        return view('backend.dashboard.layout', compact(
            'page',
            'title',
            'template',
        ));
    }

    public function create() {
        $page = $this->page;
        $title = 'Nhập kho';
        $subtitle = $this->subtitle;
        $action = 'Nhập kho';
        $template = 'backend.import.form';
        return view('backend.dashboard.layout', compact(
            'page',
            'title',
            'subtitle',
            'action',
            'template',
        ));
    }

    public function store($warehouseId, StoreImportRequest $request) {

    }
}
