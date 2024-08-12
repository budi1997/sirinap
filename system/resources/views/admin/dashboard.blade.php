@extends('admin.template.base')

@section('title', 'SIRInap - Sistem Informasi Reserfasi Penginapan')

@section('content')

    <div class="container-fluid">
        <div class="row">
            @foreach ($list_penginapan as $penginapan)
                <div class="col-lg-6 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-two card-body">
                            <div class="stat-content">
                                <h4 class="text-uppercase">Penginapan {{ $penginapan->nama }}</h4>
                                @php
                                    // Group kamar berdasarkan tipe_kamar
                                    $kamar_by_tipe = $penginapan->kamars->groupBy('tipe_kamar');
                                @endphp
                                <hr>
                                <div class="row">
                                    @foreach ($kamar_by_tipe as $tipe_kamar => $kamars)
                                        @php
                                            // Hitung total kamar dan kamar yang tersedia
                                            $totalKamar = $kamars->count();
                                            $kamarTersedia = $kamars->where('status', 'Tersedia')->count();
                                        @endphp
                                        <div class="col-lg-6">
                                            <h6
                                                style="background-color: #7ED321; padding-top: 0.5em; padding-bottom: 0.5em; color: white;">
                                                {{ $tipe_kamar }}</h6>
                                            <span style="color: #343a40;">Total Kamar : {{ $totalKamar }} Kamar</span> <br>
                                            <span style="color: #343a40;">Kamar Tersedia : {{ $kamarTersedia }} Kamar</span>

                                        </div>
                                    @endforeach
                                </div>
                                {{-- <div class="stat-digit"> <i class="fas fa-hotel"></i>{{$total_kamar}}</div> --}}
                            </div>
                            {{-- <div class="progress">
                            <div class="progress-bar progress-bar-success w-85" role="progressbar" aria-valuenow="85"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div> --}}
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- <div class="col-lg-6 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total Reservasi</div>
                            <div class="stat-digit"> <i class="fas fa-calendar-check"></i>{{$total_reservasi}}</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-primary w-75" role="progressbar" aria-valuenow="78"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total Admin</div>
                            <div class="stat-digit"> <i class="fas fa-users"></i> {{$total_admin}}</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning w-50" role="progressbar" aria-valuenow="50"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total Konsumen</div>
                            <div class="stat-digit"> <i class="fas fa-users"></i>{{$total_user}}</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-danger w-65" role="progressbar" aria-valuenow="65"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <!-- /# card -->
            </div> --}}
            <!-- /# column -->
        </div>
        {{-- <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Sales Overview</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12 col-lg-8">
                                <div id="morris-bar-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="m-t-10">
                            <h4 class="card-title">Customer Feedback</h4>
                            <h2 class="mt-3">385749</h2>
                        </div>
                        <div class="widget-card-circle mt-5 mb-5" id="info-circle-card">
                            <i class="ti-control-shuffle pa"></i>
                        </div>
                        <ul class="widget-line-list m-b-15">
                            <li class="border-right">92% <br><span class="text-success"><i class="ti-hand-point-up"></i>
                                    Positive</span></li>
                            <li>8% <br><span class="text-danger"><i class="ti-hand-point-down"></i>Negative</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row">
            {{-- <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Project</h4>
                    </div>
                    <div class="card-body">
                        <div class="current-progress">
                            <div class="progress-content py-2">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="progress-text">Website</div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="current-progressbar">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-primary w-40" role="progressbar"
                                                    aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    40%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-content py-2">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="progress-text">Android</div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="current-progressbar">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-primary w-60" role="progressbar"
                                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                                    60%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-content py-2">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="progress-text">Ios</div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="current-progressbar">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-primary w-70" role="progressbar"
                                                    aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                                    70%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-content py-2">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="progress-text">Mobile</div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="current-progressbar">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-primary w-90" role="progressbar"
                                                    aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                                                    90%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="testimonial-widget-one p-17">
                            <div class="testimonial-widget-one owl-carousel owl-theme">
                                <div class="item">
                                    <div class="testimonial-content">
                                        <div class="testimonial-text">
                                            <i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetur
                                            adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                                            aliqua. Ut enim ad minim veniam, quis nostrud exercitation.
                                            consectetur adipisicing elit.
                                            <i class="fa fa-quote-right"></i>
                                        </div>
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="testimonial-author">TYRION LANNISTER</div>
                                                <div class="testimonial-author-position">Founder-Ceo. Dell Corp
                                                </div>
                                            </div>
                                            <img class="testimonial-author-img ml-3"
                                                src="{{ url('public/admin') }}/images/avatar/1.png" alt="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="testimonial-content">
                                        <div class="testimonial-text">
                                            <i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetur
                                            adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                                            aliqua. Ut enim ad minim veniam, quis nostrud exercitation.
                                            consectetur adipisicing elit.
                                            <i class="fa fa-quote-right"></i>
                                        </div>
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="testimonial-author">TYRION LANNISTER</div>
                                                <div class="testimonial-author-position">Founder-Ceo. Dell Corp
                                                </div>
                                            </div>
                                            <img class="testimonial-author-img ml-3"
                                                src="{{ url('public/admin') }}/images/avatar/1.png" alt="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="testimonial-content">
                                        <div class="testimonial-text">
                                            <i class="fa fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetur
                                            adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                                            aliqua. Ut enim ad minim veniam, quis nostrud exercitation.
                                            consectetur adipisicing elit.
                                            <i class="fa fa-quote-right"></i>
                                        </div>
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="testimonial-author">TYRION LANNISTER</div>
                                                <div class="testimonial-author-position">Founder-Ceo. Dell Corp
                                                </div>
                                            </div>
                                            <img class="testimonial-author-img ml-3"
                                                src="{{ url('public/admin') }}/images/avatar/1.png" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Web Server</h4>
                    </div>
                    <div class="card-body">
                        <div class="cpu-load-chart">
                            <div id="cpu-load" class="cpu-load"></div>
                        </div>
                    </div>
                </div>
                <!-- /# card -->
            </div> --}}
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-uppercase">Reservasi Terbaru</h4>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0" style="color: #343a40">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Konsumen</th>
                                        <th>Kamar</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_reservasi as $reservasi)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $reservasi->user->nama }}</td>
                                            <td>
                                                <ul>
                                                    @foreach ($reservasi->kamars as $kamar)
                                                        <li>
                                                            Penginapan {{$kamar->penginapan->nama}} <br>
                                                            {{ $kamar->tipe_kamar }} {{ $kamar->nomor_kamar }} -
                                                            Rp {{ number_format($kamar->harga, 0, ',','.') }} / malam
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>Rp {{ number_format($reservasi->total_biaya, 0, ',','.') }}</td>
                                            <td><span
                                                    class="badge {{ $reservasi->getStatusBadgeClass() }}">{{ $reservasi->status }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-lg-6 col-xl-4 col-xxl-6 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Timeline</h4>
                    </div>
                    <div class="card-body">
                        <div class="widget-timeline">
                            <ul class="timeline">
                                <li>
                                    <div class="timeline-badge primary"></div>
                                    <a class="timeline-panel text-muted" href="#">
                                        <span>10 minutes ago</span>
                                        <h6 class="m-t-5">Youtube, a video-sharing website, goes live.</h6>
                                    </a>
                                </li>

                                <li>
                                    <div class="timeline-badge warning">
                                    </div>
                                    <a class="timeline-panel text-muted" href="#">
                                        <span>20 minutes ago</span>
                                        <h6 class="m-t-5">Mashable, a news website and blog, goes live.</h6>
                                    </a>
                                </li>

                                <li>
                                    <div class="timeline-badge danger">
                                    </div>
                                    <a class="timeline-panel text-muted" href="#">
                                        <span>30 minutes ago</span>
                                        <h6 class="m-t-5">Google acquires Youtube.</h6>
                                    </a>
                                </li>

                                <li>
                                    <div class="timeline-badge success">
                                    </div>
                                    <a class="timeline-panel text-muted" href="#">
                                        <span>15 minutes ago</span>
                                        <h6 class="m-t-5">StumbleUpon is acquired by eBay. </h6>
                                    </a>
                                </li>

                                <li>
                                    <div class="timeline-badge warning">
                                    </div>
                                    <a class="timeline-panel text-muted" href="#">
                                        <span>20 minutes ago</span>
                                        <h6 class="m-t-5">Mashable, a news website and blog, goes live.</h6>
                                    </a>
                                </li>

                                <li>
                                    <div class="timeline-badge dark">
                                    </div>
                                    <a class="timeline-panel text-muted" href="#">
                                        <span>20 minutes ago</span>
                                        <h6 class="m-t-5">Mashable, a news website and blog, goes live.</h6>
                                    </a>
                                </li>

                                <li>
                                    <div class="timeline-badge info">
                                    </div>
                                    <a class="timeline-panel text-muted" href="#">
                                        <span>30 minutes ago</span>
                                        <h6 class="m-t-5">Google acquires Youtube.</h6>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-xxl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Todo</h4>
                    </div>
                    <div class="card-body px-0">
                        <div class="todo-list">
                            <div class="tdl-holder">
                                <div class="tdl-content widget-todo mr-4">
                                    <ul id="todo_list">
                                        <li><label><input type="checkbox"><i></i><span>Get up</span><a href='#'
                                                    class="ti-trash"></a></label></li>
                                        <li><label><input type="checkbox" checked><i></i><span>Stand up</span><a
                                                    href='#' class="ti-trash"></a></label></li>
                                        <li><label><input type="checkbox"><i></i><span>Don't give up the
                                                    fight.</span><a href='#' class="ti-trash"></a></label></li>
                                        <li><label><input type="checkbox" checked><i></i><span>Do something
                                                    else</span><a href='#' class="ti-trash"></a></label></li>
                                        <li><label><input type="checkbox" checked><i></i><span>Stand up</span><a
                                                    href='#' class="ti-trash"></a></label></li>
                                        <li><label><input type="checkbox"><i></i><span>Don't give up the
                                                    fight.</span><a href='#' class="ti-trash"></a></label></li>
                                    </ul>
                                </div>
                                <div class="px-4">
                                    <input type="text" class="tdl-new form-control"
                                        placeholder="Write new item and hit 'Enter'...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-xxl-6 col-xl-4 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Product Sold</h4>
                        <div class="card-action">
                            <div class="dropdown custom-dropdown">
                                <div data-toggle="dropdown">
                                    <i class="ti-more-alt"></i>
                                </div>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Option 1</a>
                                    <a class="dropdown-item" href="#">Option 2</a>
                                    <a class="dropdown-item" href="#">Option 3</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart py-4">
                            <canvas id="sold-product"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-xxl-6 col-lg-6 col-md-12">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-sm-6 col-xxl-6 col-md-6">
                        <div class="card">
                            <div class="social-graph-wrapper widget-facebook">
                                <span class="s-icon"><i class="fa fa-facebook"></i></span>
                            </div>
                            <div class="row">
                                <div class="col-6 border-right">
                                    <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                        <h4 class="m-1"><span class="counter">89</span> k</h4>
                                        <p class="m-0">Friends</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                        <h4 class="m-1"><span class="counter">119</span> k</h4>
                                        <p class="m-0">Followers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-sm-6 col-xxl-6 col-md-6">
                        <div class="card">
                            <div class="social-graph-wrapper widget-linkedin">
                                <span class="s-icon"><i class="fa fa-linkedin"></i></span>
                            </div>
                            <div class="row">
                                <div class="col-6 border-right">
                                    <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                        <h4 class="m-1"><span class="counter">89</span> k</h4>
                                        <p class="m-0">Friends</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                        <h4 class="m-1"><span class="counter">119</span> k</h4>
                                        <p class="m-0">Followers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-sm-6 col-xxl-6 col-md-6">
                        <div class="card">
                            <div class="social-graph-wrapper widget-googleplus">
                                <span class="s-icon"><i class="fa fa-google-plus"></i></span>
                            </div>
                            <div class="row">
                                <div class="col-6 border-right">
                                    <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                        <h4 class="m-1"><span class="counter">89</span> k</h4>
                                        <p class="m-0">Friends</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                        <h4 class="m-1"><span class="counter">119</span> k</h4>
                                        <p class="m-0">Followers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-sm-6 col-xxl-6 col-md-6">
                        <div class="card">
                            <div class="social-graph-wrapper widget-twitter">
                                <span class="s-icon"><i class="fa fa-twitter"></i></span>
                            </div>
                            <div class="row">
                                <div class="col-6 border-right">
                                    <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                        <h4 class="m-1"><span class="counter">89</span> k</h4>
                                        <p class="m-0">Friends</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                        <h4 class="m-1"><span class="counter">119</span> k</h4>
                                        <p class="m-0">Followers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

    </div>

@endsection
