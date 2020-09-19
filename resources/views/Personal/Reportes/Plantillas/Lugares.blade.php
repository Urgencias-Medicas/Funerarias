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
      <th scope="col">Lugar</th>
    </tr>
  </thead>
  <tbody>
    @foreach($Casos as $caso)
    <tr>
      <td>{{$caso->Nombre}}</td>
      <td>
      @if(!$caso->Lugar)
        En su hogar
      @else
        {{$caso->Lugar}}
      @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
