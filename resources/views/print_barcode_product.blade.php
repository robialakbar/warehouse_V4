@extends('layouts.main')
@section('title', __('Products'))
@section('custom-css')
<link rel="stylesheet" href="/plugins/toastr/toastr.min.css">
<link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
@section('content')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
		</div>
	</div>
</div>
<section class="content">
	<div class="container-fluid">
		<div class="card">
			<div class="card-header">
				<h4>PRINT BARCODE PRODUCT</h4>
			</div>
			<div class="card-body">
				<form action="{{ url()->full() }}" method="GET" id="form">
					<div class="form-group row">
						<label for="inputPassword" class="col-sm-2 col-form-label">Ukuran Per Label</label>
					</div>	
					<div class="form-group row">
						<label for="inputPassword" class="col-sm-2 col-form-label">Panjang</label>
						<div class="col-sm-2">
							<input type="number" class="form-control" placeholder="panjang" name="panjang" id="panjang" value="50">
							<small>*mm</small>
						</div>
						<label for="inputPassword" class="col-sm-2 col-form-label">Lebar</label>
						<div class="col-sm-2">
							<input type="number" class="form-control" placeholder="lebar" name="lebar" id="lebar" value="23">
							<small>*mm</small>
						</div>
					</div>	
					<div class="form-group row">
						<label for="inputPassword" class="col-sm-2 col-form-label">Jumlah Print Barcode</label>
						<div class="col-sm-2">
							<input type="number" class="form-control" placeholder="Jumlah" name="jumlah" id="jumlah" value="3">
						</div>
						<input type="hidden" name="type" value="print-preview">
						<div class="col-sm-2">
							<button class="btn btn-success col-12" type="submit" >Tampilkan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div id="dataPrint">			
		</div>
	</div>
</div>

</section>
@endsection
@section('custom-js')
<script src="/plugins/toastr/toastr.min.js"></script>
<script src="/plugins/select2/js/select2.full.min.js"></script>
<script src="/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="{{ asset('js/printThis.js') }}"></script>
<script type="text/javascript">
	$(document).on('click', '#tampil', function(){

		if($('#panjang').val() == ''){
			return toastr.error('Label Panjang Tidak Boleh Kosong');
		} 

		if($('#lebar').val() == ''){
			return toastr.error('Lebar Tidak Boleh Kosong');
		} 		

		if($('#jumlah').val() == ''){
			return toastr.error('Jumlah Tidak Boleh Kosong');
		} 

		getData('{{ url()->full() }}', '#dataPrint')
		
	});

	function getData(url, elementId){
		
		$.ajax({
			url: url,
			type: "get",
			datatype: "html",
			data : $('#form').serialize(),
			beforeSend: function() {
				// Swal.fire({title: 'Memuat data..', icon: 'info', toast: true, position: 'top-end', showConfirmButton: false, timer: 0});
			},
			complete: function(data){
				toastr.success('selesai');
			},
			success: function(data){
				$(elementId).empty().html(data);
				$('[data-toggle="tooltip"]').tooltip();
			},
			error: function(jqXHR, ajaxOptions, thrownError){
				toastr.success(jqXHR, ajaxOptions, thrownError);
				// Swal.fire({html: 'No response from server', icon: 'error', toast: true, position: 'top', showConfirmButton: true, timer: 0});
			}
		})
	}

</script>
@if(Session::has('success'))
<script>toastr.success('{!! Session::get("success") !!}');</script>
@endif
@if(Session::has('error'))
<script>toastr.error('{!! Session::get("error") !!}');</script>
@endif
@if(!empty($errors->all()))
<script>toastr.error('{!! implode("", $errors->all("<li>:message</li>")) !!}');</script>
@endif
@endsection