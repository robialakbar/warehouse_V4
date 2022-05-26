<!DOCTYPE html>
<html>
<head>
	<title>PRINT</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="/css/adminlte.min.css">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<style type="text/css">
		* {
			margin: 0;
			padding:  0;
			box-sizing: border-box;
		}
		.lebar-halaman{
			display: grid;
			grid-template-columns: auto auto auto;
			width: {{  $panjang * 3 }}mm; 
			align-items: center;
			justify-content: center;
			text-align: center;
			vertical-align: middle;
			grid-gap: 2mm;
		}	
		.label{
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			width: {{ $panjang }}mm;
			height:  {{ $lebar }}mm;
			/*border-style: dotted;*/
			/*background-color: rgba(255, 255, 255, 0.8);*/
			/*border: 1px solid rgba(0, 0, 0, 0.8);*/
			/*display: flex;*/
		}

		.nama{
			font-size: 10px;
		}
		.kode{
			font-size: 8px;
		}
		.harga{
			font-size: 10px;
		}
		.barcode{
			width: 20mm;
		}

		@media print {  
			@page {
				size: {{ $panjang * 3 }}mm auto; /* landscape */
				/* you can also specify margins here: */
				margin: 0;
			}
		}
	</style>
</head>
<body>
	<div class="lebar-halaman" id="print-halaman">
		@for($i =1; $i <= $jumlah ; $i++)
		<div class="label">
			<div class="nama">{{substr($data->product_name,0,15)  }}</div>
			<img class="barcode"/>
			<div class="kode">{{ $data->product_code }}</div>
			<div class="harga">Rp. {{ number_format($data->sale_price, 0, ",", ".") }}</div>
		</div>
		@endfor
	</div>
	<script src="/plugins/jquery/jquery.min.js"></script>
	<script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="/js/adminlte.js"></script>
	<script type="text/javascript">
		barcode({{ $data->product_code }});
		
		function barcode(code){
			$(".kode").val(code);
			$(".barcode").attr("src", "/products/barcode2/"+code);
		}

		$( document ).ready(function() {
			window.print();
		});
	</script>

</body>
</html>



