// validasi
function validate() {
	var output = true;
	$(".validasi-error").html("");
	if (!$("#nama").val()) {
		output = false;
		$("#nama-error").html("Nama Required!");
	}
	if (!$("#alamat").val()) {
		output = false;
		$("#alamat-error").html("Alamat Required!");
	}
	if (!$("#kecamatan").val()) {
		output = false;
		$("#kecamatan-error").html("Kecamantan Required!");
	}
	if (!$("#jml_anggota").val()) {
		output = false;
		$("#jumlahAnggota-error").html("Jumlah Anggota Required!");
	}
	return output;
}

$(document).ready(function () {
	$("input#submit").click(function (e) {
		var output = validate();
		if (output === true) {
			return true;
		} else {
			//prevent refresh
			e.preventDefault();
		}
	});
});
