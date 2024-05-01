








//Parte añadida para recorrer por el sistema operativo
// Primero, seleccionamos el botón de subida de archivos en lugar del input
const uploadButton = document.querySelector(".btn-warning");

// Luego, escuchamos el evento de cambio en el input de tipo file que está dentro del botón
uploadButton.querySelector('input[type="file"]').addEventListener("change", (e) => {
  const files = Array.from(e.target.files);
  const validFileTypes = ['application/pdf', 'image/jpeg', 'image/png', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  if(!validFileTypes.includes(el.type)) {
    alert("Tipo de archivo no permitido. Por favor, selecciona un archivo PDF, JPG, PNG, Word, PowerPoint o Excel.");
    return;
  }
  files.forEach(el => progressUpload(el));
});



const upload = document.querySelector(".upload");
const texto_upload = upload.querySelector("#texto_upload");
const body_upload = upload.querySelector(".upload_body")
const upload_buttom = upload.querySelector(".upload_buttom");
const input = upload.querySelector("#upload_input");



const uploader = (file) => {
    const xhr = new XMLHttpRequest();
    const formData = new FormData();
  
    formData.append("file", file);
  
    xhr.addEventListener("readystatechange", e => {
      if (xhr.readyState !== 4) return;
  
      if (xhr.status >= 200 && xhr.status < 300) {
        let json = JSON.parse(xhr.responseText)
      } else {
        let message = xhr.statusText || "Ocurrió un error";
        console.log(`Error ${xhr.status}: ${message}`);
      }
    })
    xhr.open("POST", "uploader/uploader.php");
    xhr.setRequestHeader("enc-type", "multipart/form-data");
    xhr.send(formData);
  }



upload.addEventListener("dragleave", (e) =>{
    body_upload.classList.remove("active")
    texto_upload.textContent = "Arrastra archivo para cargar"
  /*   console.log("dragLeave") */
});


upload.addEventListener("dragover", (e) =>{
    e.preventDefault()
    body_upload.classList.add("active")
    texto_upload.textContent = "Suelta el archivo"
 /*    console.log("Dragover") */

});



upload.addEventListener("drop", (e) =>{
    e.preventDefault()
    e.stopPropagation()
    body_upload.classList.remove("active");
    texto_upload.textContent = "Arrastra archivo para cargar";
    console.log("drop")
    const files = Array.from(e.dataTransfer.files);
    files.forEach(el => progressUpload(el) )
    
    
    
})


const progressUpload = (file)=> {
  // Verificar el tamaño del archivo
  if(file.size > 5 * 1024 * 1024) { // 5MB
    alert("El archivo es demasiado grande. Por favor, selecciona un archivo que no sea superior a 5MB.");
    return;
  }

  const $progress = document.createElement("progress");
  const $span = document.createElement("span");

  $progress.value = 0;
  $progress.max = 100;

  body_upload.insertAdjacentElement("beforeend", $progress);
  body_upload.insertAdjacentElement("beforeend", $span);

  const fileReader = new FileReader();
  fileReader.readAsDataURL(file);

  fileReader.addEventListener("progress", e => {
    let progress = parseInt((e.loaded * 100) / e.total);
    $progress.value = progress;
    $span.innerHTML = `${file.name} - ${progress}%`;
  });

  fileReader.addEventListener("loadend", e => {
    uploader(file);
    setTimeout(() => {
      body_upload.removeChild($progress);
      body_upload.removeChild($span);
    }, 2000);
  });

  
}

uploadButton.querySelector('input[type="file"]').addEventListener("change", (e) => {
  const files = Array.from(e.target.files);
  files.forEach(el => {
    // Verificar el tipo de archivo
    const validFileTypes = ['application/pdf', 'image/jpeg', 'image/png', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
    if(!validFileTypes.includes(el.type)) {
      alert("Tipo de archivo no permitido. Por favor, selecciona un archivo PDF, JPG, PNG, Word, PowerPoint o Excel.");
      return;
    }

    progressUpload(el);
  });
});



 


 