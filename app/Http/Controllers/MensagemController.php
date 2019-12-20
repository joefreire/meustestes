<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mensagem;
use Session;
use Auth;
use DB;

class MensagemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }
    /**
     * Recebe informações do Mensagem.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getData(Request $request)
    {

        //Pega as ultimas mensagens de cada remetente
        $remetentes = Mensagem::with('remetente')->where('destinatario_id',Auth::id())
        ->select(DB::raw('*, max(id) as last_id'))
        ->orderBy('last_id','DESC')
        ->groupBy('remetente_id')
        ->get();
        if(!empty($request->remetente)){
            //quando passado o remente as mensagens que retornaram sao dele
            $ultimoRemetente = $request->remetente;
        }else{
            $ultimoRemetente = $remetentes->first()->remetente_id;
        }

        //Pega todas as mensagens enviadas ou recebidas do usuario logado para o ultimo remetente
        $mensagens = Mensagem::with('remetente')
        ->where(function ($query) use ($ultimoRemetente) {
            $query->where('destinatario_id', Auth::id())
                  ->where('remetente_id', $ultimoRemetente);
        })->orWhere(function ($query) use ($ultimoRemetente) {
            $query->where('remetente_id', Auth::id())
                  ->where('destinatario_id', $ultimoRemetente);
        })
        ->orderBy('created_at','ASC')
        ->get();

        $data = array('mensagens' => $mensagens, 'remetentes' => $remetentes);


        if($request->wantsJson()){
            return response()->json($data);
        }
        return view('chat.index')->with('data',$data);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('mensagens.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Session::forget('_old_input');
        return view('mensagens.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'destinatario_id' => 'required',
            'mensagem' => 'required',
        ]);
        $mensagens = Mensagem::create([
            'remetente_id' => Auth::id(),
            'destinatario_id' => $request->destinatario_id,
            'mensagem' => $request->mensagem,
        ]);
        if($request->wantsJson()){
            return response()->json(['success' => true]);
        }
        else{
            return redirect()->route('mensagens.index')->with('success','Criado com sucesso');
        }


    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mensagens = Mensagem::find($id);
        if(!empty($mensagens)){
            $mensagens->delete();
        }else{
            return redirect()->route('mensagens.index')->with('error','Erro ao deletar');
        }
        return redirect()->route('mensagens.index')->with('success','Deletado com sucesso');
    }

}
