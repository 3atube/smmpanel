<!--end::Content-->
    <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
        <!--begin::Container-->
        <div class="container-fluid d-flex flex-column flex-md-row flex-stack">
            <!--begin::Copyright-->
            <div class="text-dark order-2 order-md-1">
                <span class="text-gray-400 fw-bold me-1">Created by</span>
                <a href="/" target="_blank" class="text-muted text-hover-primary fw-bold me-2 fs-6">Services</a>
            </div>
            <!--end::Copyright-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Footer-->
</div>
<!--end::Wrapper-->
 </div>
        <!--end::Page-->
    </div>
   
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
                    fill="black" />
                <path
                    d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                    fill="black" />
            </svg>
        </span>
        <!--end::Svg Icon-->
    </div>
     <!--end::Scrolltop-->
    <!--begin::Javascript-->
    <script src="/assets/client/1/plugins/global/plugins.bundle.js"></script>
    <script src="/assets/client/1/js/scripts.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @yield('scriptFooter')
    <script>
        $(document).on('click', '.details-service', function(){
            var service_id = $(this).attr('data-id');
            $.ajax({
                url:'{{route('home.details-service')}}',
                method:"GET",
                data:{
                    service_id:service_id,
                },
                beforeSend: function() {
                    },
                    success:function(data){
                        if(data.error){
                            alert(data.message);
                            return false;
                        }
                        $('#modal-detail').modal('show');
                        $('#modal-detail .fw-bolder').html(data.title)
                        $('#modal-detail .modal-body.scroll-y').html(data.desc)
                }
            })
        })
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                    pageLanguage: 'en'
                },
                'google_translate_element'
            );
        }
    </script>
</body>
<!--end::Body-->

</html>
