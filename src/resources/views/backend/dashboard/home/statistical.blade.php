<div class="offcanvas-body mt-5 px-0">
    <div class="section dashboard">
        <div class="row g-3 mb-3">
            <div class="col-6">
                <div class="form-outline">
                    <input type="date" class="form-control" id="date-from" name="birthday" placeholder="Từ ngày"
                        value="{{ date('Y-m-01') }}">
                    <label for="date-form" class="form-label fw-semibold">
                        Từ
                    </label>
                </div>
            </div>

            <div class="col-6">
                <div class="form-outline">
                    <input type="date" class="form-control" id="date-to" name="birthday" placeholder="Đến"
                        value="{{ date('Y-m-t') }}">
                    <label for="date-to" class="form-label fw-semibold">
                        Đến
                    </label>
                </div>
            </div>
        </div>

        <div class="statistical-content">
            <div class="row g-3 mb-3">
                <div class="col-12">
                    <ul class="list-group list-group-flush dashboard-list">
                        <li
                            class="list-group-item p-3 border-0 rounded-3 shadow-sm d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <div
                                    class="dashboard-icon customer-icon rounded-circle d-flex align-items-center justify-content-center me-3">
                                    <i class="bi bi-people"></i>
                                </div>
                                <h6>Nhân viên</h6>
                            </div>

                            <h6>{{ $userTotal }} người</h6>
                        </li>

                        <li
                            class="list-group-item p-3 border-0 rounded-3 shadow-sm d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <div
                                    class="dashboard-icon import-icon rounded-circle d-flex align-items-center justify-content-center me-3">
                                    <i class="bi bi-arrow-bar-down"></i>
                                </div>
                                <h6>Nhập</h6>
                            </div>

                            <h6>{{ $importTotalPrice }} ₫</h6>
                        </li>

                        <li
                            class="list-group-item p-3 border-0 rounded-3 shadow-sm d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div
                                    class="dashboard-icon export-icon rounded-circle d-flex align-items-center justify-content-center me-3">
                                    <i class="bi bi-arrow-bar-up"></i>
                                </div>
                                <h6>Xuất</h6>
                            </div>

                            <h6>{{ $exportTotalPrice }} ₫</h6>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Biểu đồ nhập kho</h5>
                            <!-- Line Chart -->
                            <canvas id="import-chart"></canvas>
                            <!-- End Line CHart -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Biểu đồ xuất kho</h5>
                            <!-- Line Chart -->
                            <canvas id="export-chart"></canvas>
                            <!-- End Line CHart -->
                        </div>
                    </div>
                </div>
            </div>

            <script>
                var colorListOpacity = ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(201, 203, 207, 0.2)'
                ];
                var colorList = ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 159, 64)', 'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)', 'rgb(153, 102, 255)', 'rgb(201, 203, 207)'
                ];
                var names1 = {!! json_encode($importStatistical->pluck('name')) !!};
                var labels1 = names1 != null ? names1.map(name => name.split(' ')) : [];
                var data1 = {
                    labels: labels1,
                    datasets: [{
                        data: {!! json_encode($importStatistical->pluck('total_weight')) !!},
                        backgroundColor: colorList[4],
                        borderColor: colorList[4],
                        borderWidth: 1,
                    }]
                }

                var config1 = {
                    type: 'bar',
                    data: data1,
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    title: (context) => {
                                        return context[0].label.replaceAll(',', ' ');
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                },
                                border: {
                                    display: false
                                }
                            },
                            y: {
                                beginAtZero: true
                            }
                        }
                    },
                };

                new Chart(document.querySelector('#import-chart'), config1);

                var names2 = {!! json_encode($exportStatistical->pluck('name')) !!};
                var labels2 = names2 != null ? names2.map(name => name.split(' ')) : [];
                var data2 = {
                    labels: labels2,
                    datasets: [{
                        data: {!! json_encode($exportStatistical->pluck('total_weight')) !!},
                        backgroundColor: colorList[5],
                        borderColor: colorList[5],
                        borderWidth: 1,
                    }]
                }

                var config2 = {
                    type: 'bar',
                    data: data2,
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    title: (context) => {
                                        return context[0].label.replaceAll(',', ' ');
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                },
                                border: {
                                    display: false
                                }
                            },
                            y: {
                                beginAtZero: true
                            }
                        }
                    },
                };

                new Chart(document.querySelector('#export-chart'), config2);
            </script>
        </div>
    </div>
</div>
