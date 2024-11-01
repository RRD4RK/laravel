<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Explorador;
use App\Models\item;

use Illuminate\Http\JsonResponse;

class ExploradorController extends Controller
{
    public function store(Request $request):JsonResponse {
        $explorer= $request->validate([
            'name' =>['required', 'string', 'max:255'],
            'idade'=>['required', 'integer', 'max:122'],
            'latitude'=>['required', 'numeric'],
            'longitude'=>['required', 'numeric'],
            'inventario'=>['nullable','string','max:255'],
        ]);

        $explorador= Explorador::create($explorer);

        return response()->json([
            'message'=>'explorador criado com sucesso!',
            'explorador'=> $explorador,
        ]);
    }


    public function update(Request $request, $id):JsonResponse {
        $request->validate([
            'latitude'=>['required', 'numeric'],
            'longitude'=>['required','numeric'],
        ]);

        $explorador = explorador::findOrFail($id);

        $explorador->latitude = $request->latitude;
        $explorador->longitude = $request->longitude;
        $explorador->save();

        return response()->json([
            'message'=>'Localização Atualizada',
            'explorador'=>$explorador,
        ]);
    }

    public function adicionarItem(Request $request, $explorador_id):JsonResponse{
        $request->validate([
            'nome'=>['required','string', 'max:255'],
            'valor' =>['required', 'numeric'],
            'latitude'=>['required', 'numeric'],
            'longitude'=>['required', 'numeric'],
        ]);

        $item= item::create([
            'explorador_id'=> $explorador_id,
            'nome'=>$request->nome,
            'valor'=>$request->valor,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude
        ]);

        return response()->json([
            'message'=>'item criado com sucesso!',
            'item'=> $item,
        ]);
    }

    public function trocarItens(Request $request):JsonResponse{
        $troca = $request->validate([
            'esxplorador1_id'=>['required', 'exists:expplorers,id'],
            'explorador2_id'=>['required', 'exists:explorers,id' ],
            'item_explorador1'=>['required', 'exist:items,id'],
            'item_explorador2'=>['required', 'existe:items,id'],
        ]);

        $explorador1_id = explorador::find($request->explorador1_id);
        $explorador2_id = explorador::find($request->explorador2_id);
        $itemExplorador1 = item::find($request->item_explorador1);
        $itemExplorador2 = item::find($request->item_explorador2);

        if($itemExplorador1->explorador_id !== $explorador1_id->id){
            return response()->json(['error'=>'item não pertence ao Explorador 1.'],);
        };

        if ($itemExplorador2->explorador_id !== $explorador2_id->id) {
            return response()->json(['error' => 'Item não pertence ao Explorador 2.'], );
        }


        if ($itemExplorador1->valor !== $itemExplorador2->valor) {
            return response()->json(['error' => 'Os items devem ter o mesmo valor.'], );
        }

        $itemExplorador1->explorador_id = $explorador2_id->id;
        $itemExplorador2->explorador_id = $explorador1_id->id;
        $itemExplorador1->save();
        $itemExplorador2->save();

        return response()->json([
            'message' => 'Trocado com sucesso!',
            'explorador1' => [
                'id' => $explorador1_id->id,
                'nome' => $explorador1_id->name,
                'item_trocado' => $itemExplorador1,
            ],
            'explorador2' => [
                'id' => $explorador2_id->id,
                'nome' => $explorador2_id->name,
                'item_trocado' => $itemExplorador2,
            ],
        ]);



    }

    
}
