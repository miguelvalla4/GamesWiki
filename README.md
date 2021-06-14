# Backoffice coding task

Este es el proyecto de la prueba técnica para el equipo de Backoffice.

---

### Requisitos

- [Docker](https://www.docker.com)

### Construcción

```bash
make build
```

Este comando ejecutará la construcción de la imagen e instalará las dependencias de [Composer](https://getcomposer.org).

### Levantar el sitio web

```bash
make up
```

Con este comando se inicia el servidor de desarrollo de PHP, sirviendo en [0.0.0.0:8080](0.0.0.0:8080). **Asegúrate de
no tener ningún otro servicio ocupando dicho puerto.**

### Pruebas

```bash
make test
```

Usando este comando se pueden ejecutar todas las pruebas que se encuentren dentro de `app/test`. Existen otras tareas
dentro del Makefile para procesar la cobertura o realizar pruebas mutantes.

---

Si quieres más información acerca de qué tareas existen en el Makefile, solo tienes que ejecutar `make help`.
