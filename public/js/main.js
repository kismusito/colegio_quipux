function mostrarAlerta(type , titulo , texto) {   
    Swal.fire({
        type: type,
        title: titulo,
        text: texto
    })
}

document.getElementById('delete').onclick = function(e){
    if( !confirm('Estas seguro de eliminar la materia?') ) {
        e.preventDefault();
    }
}