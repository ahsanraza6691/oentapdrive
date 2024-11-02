{{-- <!-- <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>  --> --}}
<!-- {{-- <script src="{{asset('assets/js/rating/jquery.barrating.js')}}"></script> -->


<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="{{asset('assets/js/rating/rating-script.js')}}"></script>
<script src="{{asset('assets/js/owlcarousel/owl.carousel.js')}}"></script>
<!-- <script src="{{asset('assets/js/ecommerce.js')}}"></script> --}} -->
<!-- {{-- <script src="{{asset('assets/js/product-list-custom.js')}}"></script> --}} -->
`
<script src="{{asset('admin/jquery.validate.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Data Tables JS -->
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
<!-- Bootstrap js-->
<script src="{{asset('assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
<!-- feather icon js-->
<script src="{{asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
<script src="{{asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>
<!-- scrollbar js-->
<script src="{{asset('assets/js/scrollbar/simplebar.js')}}"></script>
<script src="{{asset('assets/js/scrollbar/custom.js')}}"></script> 
<!-- Sidebar jquery-->
<script src="{{asset('assets/js/config.js')}}"></script>
<!-- Plugins JS start-->
<script id="menu" src="{{asset('assets/js/sidebar-menu.js')}}"></script>

@yield('script')

@if(Route::current()->getName() != 'popover')
<script src="{{asset('assets/js/tooltip-init.js')}}"></script>
@endif

<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{asset('assets/js/script.js')}}"></script>
<script src="{{asset('assets/js/theme-customizer/customizer.js')}}"></script>

<script src="{{asset('assets/js/dropzone/dropzone.js')}}"></script>
<script src="{{asset('assets/js/dropzone/dropzone-script.js')}}"></script>


<script>
    ClassicEditor
                    .create( document.querySelector( '.editor' ) )
                    .then( editor => {
                            console.log( editor );
                    } )
                    .catch( error => {
                            // console.error( error );
                    } );
    </script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    // $(document).ready(function() {
    //    $('.ckeditor').ckeditor();
    // });

		$(function(){
			$(document).on('click','#delete',function(e){
				 e.preventDefault();
				 var link = $(this).attr("href");
                //  alert(link);
				Swal.fire({
				title: 'Are you sure?',
				text: "To Delete this Data?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = link
					Swal.fire(
					'Deleted!',
					'Your file has been deleted.',
					'success'
					)
				}
				});
			});
		});
</script>
<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch(type){
       case 'info':
       toastr.info(" {{ Session::get('message') }} ");
       break;
       case 'success':
       toastr.success(" {{ Session::get('message') }} ");
       break;
       case 'warning':
       toastr.warning(" {{ Session::get('message') }} ");
       break;
       case 'error':
       toastr.error(" {{ Session::get('message') }} ");
       break;
    }
    @endif
    </script>
    @if($errors->any())
        @foreach($errors->all() as $error)
        <script>
            toastr.error('{{$error}}');
        </script>
        @endforeach
    @endif

    <script>
        function orderNotification(orderNotificationId){
            $.ajax({
                type: "POST",
                url: "{{ route('order_notification') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    orderNotificationId:orderNotificationId
                },
                success: function (response) {
                    if(response.status == 200){
                        window.location.href = response.redirectTo;
                    }else{
                        toastr.error('Sorry!, Something went wrong, try again!');
                    }
                }
            });
        }
       $("#viewAllOrderNotification").on("click", function(){
        
        $.ajax({
                type: "POST",
                url: "{{ route('view_all_order_notification') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    if(response.status == 200){
                        window.location.href = response.redirectTo;
                    }else{
                        toastr.error('Sorry!, Something went wrong, try again!');
                    }
                }
            });
        })
    </script>
@stack('scripts')
