<script>
	$("#cetak").click(function(){
		var kode 	= $('#noanggota').val();
		var	pilih	= $(".pilih:checked").val();
		var jml_pilih = $(".pilih:checked");
		
		if(jml_pilih.length == 0){
           var error = true;
           alert("Maaf, Anda belum memilih");
		   //$("#txt_user").focus();
		   return (false);
         }
		window.open("<?php echo base_url();?>laporan/cetak_anggota/"+pilih+"/"+kode);	
	});	
</script>