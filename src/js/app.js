let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3
const cita = {
    Id: '',
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}

document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp(){
    mostrarSeccion(); //Muestra y oculta distintas secciones del proceso de agendar cita
    tabs();//Cambia la seccion cuando se presionen los botones
    botonesPaginador();//Agrega o quita los botones del paginador
    paginaSiguiente();
    paginaAnterior();
    consultarAPI(); //Consulta la API en el nackend de PHP
    idCliente(); 
    nombreCliente()// Guarda el nombr del cliente en el objeto cita
    seleccionarFecha();//agrega la fecha al objeto cita
    seleccionarHora();//agrega la hora al objeto cita
    mostrarResumen();//Muestra resumen de la citacon toda la info agregada en pasos anteriores
}
function mostrarSeccion(){
    // console.log('mostrando seccion');
    //Ocultar Seccion 
    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior){
        seccionAnterior.classList.remove(['mostrar']);
    }
    //Seleccionar seccion con el paso del boton presionado
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector); 
    seccion.classList.add('mostrar');

    //Quita la clase de actual al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if(tabAnterior){
        tabAnterior.classList.remove('actual');
    }

    //Resltar el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
}
function tabs(){
    const botones = document.querySelectorAll('.tabs button');
    botones.forEach(boton => {
        boton.addEventListener('click', function (e) {
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();
            botonesPaginador();
            // if(paso === 3){
            //     mostrarResumen();
            // }
        })
    })
}
function botonesPaginador() {
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');
    
    if(paso === 1) {
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }else if(paso === 3) {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');
        mostrarResumen();
    }else {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }
    mostrarSeccion();
}
function paginaAnterior() {
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function(){
        if(paso <= pasoInicial) return;
        paso--;
        botonesPaginador();
    })
}
function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function(){
        if(paso >= pasoFinal) return;
        paso++;
        botonesPaginador();
    })
}

async function consultarAPI() {
    try {
        const url = `${location.origin}/api/servicios`;
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios(servicios);
    } catch (error) {
        console.log(error);
    }
}

function mostrarServicios(servicios) {
    // console.log(servicios);
    servicios.forEach(servicio => {
        const {Id, nombre, precio} = servicio;

        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `Q.${precio}`;

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = Id;
        servicioDiv.onclick = function() {
            seleccionarServicios(servicio);
        };

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector('#servicios').appendChild(servicioDiv);
    })
}

