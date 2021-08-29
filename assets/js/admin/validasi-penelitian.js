// validasi
function validate() {
	var output = true;
	$(".validasi-error").html("");
	if (!$("#nomerSurat").val()) {
		output = false;
		$("#nomorSurat-error").html(" Nomor Surat Harus Diisi!");
	}
	if (!$("#tembusan1").val()) {
		output = false;
		$("#tembusan-error").html(" Tembusan Harus Diisi!");
	}
	return output;
}

$(document).ready(function () {
	$("input#unduh").click(function (e) {
		var output = validate();
		if (output === true) {
			return true;
		} else {
			//prevent refresh
			e.preventDefault();
		}
	});
});
