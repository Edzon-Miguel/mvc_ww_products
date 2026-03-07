<table border='1'>
<tr>
<th>productId</th>
<th>productName</th>
<th>productDescription</th>
<th>productPrice</th>
<th>productImgUrl</th>
<th>productStatus</th>
<th>Acciones</th>
</tr>
{{foreach products}}
<tr>
<td>{{productId}}</td>
<td>{{productName}}</td>
<td>{{productDescription}}</td>
<td>{{productPrice}}</td>
<td>{{productImgUrl}}</td>
<td>{{productStatus}}</td>
<td>
<a href='index.php?page=Products_Product&mode=UPD&id={{productId}}'>Editar</a>
|
<a href='index.php?page=Products_Product&mode=DEL&id={{productId}}'>Eliminar</a>
</td>
</tr>
{{endfor products}}
</table>