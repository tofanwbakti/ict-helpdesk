const flashData = $(".flash-data").data("flashdata");
if (flashData) {
	Swal.fire({
		icon: "success",
		title: "Good Job...",
		text: "The process is  " + flashData,
		showConfirmButton: false,
		timer: 3000,
	});
}

const flashLoginOK = $(".flashOkLogin").data("flashdata");
if (flashLoginOK) {
	Swal.fire({
		icon: "success",
		title: "Access Granted",
		text: "Your login " + flashLoginOK,
		showConfirmButton: false,
		timer: 2000,
	});
}
