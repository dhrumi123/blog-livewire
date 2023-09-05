<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <title>Cuba - Premium Admin Template</title>

    @include('user.partials.style');
   
    @livewireStyles
</head>

<body>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @include('user.partials.header');
    
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper horizontal-menu">
            <!-- Page Sidebar Start-->
            @include('user.partials.mainsidebar');
            
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                {{ $slot }}
                {{-- <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <h3>Layout Light</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">Color version</li>
                                    <li class="breadcrumb-item active">Layout light</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row starter-main">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Kick start your project development !</h5>
                                    <div class="card-header-right">

                                    </div>
                                </div>
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            @include('user.partials.footer');

        </div>
    </div>

    @include('user.partials.script');
    
    @yield('script')
    
    @livewireScripts
</body>

</html>
