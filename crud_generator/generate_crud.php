<?php

$host="localhost";
$user="root";
$pass="";
$db="ecommerce";

$table=$_GET["table"] ?? "";

if($table==""){
die("Debe indicar tabla: ?table=products");
}

$conn=new mysqli($host,$user,$pass,$db);

if($conn->connect_error){
die("Error conexión");
}

$result=$conn->query("DESC $table");

$fields=[];

while($row=$result->fetch_assoc()){
$fields[]=$row["Field"];
}

$entity=ucfirst($table);
$entitySingular=rtrim($entity,"s");

echo "<h2>Tabla detectada: $table</h2>";

echo "<h3>Campos</h3>";

foreach($fields as $f){
echo $f."<br>";
}

echo "<hr>";

/* ===============================
GENERAR TEMPLATE LISTA
================================*/

$listTemplate="<table border='1'>\n<tr>\n";

foreach($fields as $f){
$listTemplate.="<th>$f</th>\n";
}

$listTemplate.="<th>Acciones</th>\n</tr>\n";

$listTemplate.="{{foreach $table}}\n<tr>\n";

foreach($fields as $f){
$listTemplate.="<td>{{".$f."}}</td>\n";
}

$listTemplate.="<td>\n";
$listTemplate.="<a href='index.php?page=".$entity."_".$entitySingular."&mode=UPD&id={{".$fields[0]."}}'>Editar</a>\n";
$listTemplate.="|\n";
$listTemplate.="<a href='index.php?page=".$entity."_".$entitySingular."&mode=DEL&id={{".$fields[0]."}}'>Eliminar</a>\n";
$listTemplate.="</td>\n";

$listTemplate.="</tr>\n{{endfor $table}}\n</table>";

file_put_contents($entity.".list.tpl",$listTemplate);

echo "✔ plantilla lista generada<br>";

/* ===============================
GENERAR FORMULARIO
================================*/

$formTemplate="<form method='POST'>\n";

foreach($fields as $f){

if($f==$fields[0]){
$formTemplate.="<input type='hidden' name='$f'>\n";
}else{
$formTemplate.="<label>$f</label>\n";
$formTemplate.="<input name='$f'><br>\n";
}

}

$formTemplate.="<button type='submit'>Guardar</button>\n</form>";

file_put_contents($entitySingular.".form.tpl",$formTemplate);

echo "✔ plantilla formulario generada<br>";

/* ===============================
GENERAR MODELO DAO
================================*/

$dao="<?php\n\n";
$dao.="class ".$entity."Dao {\n";

$dao.="public static function getAll(){\n";
$dao.=" // query select\n";
$dao.="}\n";

$dao.="public static function insert(){\n";
$dao.=" // query insert\n";
$dao.="}\n";

$dao.="public static function update(){\n";
$dao.=" // query update\n";
$dao.="}\n";

$dao.="public static function delete(){\n";
$dao.=" // query delete\n";
$dao.="}\n";

$dao.="}\n";

file_put_contents($entity."Dao.php",$dao);

echo "✔ DAO generado<br>";

/* ===============================
GENERAR CONTROLADORES
================================*/

$listController="<?php\n\nclass ".$entity."Controller {\n public function run(){\n }\n}\n";

file_put_contents($entity."Controller.php",$listController);

$formController="<?php\n\nclass ".$entitySingular."Controller {\n public function run(){\n }\n}\n";

file_put_contents($entitySingular."Controller.php",$formController);

echo "✔ controladores generados<br>";

echo "<hr>";
echo "<h3>CRUD generado correctamente</h3>";

?>