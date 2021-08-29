// validasi
function validate() {
	var output = true;
	$(".validasi-error").html("");
	if (!$("#nama").val()) {
		output = false;
		$("#nama-error").html("Nama Required!");
	}
	if (!$("#kecamatan").val()) {
		output = false;
		$("#kecamatan-error").html("Kecamantan Required!");
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
