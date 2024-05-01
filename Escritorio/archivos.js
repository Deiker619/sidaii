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