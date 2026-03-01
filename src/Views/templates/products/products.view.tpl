<h1>Trabajar con Productos</h1>

<form method="get" action="index.php">
  <input type="hidden" name="page" value="Products_Products">

  Nombre:
  <input type="text" name="partialName" value="{{partialName}}">

  Estado:
  <select name="status">
    <option value="">Todos</option>
    <option value="ACT">Activo</option>
    <option value="INA">Inactivo</option>
  </select>

  <button type="submit">Filtrar</button>
</form>

<br>

<table border="1" width="100%">
  <thead>
    <tr>
      <th><a href="index.php?page=Products_Products&orderBy=productId">ID</a></th>
      <th><a href="index.php?page=Products_Products&orderBy=productName">Nombre</a></th>
      <th>Descripción</th>
      <th><a href="index.php?page=Products_Products&orderBy=productPrice">Precio</a></th>
      <th>Estado</th>
    </tr>
  </thead>
  <tbody>
    {{foreach products}}
    <tr>
      <td>{{productId}}</td>
      <td>{{productName}}</td>
      <td>{{productDescription}}</td>
      <td>{{productPrice}}</td>
      <td>{{productStatusDsc}}</td>
    </tr>
    {{endfor products}}
  </tbody>
</table>