<script>
$(document).ready(function(){
	$('.select2').select2({
		width : "100%",
		placeholder : "Pilih Anggota"
	});
	$('.lama').select2({
		width : "100%",

	});

	$('#anggota_no').change(function(){
		CariAnggota(this.value);
	})
	CariKode();

})
function oke(jumlah){
	var angka = jumlah.replace(/[^\d]/g, '');
	var simpanan = parseInt(angka*10/100);
	var biaya_admin =  parseInt(angka*10/100);
	var jumlah_diterima = parseInt(angka-simpanan-biaya_admin);

	$('#rupiah2').val('Rp.'+biaya_admin);
	$('#rupiah3').val('Rp.'+simpanan);
	$('#rupiah4').val('Rp.'+jumlah_diterima);

}
function CariKode(){
	$.ajax({
		type	: "POST",
		url		: "<?=site_url('pinjaman/carikode')?>",
		dataType: "json",
		cache	: false,
		success	: function(data){
			$('[name="id_pinjam"]').val(data.nomor);
		}
	});
}
function CariAnggota(isi){
		var nomor = isi; //$("#anggota").val();
		//alert('Info '+nomor);
		$.ajax({
			type	: "POST",
			url		: "<?=site_url('pinjaman/carianggota')?>",
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
	var rupiah2 = document.getElementById('rupiah2');
	var rupiah3 = document.getElementById('rupiah3');
	var rupiah4 = document.getElementById('rupiah4');

	rupiah.addEventListener('keyup', function(e){
		rupiah.value = formatRupiah(this.value, 'Rp. ');
	});

	rupiah2.addEventListener('keyup', function(e){
		rupiah2.value = formatRupiah(this.value, 'Rp. ');
	});

	rupiah3.addEventListener('keyup', function(e){
		rupiah3.value = formatRupiah(this.value, 'Rp. ');
	});

	rupiah4.addEventListener('keyup', function(e){
		rupiah4.value = formatRupiah(this.value, 'Rp. ');
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