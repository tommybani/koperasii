<script>
$(document).ready(function(){
	CariKode();
	$('.select2').select2({
		width : "100%",
		placeholder : "Pilih Jenis Kelamin"
	});
})
function CariKode(){
	$.ajax({
		type 		: "POST",
		url 		: "<?=site_url('anggota/CariKode')?>",
		dataType	: "JSON",
		success 	: function(data){
			$("#anggota_no").val(data.nomor);
		}
	});
}
</script>