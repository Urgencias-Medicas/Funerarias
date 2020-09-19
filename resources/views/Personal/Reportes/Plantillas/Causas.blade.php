<style>
td{
    text-align: center;
}
</style>
<div class="container">
<table class="table" width="100%">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Causa</th>
    </tr>
  </thead>
  <tbody>
    @foreach($Casos as $caso)
    <tr>
      <td>{{$caso->Nombre}}</td>
      <td>{{$caso->Causa}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
