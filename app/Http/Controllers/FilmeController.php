<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use App\Responses\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FilmeController extends Controller
{
    public function criar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:200',
            'anoDeLancamento' => 'required|integer',
            'diretor'=> 'required|string|max:150'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $customer = Filme::create($request->all());
        return JsonResponse::success('Filme criado com sucesso!', $customer);
    }
    public function listarTodos()
    {
        $customers = Filme::all();
        return JsonResponse::success(data: $customers);
    }

    public function listarPeloId($id)
    {
        $customer = Filme::findOrFail($id);
        return JsonResponse::success('Filme listado pelo ID com sucesso!', $customer);
    }


    public function editar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:200',
            'anoDeLancamento' => 'required|integer',
            'diretor'=> 'required|string|max:150'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $customer = Filme::findOrFail($id);
        $customer->update($request->all());

        return JsonResponse::success('Filme editado com sucesso!', $customer);
    }

    public function excluir($id)
    {
        $customer = Filme::findOrFail($id);
        $customer->delete();
        return response()->json([
            'status' => true,
            'message' => 'Filme deletado com sucesso'
        ], 204);
    }
}
