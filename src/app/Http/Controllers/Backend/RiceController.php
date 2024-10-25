<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRiceRequest;
use App\Http\Requests\UpdateRiceRequest;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\RiceRepositoryInterface as RiceRepository;
use App\Services\Interfaces\RiceServiceInterface as RiceService;

class RiceController extends Controller
{
    protected $riceService;
    protected $riceRepository;

    public function __construct(RiceService $riceService, RiceRepository $riceRepository)
    {
        $this->riceService = $riceService;
        $this->riceRepository = $riceRepository;
    }

    public function index(Request $request)
    {
        $get = $request->input();
        $title = 'Quản lý lúa';
        $template = 'backend.rice.index';
        $rice = $this->riceRepository->findByName($get['search'] ?? '');
        return view('backend.dashboard.layout', compact(
            'title',
            'template',
            'rice',
        ));
    }

    public function search(Request $request)
    {
        $title = 'Danh sách lúa';
        $get = $request->input();
        $rice = $this->riceRepository->findByName($get['name']);
        return view('backend.rice.index', compact(
            'title',
            'rice',
        ));
    }

    public function create()
    {
        $subtitle = [
            [
                'url' => route('rice.index'),
                'title' => 'Quản lý lúa',
            ]
        ];
        $title = 'Thêm lúa';
        $action = 'Thêm lúa';
        $form = route('rice.store');
        $template = 'backend.rice.form';
        return view('backend.dashboard.layout', compact(
            'subtitle',
            'title',
            'action',
            'form',
            'template',
        ));
    }

    public function store(StoreRiceRequest $request)
    {
        if ($this->riceService->create($request)) {
            flash()->success('Thêm mới bản ghi thành công.');
            return redirect()->route('rice.index');
        } else {
            flash()->error('Thêm mới bản ghi thất bại.');
            return redirect()->route('rice.index');
        }
    }

    public function edit($id)
    {
        $subtitle = [
            [
                'url' => route('rice.index'),
                'title' => 'Quản lý lúa',
            ]
        ];
        $title = 'Cập nhật lúa';
        $action = 'Cập nhật';
        $form = route('rice.update', $id);
        $template = 'backend.rice.form';
        $rice = $this->riceRepository->find($id);
        return view('backend.dashboard.layout', compact(
            'subtitle',
            'title',
            'action',
            'form',
            'rice',
            'template'
        ));
    }

    public function update($id, UpdateRiceRequest $request)
    {
        if ($this->riceService->update($id, $request)) {
            flash()->success('Cập nhật bản ghi thành công.');
            return redirect()->route('rice.index');
        } else {
            flash()->error('Cập nhật bản ghi thất bại.');
            return redirect()->route('rice.index');
        }
    }

    public function delete($id)
    {
        if ($this->riceService->delete($id)) {
            flash()->success('Xóa bản ghi thành công.');
            return redirect()->route('rice.index');
        } else {
            flash()->error('Xóa bản ghi thất bại.');
            return redirect()->route('rice.index');
        }
    }
}
