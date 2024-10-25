<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePassRequest;
use App\Models\user_catalogue;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\WarehouseRepositoryInterface as WarehouseRepository;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	protected $userCatalogueRepository;
	protected $userRepository;
	protected $userService;
	protected $warehouseRepository;

	public function __construct(
		UserCatalogueRepository $userCatalogueRepository,
		UserService $userService,
		UserRepository $userRepository,
		WarehouseRepository $warehouseRepository
	) {
		$this->userCatalogueRepository = $userCatalogueRepository;
		$this->userService = $userService;
		$this->userRepository = $userRepository;
		$this->warehouseRepository = $warehouseRepository;
	}

	public function index(Request $request)
	{
		$get = $request->input();
		$title = 'Quản lý nhân viên';

		$search = $get['search'] ?? '';
		$status = $get['status'] ?? '';
		$user_catalogue_id = $get['user_catalogue'] ?? '';
		$warehouse_id = $get['warehouse'] ?? '';

		$conditions = [['u.id', '!=', Auth::id()]];

		if (!empty($search)) {
			$conditions[] = ['u.name', 'like', "%{$search}%"];
		}

		if ($status != '') {
			$conditions[] = ['status', '=', $status];
		}

		if ($user_catalogue_id != '') {
			$conditions[] = ['user_catalogue_id', '=', $user_catalogue_id];
		}

		if ($warehouse_id != '') {
			$conditions[] = ['warehouse_id', '=', $warehouse_id];
		}

		$warehouses = $this->warehouseRepository->all();
		$userCatalogues = $this->userCatalogueRepository->all();
		$template = 'backend.user.index';
		$users = $this->userRepository->getPaginateBy($conditions);
		return view('backend.dashboard.layout', compact(
			'title',
			'users',
			'warehouses',
			'userCatalogues',
			'template',
		));
	}

	public function create()
	{
		$subtitle = [
			[
				'url' => route('user.index'),
				'title' => 'Quản lý nhân viên',
			]
		];
		$title = "Thêm nhân viên";
		$form = route('user.store');
		$template = 'backend.user.create';
		$warehouses = $this->warehouseRepository->all();
		$userCatalogues = $this->userCatalogueRepository->all();
		return view('backend.dashboard.layout', compact(
			'subtitle',
			'title',
			'form',
			'template',
			'warehouses',
			'userCatalogues',
		));
	}

	public function store(StoreUserRequest $request)
	{
		if ($this->userService->create($request)) {
			flash()->success('Thêm mới bản ghi thành công.');
			return redirect()->route('user.index');
		}
		flash()->error('Thêm mới bản ghi không thành công.');
		return redirect()->route('user.index');
	}

	public function detail($id)
	{
		$self = Auth::id() == $id;
		$subtitle = [
			[
				'url' => route('user.index'),
				'title' => $self ? 'Người dùng' : 'Quản lý nhân viên',
			]
		];
		$title = "Tổng quan";
		$template = 'backend.user.detail';
		$user = $this->userRepository->find($id);
		$user_catalogue = $this->userCatalogueRepository->find($user->user_catalogue_id);
		$warehouse = $this->warehouseRepository->find($user->warehouse_id ?? 0);
		if (isset($user->birthday)) {
			$user->birthday = Carbon::createFromFormat('Y-m-d H:i:s', $user->birthday)->format('Y-m-d');
		}
		return view('backend.dashboard.layout', compact(
			'self',
			'title',
			'subtitle',
			'template',
			'user',
			'user_catalogue',
			'warehouse'
		));
	}

	public function changePass($id)
	{
		$self = Auth::id() == $id;
		$subtitle = [
			[
				'url' => route('user.index'),
				'title' => $self ? 'Người dùng' : 'Quản lý nhân viên',
			]
		];
		$title = "Đổi mật khẩu";
		$template = 'backend.user.changePass';
		$user = $this->userRepository->find($id);
		$user_catalogue = $this->userCatalogueRepository->find($user->user_catalogue_id);
		return view('backend.dashboard.layout', compact(
			'self',
			'title',
			'subtitle',
			'template',
			'user',
			'user_catalogue',
		));
	}

	public function updatePass($id, UpdatePassRequest $request)
	{
		if ($this->userService->update($id, $request)) {
			flash()->success('Cập nhật bản ghi thành công.');
			return redirect()->route('user.index');
		}
		flash()->error('Cập nhật bản ghi không thành công.');
		return redirect()->route('user.index');
	}

	public function edit($id)
	{
		$self = Auth::id() == $id;
		$subtitle = [
			[
				'url' => route('user.index'),
				'title' => $self ? 'Người dùng' : 'Quản lý nhân viên',
			]
		];
		$title = "Chỉnh sửa";
		$template = 'backend.user.edit';
		$user = $this->userRepository->find($id);
		if (isset($user->birthday)) {
			$user->birthday = Carbon::createFromFormat('Y-m-d H:i:s', $user->birthday)->format('Y-m-d');
		}
		$warehouses = $this->warehouseRepository->all();
		$userCatalogues = $this->userCatalogueRepository->all();
		$user_catalogue = $this->userCatalogueRepository->find($user->user_catalogue_id);
		return view('backend.dashboard.layout', compact(
			'self',
			'subtitle',
			'title',
			'template',
			'user',
			'warehouses',
			'userCatalogues',
			'user_catalogue',
		));
	}

	public function update($id, UpdateUserRequest $request)
	{
		if ($this->userService->update($id, $request)) {
			flash()->success('Cập nhật bản ghi thành công.');
			return redirect()->route('user.index');
		}
		flash()->error('Cập nhật bản ghi không thành công.');
		return redirect()->route('user.index');
	}

	public function delete($id)
	{
		if ($this->userService->delete($id)) {
			flash()->success('Xóa bản ghi thành công.');
			return redirect()->route('user.index');
		}
		flash()->error('Xóa bản ghi không thành công.');
		return redirect()->route('user.index');
	}
}