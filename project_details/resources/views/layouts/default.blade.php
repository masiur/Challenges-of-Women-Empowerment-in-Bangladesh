<!DOCTYPE html>
<html lang="en">

@include('includes.header')
@yield('style')
<body>


<section class="wraper container-fluid">
    <section class="">
       <center>
        @yield('content')
       </center>
    </section>
</section>

@include('includes.footer')
@yield('script')
</body>
</html>