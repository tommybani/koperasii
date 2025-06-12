<script>
	$("#cetak").click(function(){
		var kode 	= $('#noanggota').val();
		var tgl 	= $('#tanggal').val();
		var	pilih	= $(".pilih:checked").val();
		var jml_pilih = $(".pilih:checked");
		
		if(jml_pilih.length == 0){
           var error = true;
           alert("Maaf, Anda belum memilih");
		   //$("#txt_user").focus();
		   return (false);
         }
		if(pilih=='tanggal'){
			window.open("<?php echo base_url();?>laporan/cetak_tunggakan/"+pilih+"/"+tgl);	
		 }else{
			 window.open("<?php echo base_url();?>laporan/cetak_tunggakan/"+pilih+"/"+kode);	
		 }	
	});	
</script>