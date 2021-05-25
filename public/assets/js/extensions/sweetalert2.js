var swalConfirm = function(e, el) {
  e.preventDefault()
  let form = el.parentNode

    Swal.fire({
        title: "Apakah kamu yakin?",
        text: "Data ini akan terhapus",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#4fbe87",
        cancelButtonColor: "#d65656",
        confirmButtonText: "Ya",
        cancelButtonText: "Tidak",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit()
        }
    });
}
