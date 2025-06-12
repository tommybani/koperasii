<script>

	$(document).ready(function(){
		$('.select2').select2({
			width : "100%",
			placeholder : "Pilih Anggota"
		});

		$('.jenis').select2({
			width : "100%",
			placeholder : "Pilih Jenis Simpanan"
		});

		$('#anggota_no').change(function(){
			CariAnggota(this.value);
		})
	})
	

	

	$('.jenis').change(function(){
		$.ajax({
			url 	: "<?=site_url('simpanan/GetJumlah')?>",
			type 	: "POST",
			dataType: "JSON",
			data 	: {id_jenis : this.value},
			success : function(data){
				$('[name="jumlah"]').val(formatRupiah(data.jumlah, 'Rp. '));
			}
 		})
	})

	function CariAnggota(isi){
		var nomor = isi; //$("#anggota").val();
		//alert('Info '+nomor);
		$.ajax({
			type	: "POST",
			url		: "<?=site_url('api/json')?>",
			data	: "nomor="+nomor,
			dataType: "json",
			cache	: false,
			success	: function(data){
				$('#no_identitas').val(data.anggota_no_identitas);
				$('#nama_anggota').val(data.anggota_nama);
				$('#anggota_jk').val(data.anggota_jk);
				$('#anggota_hp').val(data.anggota_hp);
				// $('#hp').val(data.hp);
				$('#sisa_angsuran').val(data.sisa_angsuran);
				if(data.sisa_angsuran>0){
					$("#simpan").attr("disabled",true);
				}else{
					$("#simpan").attr("disabled",false);
				}
					
			}
		});
	}

	var rupiah = document.getElementById('rupiah');
	rupiah.addEventListener('keyup', function(e){
		// tambahkan 'Rp.' pada saat form di ketik
		// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
		rupiah.value = formatRupiah(this.value, 'Rp. ');
	});

	function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
</script>