import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import interactionPlugin from '@fullcalendar/interaction';
import Swal from "sweetalert2";


window.renderCalendar = (element, data) =>{
    // alert('hola')
    console.log(data);
    let calendar = new Calendar(element, {
        plugins: [ dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin  ],
        initialView: 'dayGridMonth',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,listWeek'
        },
        events : data,
        eventClick: function(info) {
            console.log(info.event);
            Swal.fire({
              title: info.event.title, 
              text: info.event.usuario,
              confirmButtonText : "Finalizar"
            } ).then((result)=>{
              if(result.isConfirmed){
                // console.log(info.event.id);
                const params = {id: info.event.id}
                axios.post(`/cotizaciones/finalizar/${info.event.id}`, {params, _method: 'PUT'})
                .then(response => {
                  // console.log(response);
                  Swal.fire({
                    title : "Evento Finalizado",
                    text : "Se finalizó el evento",
                    icon : "success"
                  })
                  // console.log(response.data);
                  renderCalendar(document.getElementById('calendar'), response.data)
                })
              }
            })
        }
      });

      calendar.render();
}