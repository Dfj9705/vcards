import { line } from 'laravel-mix/src/Log';
import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';


const Modal = () => {
    const [cotizaciones, setCotizaciones] = useState();
    const traerCotizaciones = async () => {
        const url = "/cotizaciones";
        const config = {method: 'GET'};
        try {
            const response = await fetch(url, config);
            const data = await response.json();
            
            setCotizaciones(data)
            
        } catch (error) {
            console.log(error);
        }
    }

    useEffect(() => {
        traerCotizaciones();
    },[])
    return (
        <div className="modal fade" id="storeModal" tabIndex="-1" role="dialog">
            <div className="modal-dialog" role="document">
                <div className="modal-content">
                <div className="modal-header">
                    <h5 className="modal-title">Cotizaciones</h5>
                    <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div className="modal-body">
                    <ul>
                        { 
                            !cotizaciones ? 
                            'Cargando' :  
                            cotizaciones.map((cotizacion, index)=>{
                                return <li key={cotizacion.id}>{cotizacion.fecha}</li>
                            })
                        }
                    </ul>
                   
                    
                </div>
                <div className="modal-footer">
                    <button type="button" className="btn btn-primary">Save changes</button>
                    <button type="button" className="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
    );
}

export default Modal;

if (document.getElementById('modal')) {
    ReactDOM.render(<Modal />, document.getElementById('modal'));
}