function seleccionarServicios(servicio){
    const { Id } = servicio;
    const { servicios } = cita;
    cita.servicios = [...servicios, servicio]; //guada en cita. servicios una copia de cita.servicios mas el servicio agregado
    const divServicio = document.querySelector(`[data-id-servicio="${Id}"]`);//identifica al elemento al que se le hace click
    // Comprobar si servicio ya fue agregado o quitarlo
    if( servicios.some(agregado => agregado.Id === Id)){
        cita.servicios = servicios.filter( agregado => agregado.Id !== Id);
        divServicio.classList.remove('seleccionado');
    }else{
        divServicio.classList.add('seleccionado');
    }
    // console.log(cita)
}
function idCliente(){
    const id = document.querySelector('#Id').value;
    cita.Id = id;
}
function nombreCliente(){
    const nombre = document.querySelector('#nombre').value;
    cita.nombre = nombre;
}
function seleccionarFecha(){
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', function(e) {
        const dia = new Date(e.target.value).getUTCDay();
        if ( [6,0].includes(dia)){ // Validacion para no aceptar citas sabados (6) y domingos (0)
            e.target.value = '';
            mostraralerta('Fines de semana no atendemos. Selecciona otra fecha.', 'error','.formulario');
        }else{
            cita.fecha = e.target.value;
        }
        
    })
}
function seleccionarHora(){
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', function(e){
        const horaCita = e.target.value;
        const hora = horaCita.split(":")[0];
        if(hora < 10 || hora > 18) {
            e.target.value = '';
            mostraralerta('Hora no valida. Selecciona otra hora', 'error', '.formulario');
        } else {
            cita.hora = e.target.value;
            // console.log(cita);
        }
    })
}
function mostrarResumen(){
    const resumen = document.querySelector('.contenido-resumen');

    //limpiar contenido de resumen
    while(resumen.firstChild){
        resumen.removeChild(resumen.firstChild);
    }

    if (Object.values(cita).includes('')  || cita.servicios.length === 0){
        mostraralerta('Por favor completa todos los datos del formulario o selecciona por lo menos un servicio. ', 'error','.contenido-resumen', false);
        return;
    } 

    //Formato del dic de resumen
    const titulo1 = document.createElement('H3');
    titulo1.textContent = 'Resumen de la cita';
    resumen.appendChild(titulo1);

    const {nombre, fecha, hora, servicios} = cita;

    const nombreCliente = document.createElement('P');
    nombreCliente.classList.add('resumen-line')
    nombreCliente.innerHTML = `<span>Nombre: </span> ${nombre}`;
    
    // Fomatear fecha en espanol
    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate() + 2;//Le agregue +2 porque cada vez que se crea una instacia new Date la fecha se desfaza un dia
    const year = fechaObj.getFullYear();

    const fechaUTC = new Date(Date.UTC(year, mes, dia))

    const opciones = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
    const fechaFormateada = fechaUTC.toLocaleDateString('es-GT', opciones);
    // console.log(fechaFormateada);
    
    const fechaCita = document.createElement('P');
    fechaCita.classList.add('resumen-line')
    fechaCita.innerHTML = `<span>Fecha: </span> ${fechaFormateada}`;

    const horaCita = document.createElement('P');
    horaCita.classList.add('resumen-line')
    horaCita.innerHTML = `<span>Hora: </span> ${hora}`;

    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);

    const titulo = document.createElement('H3');
    titulo.innerHTML = `<span>Servicios:</span>`;
    resumen.appendChild(titulo);

    servicios.forEach(servicio => {
        const {Id, precio, nombre} = servicio;

        const contenedorServicio = document.createElement('DIV');
        contenedorServicio.classList.add('contenedor-servicio')

        const textoServicio = document.createElement('P');
        textoServicio.textContent = nombre;

        // const precioServicio = document.createElement('P');
        // precioServicio.innerHTML = `<span>Precio: </span> Q.${precio}`;

        contenedorServicio.appendChild(textoServicio);
        // contenedorServicio.appendChild(precioServicio);
        
        resumen.appendChild(contenedorServicio);

        
    })
    //Boton para crear la cita 
    const botonReservar = document.createElement('BUTTON');
    botonReservar.classList.add('boton');
    botonReservar.textContent = 'Reservar cita';
    botonReservar.onclick = reservarCita;
    resumen.appendChild(botonReservar);
    
}

async function reservarCita() {
    const { nombre, fecha, hora, servicios, Id} = cita;
    const idServicios = servicios.map( servicio => servicio.Id );
    

    const datos = new FormData();
    // datos.append('nombre', 'Emanuel');

    datos.append('usuarioId', Id);
    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('servicios', idServicios);
    
    
    // 
    // console.log(datos);
    // console.log([...datos]);

    // Peticion a la API
    try {
        const url = `${location.origin}/api/citas`
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();
        if(resultado.resultado) {
            Swal.fire({
                icon: 'success',
                title: 'Felicidades',
                text: 'Tu cita esta agendada',
            }).then( () => {
                    window.location.reload();
            })
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Algo salio mal, vuelve a intentarlo mas tarde',
        }).then( () => {
                window.location.reload();
        })
    }
    

    // console.log(respuesta);
    // console.log([...datos])//Sintaxis para ver lo que hay dentor de data
}

function mostraralerta(mensaje, tipo, elemento, desaparece = true) {
    //previene que se genere mas de una alerta
    const alertaPrevia = document.querySelector('.alerta');
    if(alertaPrevia){
        alertaPrevia.remove();
    }

    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);

    //eliminar la alerta
    if(desaparece){
        setTimeout(() => {
            alerta.remove();
        }, 4000);
    } 
    
}
