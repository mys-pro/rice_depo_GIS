<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\WarehouseRepositoryInterface as WarehouseRepository;

class MapController extends Controller
{
    protected $warehouseRepository;

    public function __construct(WarehouseRepository $warehouseRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
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
}