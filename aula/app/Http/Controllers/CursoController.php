<?php

namespace App\Http\Controllers;

use App\CursoModel;

use App\NivelModel;

use Request;

class CursoController extends Controller {

	public function listar() {

		// $cursos = DB::select('SELECT * FROM curso_models');
		$cursos = CursoModel::all();
		$niveis = NivelModel::all();
		return view('curso')->with('cursos', $cursos)->with('niveis', $niveis);
	}

	public function cadastrar() {

		$niveis = NivelModel::orderBy('id')->get();

		return view('cursoCadastrar')->with('niveis', $niveis);
	}

	public function editar($id) {
        // Filtra parâmetro para garantir que é um número
        if(is_numeric($id)) {

            $curso = CursoModel::find($id);

            // Verifica se existe um curso com o 'id' recebido por parâmetro
            if(empty($curso)) {
                return "<h2>[ERRO]: Curso não encontrado para o ID=".$id."!</h2>";
            }

            $niveis = NivelModel::orderBy('id')->get();
            return view('cursoEditar')->with('curso', $curso)->with('niveis', $niveis);
        }
        else {
            return "<h2>[ERRO]: Parâmetro Inválido!</h2>";
        }
	}

	public function salvar($id) {

		// INSERT
		if ($id == 0) {
			$objCursoModel = new CursoModel();
			$objCursoModel->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
			$objCursoModel->abreviatura = mb_strtoupper(Request::input('abreviatura'), 'UTF-8');
			// Obtém Id Nivel
			$arr = explode(" ", Request::input('nivel'));
			$objCursoModel->id_nivel = $arr[0];
			// Fim
			$objCursoModel->tempo = Request::input('tempo');
			;
			$objCursoModel->ativo = 1;

			$objCursoModel->save();
		}
		// UPDATE
		 else {

            $objCursoModel = CursoModel::find($id);

            // Verifica se existe um curso com o 'id' recebido por parâmetro
            if(empty($objCursoModel)) {
                return "<h2>[ERRO]: Curso não encontrado para o ID=".$id."!</h2>";
            }

            $objCursoModel->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
            $objCursoModel->abreviatura = mb_strtoupper(Request::input('abreviatura'), 'UTF-8');
            // Obtém Id Nivel
            $arr = explode(" ", Request::input('nivel'));
            $objCursoModel->id_nivel = $arr[0];
            // Fim
            $objCursoModel->tempo = Request::input('tempo');
            // Obtém Ativo/Inativo
            $ativo = Request::input('ativo');
            if (strcmp($ativo, "ATIVO") == 0) { $objCursoModel->ativo = 1; }
            else { $objCursoModel->ativo = 0; }

            $objCursoModel->save();
        }

        return redirect()->action('CursoController@listar')->withInput();
	}

	public function remover($id) {
        if(is_numeric($id)) {

            $curso = CursoModel::find($id);

            if(empty($curso)) {
                    return "<h2>[ERRO]: Curso não encontrado para o ID=".$id."!</h2>";
            }

            return view('cursoRemover')->with("curso", $curso);
        }

        return "<h2>[ERRO]: Parâmetro Inválido!</h2>";
	}

	public function confirmar($id) {
        $objCursoModel = CursoModel::find($id);

        if(empty($objCursoModel)) {
                return "<h2>[ERRO]: Curso não encontrado para o ID=".$id."!</h2>";
        }

        $objCursoModel->delete();

        return redirect()->action('CursoController@listar');
	}
}
