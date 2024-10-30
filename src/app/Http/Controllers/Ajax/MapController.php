<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\WarehouseRepositoryInterface as WarehouseRepository;
use App\Repositories\Interfaces\ImportRepositoryInterface as ImportRepository;
use App\Repositories\Interfaces\ExportRepositoryInterface as ExportRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;

class MapController extends Controller
{
    protected $warehouseRepository;
    protected $importRepository;
    protected $exportRepository;
    protected $userRepository;

    public function __construct(
        WarehouseRepository $warehouseRepository,
        ImportRepository $importRepository,
        ExportRepository $exportRepository,
        UserRepository $userRepository
    ) {
        $this->warehouseRepository = $warehouseRepository;
        $this->importRepository = $importRepository;
        $this->exportRepository = $exportRepository;
        $this->userRepository = $userRepository;
    }

    public function getMarker()
    {
        $location = $this->warehouseRepository->all();
        $popupList = array();
        foreach ($location as $data) {
            array_push($popupList, $this->popupView($data));
        }
        return response()->json(
            [
                'data' => $location,
                'popupList' => $popupList,
            ]
        );
    }

    public function popupView($data)
    {
        $image = asset((isset($data->image) ? $data->image : 'backend/img/default_image.png'));
        $statusText = $data->status == '1' ? 'Hoạt động' : 'Ngưng hoạt đông';
        $statusColor = $data->status == '1' ? 'text-success' : 'text-warning';
        return '<div class="card border-0 m-0" style="width: 18rem;">'
            . '<img src="' . $image . '" class="card-img-top" alt="image" height="150px">'
            . '<div class="card-body">'
            . '<h5 class="card-title m-0 text-truncate">' . $data->name . '</h5>'
            . '<p class="card-text m-0 text-secondary">Nhà kho</p>'
            . '<p class="card-text m-0 text-secondary text-truncate">' . $data->address . '</p>'
            . '<p class="card-text m-0 ' . $statusColor . '">' . $statusText . '</p>'
            . '<div class="d-flex mt-3 align-items-center justify-content-center">'
            . '<button class="warehouse-info-btn btn btn-outline-primary rounded-pill" data-id="' . $data->id . '">Xem chi tiết</button>'
            . '</div>'
            . '</div>'
            . '</div>';
    }

    public function search(Request $request)
    {
        $get = $request->input();
        $warehouses = $this->warehouseRepository->findByName($get['name'] ?? '');
        return view('backend.dashboard.home.location', compact(
            'warehouses',
        ));
    }

    public function statistical($id, Request $request)
    {
        $get = $request->input();
        $importStatistical = $this->importRepository->statistical($id, $get['from'] ?? null, $get['to'] ?? null);
        $importTotalPrice = $this->importRepository->getPriceTotal($id, $get['from'] ?? null, $get['to'] ?? null);
        $importTotalPrice = number_format($importTotalPrice, 0, '', '.');
        $exportStatistical = $this->exportRepository->statistical($id, $get['from'] ?? null, $get['to'] ?? null);
        $exportTotalPrice = $this->exportRepository->getPriceTotal($id, $get['from'] ?? null, $get['to'] ?? null);
        $exportTotalPrice = number_format($exportTotalPrice, 0, '', '.');
        $userTotal = $this->userRepository->getTotalByWarehouse($id);
        return view('backend.dashboard.home.statistical', compact(
            'importStatistical',
            'importTotalPrice',
            'exportStatistical',
            'exportTotalPrice',
            'userTotal',
        ));
    }
}