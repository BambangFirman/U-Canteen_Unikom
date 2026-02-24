function confirmDialogLogout(){
    document.getElementById('btn-logout').addEventListener('click', function (){
    event.preventDefault();
        swal({
          title: "Kamu yakin mau logout?",
          text: "",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("Bye, Sampai ketemu lagi nanti", {
              icon: "success",
            })
            .then(() => {
                document.getElementById("logout-form").submit();
            });

          } else {
            swal("Huft, Senang sekali kamu tetap setia disini");
          }
        });
    })
}

confirmDialogLogout()

