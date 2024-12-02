<?php
require ("config_db.php");
session_start();
session_destroy();
header(header: "Location: pagina_cursos.html");
?>