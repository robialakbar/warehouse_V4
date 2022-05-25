
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

	@page {
		margin: 0;
	}
</style>

<style type="text/css">
</style>
<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-md-6">Preview Print</div>
			<div class="col-md-6"><button class="btn btn-success" id="printThis" >Print</button></div>
		</div>
	</div>
	<div class="card-body">
		
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
	</div>
</div>
<script type="text/javascript">
	barcode({{ $data->product_code }});
	function barcode(code){
		$(".kode").val(code);
		$(".barcode").attr("src", "/products/barcode2/"+code);
	}

	$(document).on('click','#printThis', function(){
		$('#print-halaman').printThis({
			importStyle: true,
		});
	})
</script>