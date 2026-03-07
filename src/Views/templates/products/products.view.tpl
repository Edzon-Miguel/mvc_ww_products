<h1>Trabajar con Productos</h1>

<form method="get" action="index.php">
<input type="hidden" name="page" value="Products_Products">

Nombre
<input type="text" name="partialName" value="{{partialName}}">

Estado
<select name="status">
<option value="">Todos</option>
<option value="ACT">Activo</option>
<option value="INA">Inactivo</option>
</select>

<button type="submit">Filtrar</button>

</form>

<br>

<a href="index.php?page=Products_Product&mode=INS">
Nuevo Producto
</a>

<br><br>

<table border="1" width="100%">

<thead>

<tr>
<th>ID</th>

<th>Nombre</th>

<th>Descripción</th>

<th>Precio</th>

<th>Estado</th>

<th>Acciones</th>

</tr>

</thead>

<tbody>

{{foreach products}}

<tr>

<td>{{productId}}</td>

<td>
<a href="index.php?page=Products_Product&mode=DSP&productId={{productId}}">
{{productName}}
</a>
</td>

<td>{{productDescription}}</td>

<td>{{productPrice}}</td>

<td>{{productStatusDsc}}</td>

<td>

<a href="index.php?page=Products_Product&mode=UPD&productId={{productId}}">
Editar
</a>

|

<a href="index.php?page=Products_Product&mode=DEL&productId={{productId}}">
Eliminar
</a>

</td>

</tr>

{{endfor products}}

</tbody>

</table>