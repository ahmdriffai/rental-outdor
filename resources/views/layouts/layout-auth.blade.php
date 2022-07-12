<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.components.head')
</head>

<body class="bg-light">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-10 col-md-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    @yield('content')
                </div>
            </div>

        </div>

    </div>

</div>


@include('layouts.components.script')

</body>

</html>
