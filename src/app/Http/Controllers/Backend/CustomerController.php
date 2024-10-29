<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\CustomerRepositoryInterface as CustomerRepository;
use App\Services\Interfaces\CustomerServiceInterface as customerService;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    protected $customerRepository;
    protected $customerService;
    protected $page;
    protected $subtitle;

    public function __construct(CustomerRepository $customerRepository, customerService $customerService)
    {
        $this->customerRepository = $customerRepository;
        $this->customerService = $customerService;
        $this->page = 'customer';
        $this->subtitle = [
            [
                'url' => route('customer.index'),
                'title' => 'Quản lý khách hàng',
            ]
        ];
    }

    public function index(Request $request)
    {
        $page = $this->page;
        $title = "Quản lý khách hàng";
        $get = $request->input();
        $template = 'backend.customer.index';
        $search = $get['search'] ?? '';

        $conditions = [];

        if (!empty($search)) {
            $conditions[] = ['name', 'like', "%{$search}%"];
        }

        $customers = $this->customerRepository->getPaginateBy($conditions);

        return view('backend.dashboard.layout', compact(
            'page',
            'title',
            'template',
            'customers',
        ));
    }

    public function create()
    {
        $page = $this->page;
        $title = 'Thêm mới khách hàng';
        $subtitle = $this->subtitle;
        $action = 'Thêm';
        $form = route('customer.store');
        $template = 'backend.customer.form';
        return view('backend.dashboard.layout', compact(
            'page',
            'title',
            'subtitle',
            'action',
            'form',
            'template',
        ));
    }

    public function store(StoreCustomerRequest $request)
    {
        if ($this->customerService->create($request)) {
            flash()->success('Thêm mới bản ghi thành công.');
            return redirect()->route('customer.index');
        } else {
            flash()->error('Thêm mới bản ghi thất bại.');
            return redirect()->route('customer.index');
        }
    }

    public function edit($id)
    {
        $page = $this->page;
        $title = 'Chỉnh sửa khách hàng';
        $subtitle = $this->subtitle;
        $action = 'Lưu';
        $form = route('customer.update', $id);
        $template = 'backend.customer.form';
        $customer = $this->customerRepository->find($id);
        return view('backend.dashboard.layout', compact(
            'page',
            'title',
            'subtitle',
            'action',
            'form',
            'template',
            'customer',
        ));
    }

    public function update($id, UpdateCustomerRequest $request)
    {
        if ($this->customerService->update($id, $request)) {
            flash()->success('Cập nhật bản ghi thành công.');
            return redirect()->route('customer.index');
        } else {
            flash()->error('Cập nhật bản ghi thất bại.');
            return redirect()->route('customer.index');
        }
    }

    public function delete($id)
    {
        if ($this->customerService->delete($id)) {
            flash()->success('Xóa bản ghi thành công.');
            return redirect()->route('customer.index');
        } else {
            flash()->error('Xóa bản ghi thất bại.');
            return redirect()->route('customer.index');
        }
    }
}
