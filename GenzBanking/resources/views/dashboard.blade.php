@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="bi bi-plus-circle"></i>
                            <a class="nav-link" href="{{ route('wallet.create.form') }}">
    <i class="bi bi-plus-circle"></i>
    Create Wallet
</a>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-credit-card"></i>
                            See Card Offers
                        </a>
                    </li>
                    <!-- Add more navigation items here -->
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <h1 class="h2 mt-4">Welcome to Your Dashboard</h1>
            <p>Select an option from the sidebar to proceed.</p>
            <!-- Add more dashboard content here -->
        </main>
    </div>
</div>
@endsection
