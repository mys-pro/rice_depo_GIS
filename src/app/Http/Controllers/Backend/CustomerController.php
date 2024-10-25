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

    public function __construct(CustomerRepository $customerRepository, customerService $customerService)
    {
        $this->customerRepository = $customerRepository;
        $this->customerService = $customerService;
    }

    public function index(Request $request)
    {
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
            'title',
            'template',
            'customers',
        ));
    }

    public function create()
    {
        $subtitle = [
            [
                'url' => route('customer.index'),
                'title' => 'Quản lý khách hàng',
            ]
        ];
        $title = 'Thêm khách hàng';
        $action = 'Thêm khách hàng';
        $form = route('customer.store');
        $template = 'backend.customer.form';
        return view('backend.dashboard.layout', compact(
            'subtitle',
            'title',
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
        $subtitle = [
            [
                'url' => route('customer.index'),
                'title' => 'Quản lý khách hàng',
            ]
        ];
        $title = 'Cập nhật khách hàng';
        $action = 'Cập nhật';
        $form = route('customer.update', $id);
        $template = 'backend.customer.form';
        $customer = $this->customerRepository->find($id);
        return view('backend.dashboard.layout', compact(
            'subtitle',
            'title',
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
