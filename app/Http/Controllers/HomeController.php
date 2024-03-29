<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Notificaciones;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Funerarias;
use App\DetallesFuneraria;
use App\DocumentosFuneraria;
use App\DetallesDeFuneraria;
use App\InfoFunerariasRegistradas;
use PDF;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        if($user->hasRole('Agente')){
            return redirect('/Casos/vistaCrear');
        }elseif($user->hasRole('Personal')){
            return redirect('/Personal/Reportes/Graficas');
        }elseif($user->hasRole('Funeraria')){
            return redirect('/Funerarias/Casos/ver');
        }elseif($user->hasRole('Super Admin')){
            return view('Admin.home');
        }elseif($user->hasRole('Contabilidad')){
            return redirect('/Casos/ver');
        }elseif($user->hasRole('CHN')){
            return redirect('/Casos/ver');
        }
    }
    public function funerariaInactiva(){
        $user = auth()->user();
        $funeraria = $user->funeraria;
        $estado_funeraria = Funerarias::where('Funeraria_Registrada', $funeraria)->value('Activa');
        $detalle = DetallesFuneraria::find($user->detalle);
        $url = "https://gist.githubusercontent.com/tian2992/7439705/raw/1e5d0a766775a662039f3a838f422a1fc1600f74/guatemala.json";

        $tipo_funeraria = $user->tipo_funeraria;

        $licenciaAmbiental = DetallesDeFuneraria::where('Funeraria', $user->id)->where('Campo', 'LicenciaAmbiental')->value('Estado');
        $infoGeneral = DetallesDeFuneraria::where('Funeraria', $user->id)->where('Campo', 'InfoGeneral')->value('Estado');
        $documentacion = DetallesDeFuneraria::where('Funeraria', $user->id)->where('Campo', 'Documentacion')->value('Estado');
        $convenio = DetallesDeFuneraria::where('Funeraria', $user->id)->where('Campo', 'Convenio')->value('Estado');
        $alldocuments = DocumentosFuneraria::where('Funeraria', $user->id)->get();

        $json = file_get_contents($url);
        if($estado_funeraria != 'Si'){
            return view('Funerarias.Inactiva', ['Activa' => $estado_funeraria, 'Detalle' => $detalle, 'Json' => $json, 'InfoGeneral' => $infoGeneral, 'LicenciaAmbiental' => $licenciaAmbiental, 'Documentacion' => $documentacion, 'Convenio' => $convenio, 'Tipo_Funeraria' => $tipo_funeraria, 'AllDocuments' => $alldocuments]);
        }else{
            return redirect('/Funerarias/Casos/ver');
        }
    }
    public function guardarMedia($media, Request $request){
        $user = auth()->user();
        $image = $request->file('file');
        if($media == 'licenciaAmbiental'){
            $imageName = 'Funeraria-'.$user->id.'-licenciaAmbiental.'.$image->getClientOriginalExtension();
            DetallesDeFuneraria::create(['Funeraria' => $user->id, 'Campo' => 'LicenciaAmbiental', 'Estado' => 'Pendiente']);
        }elseif($media == 'patenteComercio'){
            $imageName = 'Funeraria-'.$user->id.'-patenteComercio.'.$image->getClientOriginalExtension();
        }elseif($media == 'rtu'){
            $imageName = 'Funeraria-'.$user->id.'-rtu.'.$image->getClientOriginalExtension();
        }elseif($media == 'licenciaSanitaria'){
            $imageName = 'Funeraria-'.$user->id.'-licenciaSanitaria.'.$image->getClientOriginalExtension();
        }elseif($media == 'dpi'){
            $imageName = 'Funeraria-'.$user->id.'-dpi.'.$image->getClientOriginalExtension();
        }elseif($media == 'certManipulacionCuerpos'){
            $imageName = 'Funeraria-'.$user->id.'-certManipulacionCuerpos.'.$image->getClientOriginalExtension();
        }elseif($media == 'licManipulacionCuerpos'){
            $imageName = 'Funeraria-'.$user->id.'-licManipulacionCuerpos.'.$image->getClientOriginalExtension();
        }elseif($media == 'manipulacionAlimentos'){
            $imageName = 'Funeraria-'.$user->id.'-manipulacionAlimentos.'.$image->getClientOriginalExtension();
        }elseif($media == 'bioinfecciosos'){
            $imageName = 'Funeraria-'.$user->id.'-bioinfecciosos.'.$image->getClientOriginalExtension();
        }elseif($media == 'Convenio'){
            $imageName = 'Funeraria-'.$user->id.'-Convenio.'.$image->getClientOriginalExtension();
        }

        $upload_success = $image->move(public_path('images'),$imageName);
        if ($upload_success) {
            Notificaciones::create(['funeraria' => NULL, 'contenido' => 'Se subió el archivo '.$media.' de la funeraria '.$user->name, 'estatus' => 'Activa']);
            $documento_existe = DocumentosFuneraria::where('Funeraria', $user->id)->where('Documento', $media)->first();
            if($documento_existe){
                DocumentosFuneraria::where('Funeraria', $user->id)->where('Documento', $media)->update(['Ruta' => '/images/'.$imageName, 'Estatus' => null]);    
            }else{
                DocumentosFuneraria::create(['Funeraria' => $user->id, 'Documento' => $media, 'Ruta' => '/images/'.$imageName, 'Estatus' => null]);
            }
            return response()->json($upload_success, 200);
        }
        // Else, return error 400
        else {
            return response()->json('error', 400);
        }
    }
    public function guardarInfo(Request $request){
        $user = auth()->user();

        User::where('id', $user->id)->update(['tipo_funeraria' => $request->tipo_funeraria]);

        DetallesDeFuneraria::updateOrCreate(['Funeraria' => $user->id, 'Campo' => 'TipoFuneraria', 'Valor' => $request->tipo_funeraria]);
        DetallesDeFuneraria::updateOrCreate(['Funeraria' => $user->id, 'Campo' => 'NIT', 'Valor' => $request->nit]);
        DetallesDeFuneraria::updateOrCreate(['Funeraria' => $user->id, 'Campo' => 'Telefono', 'Valor' => $request->telefono]);
        DetallesDeFuneraria::updateOrCreate(['Funeraria' => $user->id, 'Campo' => 'Direccion', 'Valor' => $request->direccion]);
        DetallesDeFuneraria::updateOrCreate(['Funeraria' => $user->id, 'Campo' => 'Departamento', 'Valor' => strtoupper($request->departamento)]);
        DetallesDeFuneraria::updateOrCreate(['Funeraria' => $user->id, 'Campo' => 'NombreContacto', 'Valor' => $request->nombre_contacto]);
        DetallesDeFuneraria::updateOrCreate(['Funeraria' => $user->id, 'Campo' => 'TelContacto', 'Valor' => $request->numero_contacto]);

        DetallesDeFuneraria::updateOrCreate(['Funeraria' => $user->id, 'Campo' => 'InfoGeneral', 'Estado' => 'Pendiente']);
        DetallesDeFuneraria::updateOrCreate(['Funeraria' => $user->id, 'Campo' => 'Documentacion', 'Estado' => 'Denegado']);

        return back();

    }

    public function guardarInfoFuneraria($id, Request $request){
        //DetallesDeFuneraria::where('Funeraria', $id)->where('Campo', 'TipoFuneraria')->update(['Funeraria' => $id, 'Campo' => 'TipoFuneraria', 'Valor' => $request->tipo_funeraria]);
        DetallesDeFuneraria::firstOrNew(['Funeraria' => $id, 'Campo' => 'TipoFuneraria'], ['Valor' => $request->tipo_funeraria]);
        //DetallesDeFuneraria::where('Funeraria', $id)->where('Campo', 'NIT')->update(['Funeraria' => $id, 'Campo' => 'NIT', 'Valor' => $request->nit]);
        DetallesDeFuneraria::firstOrCreate(['Funeraria' => $id, 'Campo' => 'NIT'], ['Valor' => $request->nit]);
        //DetallesDeFuneraria::where('Funeraria', $id)->where('Campo', 'Telefono')->update(['Funeraria' => $id, 'Campo' => 'Telefono', 'Valor' => $request->telefono]);
        DetallesDeFuneraria::firstOrCreate(['Funeraria' => $id, 'Campo' => 'Telefono'], ['Valor' => $request->telefono]);
        //DetallesDeFuneraria::where('Funeraria', $id)->where('Campo', 'Direccion')->update(['Funeraria' => $id, 'Campo' => 'Direccion', 'Valor' => $request->direccion]);
        DetallesDeFuneraria::firstOrCreate(['Funeraria' => $id, 'Campo' => 'Direccion'], ['Valor' => $request->direccion]);
        //DetallesDeFuneraria::where('Funeraria', $id)->where('Campo', 'Departamento')->update(['Funeraria' => $id, 'Campo' => 'Departamento', 'Valor' => strtoupper($request->departamento)]);
        //DetallesDeFuneraria::where('Funeraria', $id)->where('Campo', 'NombreContacto')->update(['Funeraria' => $id, 'Campo' => 'NombreContacto', 'Valor' => $request->nombre_contacto]);
        DetallesDeFuneraria::firstOrCreate(['Funeraria' => $id, 'Campo' => 'NombreContacto'], ['Valor' => $request->nombre_contacto]);
        //DetallesDeFuneraria::where('Funeraria', $id)->where('Campo', 'TelContacto')->update(['Funeraria' => $id, 'Campo' => 'TelContacto', 'Valor' => $request->numero_contacto]);
        DetallesDeFuneraria::firstOrCreate(['Funeraria' => $id, 'Campo' => 'TelContacto'], ['Valor' => $request->numero_contacto]);

        $id_funeraria = Funerarias::where('Id_Funeraria', $id)->value('Funeraria_Registrada');

        InfoFunerariasRegistradas::where('id', $id_funeraria)->update(['direccion' => $request->direccion, 'tel_contacto' => $request->telefono, 'tel_coordinador' => $request->numero_contacto, 'tipo' => $request->tipo_funeraria]);

        return back();
        //return DetallesDeFuneraria::updateOrCreate(['Funeraria' => $id, 'Campo' => 'TipoFuneraria', 'Valor' => $request->tipo_funeraria]);
    }
    public function quitarNotificacion($id){
        $notificacion = Notificaciones::find($id);
        $notificacion->estatus = 'Inactiva';
        $notificacion->save();
        echo 'Hecho';
    }
    public function notificaciones(){
        $user = auth()->user();
        if($user->hasRole('Personal')){
            $notificaciones = Notificaciones::where('funeraria', NULL)->orderBy('id', 'DESC')->get();
        }elseif($user->hasRole('Funeraria')){
            $notificaciones = Notificaciones::where('funeraria', $user->funeraria)->orderBy('id', 'DESC')->get();
        }
        return view('General.notificaciones', ['Notificaciones' => $notificaciones]);
    }

    public function cambioPassword(){
        return view('General.cambioPassword');
    }
    public function verificarPassword($password){
        $user = auth()->user();
        $current_password = $user['password'];
        if(Hash::check($password, $current_password)){
            return true;
        }else{
            return false;
        }
    }
    public function guardarPassword(Request $request){
        $user = auth()->user();
        $id = $user['id'];
        User::where("id", $id)->update(['Password' => Hash::make($request->newPassword)]);
        return redirect("/home");
    }
    public function cambioMail(){
        return view('General.changemail');
    }
    public function verificarMail($mail){
        $mail_find = User::where('email', $mail)->get();
        if($mail_find->isEmpty()){
            return true;
        }else{
            return false;
        }
    }
    public function guardarMail(Request $request){
        $user = auth()->user();
        $id = $user['id'];
        User::where("id", $id)->update(['Email' => $request->mail]);
        return redirect("/home");
    }

    public function generarConvenio(){
        $user = auth()->user();
        $direccion = DetallesDeFuneraria::where('Funeraria', $user->id)->where('Campo', 'Direccion')->value('Valor');
        $departamento = DetallesDeFuneraria::where('Funeraria', $user->id)->where('Campo', 'Departamento')->value('Valor');
        $nit = DetallesDeFuneraria::where('Funeraria', $user->id)->where('Campo', 'NIT')->value('Valor');
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('Personal.Reportes.Plantillas.Convenio', ['direccion' => $direccion, 'nombre' => $user->name, 'departamento' => $departamento, 'nit' => $nit])->setPaper('a4', 'portrait');
        return $pdf->download('Convenio.pdf');
    }
    public function generarConvenioFuneraria($id){
        $user = User::where('id', $id)->get()->first();

        $direccion = DetallesDeFuneraria::where('Funeraria', $user->id)->where('Campo', 'Direccion')->value('Valor');
        $departamento = DetallesDeFuneraria::where('Funeraria', $user->id)->where('Campo', 'Departamento')->value('Valor');
        $nit = DetallesDeFuneraria::where('Funeraria', $user->id)->where('Campo', 'NIT')->value('Valor');
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('Personal.Reportes.Plantillas.Convenio', ['direccion' => $direccion, 'nombre' => $user->name, 'departamento' => $departamento, 'nit' => $nit])->setPaper('a4', 'portrait');
        return $pdf->download('Convenio.pdf');
    }
    public function devolverFunerarias(){
        $funerarias = InfoFunerariasRegistradas::where('estado', 'Activo')->get();

        return $funerarias;
    }
}
