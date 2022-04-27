import Swal from "sweetalert2";
const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success mr-2',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  })
window.confirmDelete = (id) =>{
    swalWithBootstrapButtons.fire({
        title: '¿Esta seguro que desea borrar este registro?',
        showCancelButton: true,
        icon: 'warning',
        confirmButtonText: 'Si, borrar',
        cancelButtonText: 'Cancelar',
      }).then((result) => {
        if(result.isConfirmed){
            const params = {id}
            axios.post(`/productos/${id}`, {params, _method: 'delete'})
            .then(response => {
                // console.log(response);
                Swal.fire({
                    title : "Receta Eliminada",
                    text : "Se eliminó la receta",
                    icon : "success"
                })
                buscarProductos()
            })
        }
     
      })
}
