<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::insert('INSERT INTO aluno_models(nome, curso, turma) VALUES(?,?,?)',
        array('João Paulo França','TADS','TADS18'));
       /* DB::insert('INSERT INTO aluno_models(nome, curso, turma) VALUES(?,?,?)',
        array('Thiago Ephigenio da Costa','TADS','TADS16'));     
        DB::insert('INSERT INTO curso_models(nome, abreviatura, id_nivel, ativo) VALUES(?,?,?)',
        array('ANÁLISE E DESENVOLVIMENTO DE SISTEMAS','TDAS', 1)); */
        DB::insert('INSERT INTO nivel_models(nome, abreviatura) VALUES(?,?)',
        array('Bacharel - Graduação','Ensino Superior'));  
    }
}
