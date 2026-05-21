// definición variables
const contactos = [];
const contactosTable = document.getElementById("contactosTb");
const contactoForm = document.forms["contactoForm"];
let contacto_id = null;

//métodos o funciones
const consultarContactos = () => {
  fetch("http://127.0.0.1:8000/contactos")
    .then((response) => response.json())
    .then((body) => {
      body.forEach((item) => {
        contactos.push({
          id: item.id,
          nombre: item.nombre,
          correo: item.email,
          telefono: item.telefono,
        });
      });
      console.log(contactos);
    })
    .catch((error) => console.error("Error en consultar los contactos"))
    .finally(() => console.log("Request finalizado..."));
};

const consultarContactosDos = async () => {
  try {
    if (contactos.length > 0) {
      contactos.splice(0, contactos.length);
    }
    const response = await fetch("http://127.0.0.1:8000/contactos");
    const body = await response.json();
    body.forEach((item) => {
      contactos.push({
        id: item.id,
        nombre: item.nombre,
        correo: item.email,
        telefono: item.telefono,
      });
    });
    mostrarListaContactos();
  } catch (error) {
    console.error("Error en consultar los contactos");
  }
  console.log("Request finalizado...");
};

const modificarContacto = (itemContacto) => {
  contacto_id = itemContacto.id;
  contactoForm['nombre'].value = itemContacto.nombre;
  contactoForm['email'].value = itemContacto.correo;
  contactoForm['telefono'].value = itemContacto.telefono;
  showForm();
}

const mostrarListaContactos = () => {
  const tbody = contactosTable.getElementsByTagName("tbody")[0];
  tbody.innerHTML = "";
  for (let item of contactos) {
    const tr = document.createElement("tr");

    const nombreTd = document.createElement("td");
    nombreTd.textContent = item.nombre;

    const emailTd = document.createElement("td");
    emailTd.textContent = item.correo;

    const telefonoTd = document.createElement("td");
    telefonoTd.textContent = item.telefono;

    const eliminarTd = document.createElement("td");
    const eliminarBtn = document.createElement("button");
    eliminarBtn.textContent = "Eliminar";
    eliminarBtn.addEventListener('click', () => eliminarContacto(item.id));
    eliminarTd.appendChild(eliminarBtn);

    const modificarTd = document.createElement("td");
    const modificarBtn = document.createElement("button");
    modificarBtn.textContent = 'Modificar'
    modificarBtn.addEventListener('click', () => modificarContacto(item));
    modificarTd.appendChild(modificarBtn);

    tr.appendChild(nombreTd);
    tr.appendChild(emailTd);
    tr.appendChild(telefonoTd);
    tr.appendChild(eliminarTd);
    tr.appendChild(modificarTd);

    tbody.appendChild(tr);
  }
};

const registrarContacto = async () => {
  try {
    const contacto = {
      nombre: contactoForm['nombre'].value,
      email: contactoForm['email'].value,
      telefono: contactoForm['telefono'].value
    };
    const response = await fetch('http://127.0.0.1:8000/contacto', {
      headers: {
        'Content-Type': 'application/json'
      },
      method: 'post',
      body: JSON.stringify(contacto)
    });
    const body = await response.json();
    status = response.status
    if (status == 201) {
      //alert('Datos guardado!!');
      showMsg();
      contactos.push({
        id: body.id,
        nombre: body.nombre,
        correo: body.email,
        telefono: body.telefono,
      });
      mostrarListaContactos();
      contactoForm.reset();
    }
  } catch (error) {
    console.error(error);
    console.error("Error al guardar los datos del contacto");
  }
  console.log("Request finalizado...");
};

const editarContacto = async () => {
  try {
    const contacto = {
      nombre: contactoForm['nombre'].value,
      email: contactoForm['email'].value,
      telefono: contactoForm['telefono'].value
    };
    const response = await fetch('http://127.0.0.1:8000/contacto/' + contacto_id, {
      headers: {
        'Content-Type': 'application/json'
      },
      method: 'put',
      body: JSON.stringify(contacto)
    });
    const body = await response.json();
    status = response.status
    if (status == 200) {
      //alert('Datos guardado!!');
      showMsg();
      consultarContactosDos();
      contacto_id = null;
      contactoForm.reset();
    }
  } catch (error) {
    console.error(error);
    console.error("Error al guardar los datos del contacto");
  }
  console.log("Request finalizado...");
}

const eliminarContacto = async (id) => {
  try {
    const response = await fetch('http://127.0.0.1:8000/contacto/' + id, {
      method: 'delete'
    });
    status = response.status
    console.log(status)
    if (status == 200) {
      alert('Datos borrados!!');
      consultarContactosDos();
    }
  } catch (error) {
    console.error(error);
    console.error("Error al borrar los datos del contacto");
  }
  console.log("Request finalizado...");
}
//consultarContactos();
consultarContactosDos();

//eventos

contactoForm.addEventListener('submit', (event) => {
  event.preventDefault();
  // //if (contacto_id != null) {
  // if (contacto_id) {
  //   editarContacto();
  // } else {
  //   registrarContacto();
  // }
  contacto_id ? editarContacto() : registrarContacto();
});


contactoForm.addEventListener('reset', (event) => {
  contacto_id = null;
  hideForm();
});

