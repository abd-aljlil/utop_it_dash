
        
        <script src="{{ URL::asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{ URL::asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{ URL::asset('assets/global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
        <script src="{{ URL::asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <script src="{{ URL::asset('assets/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
        <script src="js/vue.js" type="text/javascript"></script>
        <script src="js/axios.min.js" type="text/javascript"></script>
        <script src="{{ URL::asset('assets/layouts/layout/scripts/custom.js')}}" type="text/javascript"></script>
        <script src="{{ URL::asset('assets/global/plugins/bootstrap-toastr/toastr.js')}}" type="text/javascript"></script>
        <script type="text/javascript">
            $('#menu-toggler').trigger('click');
        </script>
        @yield('scripts')

    </body>
</html>
