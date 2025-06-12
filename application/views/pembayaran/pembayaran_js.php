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
			// CariSaldo(this.value);
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
				// $('#anggota_hp').val(data.anggota_hp);
				$('#id_pinjam').val(data.no_pinjam);
				$('#lama').val(data.lama);
				$('#bunga').val(data.bunga+' %');
				$('#angsuran').val(data.angsuran);
				$('#jumlah').val(data.jumlah);
				$('#sisa_angsuran').val(data.sisa_angsuran_number);
				if(data.lama == 0){
					$("#simpan").attr("disabled",true);
				}else{

					$("#simpan").attr("disabled",false);
					
				}
				view_pinjaman(data.no_pinjam);

					
			}
		});
	}

	function view_pinjaman(isi){
		var nomor = isi; //$("#anggota").val();
		//alert('Info '+nomor);
		$.ajax({
			type	: "POST",
			url		: "<?=site_url('pembayaran/view_bayar')?>",
			data	: "nomor="+nomor,
			success	: function(data){
				$("#view_pinjaman").html(data);
				//alert('info'+nomor);
			}
		});
	}

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