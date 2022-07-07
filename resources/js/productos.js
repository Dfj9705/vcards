import Swal from "sweetalert2";
const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success mr-2',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  })
window.confirmDelete = (id, recurso) =>{
    swalWithBootstrapButtons.fire({
        title: '¿Esta seguro que desea borrar este registro?',
        showCancelButton: true,
        icon: 'warning',
        confirmButtonText: 'Si, borrar',
        cancelButtonText: 'Cancelar',
      }).then((result) => {
        if(result.isConfirmed){
            const params = {id}
            axios.post(`/${recurso}/${id}`, {params, _method: 'delete'})
            .then(response => {
                // console.log(response);
                Swal.fire({
                    title : "Registro eliminado",
                    text : "Se eliminó el registro",
                    icon : "success"
                }).then( (result) => {
                  if(result){
                    switch (recurso) {
                      case 'productos':
                        buscarProductos()
            
                        break;
                      case 'cotizacion':
                        location.reload();
            
                        break;
                    
                      default:
                        break;
                    }

                  }
                })
            })
        }
     
      })
}

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

window.Toast = Toast;
