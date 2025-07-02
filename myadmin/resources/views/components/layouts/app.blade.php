<!DOCTYPE html>
<html>
    @include('base.head')
    <body>
        <!-- ======== Preloader =========== -->
            <div id="preloader">
            <div class="spinner"></div>
            </div>
        <!-- ======== Preloader =========== -->
        @include('base.sidebarnav')

        <main class="main-wrapper">
            @include('base.header')
            {{$slot}}
            @livewireScripts
            @include('base.footer')
            @include('base.footerscripts')
        </main>
    </body>
</html>