<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DAOaps extends Model
{
    use HasFactory;
    protected $table = "tb_aps";

    public static function getDadosCr(){

        return DB::table('tb_aps')
                ->join('tb_status', 'tb_status.id', '=', 'tb_aps.status_id')
                ->select('tb_aps.*', 'tb_status.status')
                ->get();        
    }
    public static function getDadosAps($cnes){

        return DB::table('tb_aps')
                ->join('tb_status', 'tb_status.id', '=', 'tb_aps.status_id')
                ->select('tb_aps.*', 'tb_status.status')
                ->where('tb_aps.cnes','=', $cnes)
                ->get();        
    }
    public static function getDadosCap($cap){

        return DB::table('tb_aps')
                ->join('subpav_principal.unidades', 'tb_aps.cnes', '=', 'subpav_principal.unidades.COD_UB')
                ->select('tb_aps.*', 'subpav_principal.unidades.TIPO_UNID')
                ->where('subpav_principal.unidades.DIST_SANIT','=', $cap)
                ->get();        
    }
    public static function getDadosId($id_aps){

        return self::where('tb_aps.id','=', $id_aps)->with('anexos', 'mensagens')->get();                    
    }
    public static function update_aps($dados)
    {
        DB::table('tb_aps')
        ->where('id', $dados['id'])
        ->update([
            "cid_id"                                  => $dados['cid_id'],
            "codigo_cid"                              => $dados['codigo_cid'],
            "procedimento_id"                         => $dados['procedimento_id'],
            "codigo_procedimento"                     => $dados['codigo_procedimento'],
            "cns_paciente"                            => $dados['cns_paciente'],
            "cpf_paciente"                            => $dados['cpf_paciente'],
            "cns_principal_paciente"                  => $dados['cns_principal_paciente'],
            "crm_medico_responsavel"                  => $dados['crm_medico_responsavel'],
            "data_nasc_paciente"                      => $dados['data_nasc_paciente'],
            "email_unidade"                           => $dados['email_unidade'],
            "sexo_paciente"                           => $dados['sexo_paciente'],
            "genero_paciente"                         => $dados['genero_paciente'],
            "medico_responsavel"                      => $dados['medico_responsavel'],
            "nome_paciente"                           => $dados['nome_paciente'],
            "nome_social_paciente"                    => $dados['nome_social_paciente'],
            "profissional_solicitante"                => $dados['profissional_solicitante'],
            "cpf_solicitante"                         => $dados['cpf_solicitante'],
            "resultados_exames"                       => $dados['resultados_exames'],
            "tipo_telefone_medico_responsavel"        => $dados['tipo_telefone_medico_responsavel'],
            "telefone_medico_responsavel"             => $dados['telefone_medico_responsavel'],
            "tipo_telefone_profissional_solicitante"  => $dados['tipo_telefone_profissional_solicitante'],
            "telefone_profissional_solicitante"       => $dados['telefone_profissional_solicitante'],
            "tipo_telefone_unidade"                   => $dados['tipo_telefone_unidade'],
            "telefone_unidade"                        => $dados['telefone_unidade'],
            "unidade_solicitante"                     => $dados['unidade_solicitante'],
            "ap"                                      => $dados['ap'],
            "cnes"                                    => $dados['cnes'],
            "status_id"                               => $dados['status_id'],
            "hipotese_diagnostica"                    => $dados['hipotese_diagnostica'],
            "historia_clinica"                        => $dados['historia_clinica'],
            "medicacao_em_uso"                        => $dados['medicacao_em_uso'],
            "justificativa"                           => $dados['justificativa'],
            "pa"                                      => $dados['pa'],
            "fc"                                      => $dados['fc'],
            "temperatura"                             => $dados['temperatura'],
            "peso"                                    => $dados['peso'],
            "fr"                                      => $dados['fr'],
            "timestamp"                               => $dados['timestamp'],
            "codigo_ser"                              => $dados['codigo_ser'],
            "tipo_finalizacao"                        => $dados['tipo_finalizacao'],
            "finalizado_por"                          => $dados['finalizado_por'],
            "especialidade"                           => $dados['especialidade'],
            "alterado_por"                            => $dados['alterado_por'],
            "alterado_em"                             => $dados['alterado_em'],
            "ativo"                                   => $dados['ativo'],
            "exame_hiv"                               => $dados['exame_hiv'],
            "email_medico_responsavel"                => $dados['email_medico_responsavel'],
            "tipo_demanda"                            => $dados['tipo_demanda'],
            "finalizacao"                             => $dados['finalizacao']
        ]);
    }

    public static function finaliza_aps($dados){
        
        $tipo_finalizacao       = $dados['tipo_finalizacao'];
        $finalizadoPor          = "05307377797";
        $id_aps                 = $dados['id_aps'];
        $dados['alterado_por']  = $finalizadoPor;
        $alteradoEm             = date("Y-m-d H:i:s");

        $sqlFinalizaAps = "UPDATE internacao_aps.tb_aps 
                            SET status_id= 3, 
                            tipo_finalizacao = $tipo_finalizacao, 
                            finalizado_por = '$finalizadoPor',
                            alterado_por = '$finalizadoPor',
                            alterado_em = '$alteradoEm'
                            where id = $id_aps";

        if(DB::update($sqlFinalizaAps)){
            return true;
        }
        return false;
    }

    public static function insertAps($dados){

        $sqlInserAps = DB::table('tb_aps')->insert([
            "cid_id"                                    => $dados['cid_id'],
            "codigo_cid"                                => $dados['codigo-cid'],
            "cns_paciente"                              => $dados['cns_paciente'],
            "cns_principal_paciente"                    => $dados['cns_principal_paciente'],
            "crm_medico_responsavel"                    => $dados['crm_medico_responsavel'],
            "data_nasc_paciente"                        => $dados['data_nasc_paciente'],
            "email_unidade"                             => $dados['email_unidade'],
            "sexo_paciente"                             => $dados['sexo_paciente'],
            "genero_paciente"                           => $dados['genero_paciente'],
            "medico_responsavel"                        => $dados['medico_responsavel'],
            "nome_paciente"                             => $dados['nome_paciente'],
            "nome_social_paciente"                      => $dados['nome_social_paciente'],
            "procedimento_id"                           => $dados['procedimento_id'],
            "profissional_solicitante"                  => $dados['profissional_solicitante'],
            "resultados_exames"                         => $dados['resultados_exames'],
            "tipo_telefone_medico_responsavel"          => $dados['tipo_telefone_medico_responsavel'],
            "telefone_medico_responsavel"               => $dados['telefone_medico_responsavel'],
            "tipo_telefone_profissional_solicitante"    => $dados['tipo_telefone_profissional_solicitante'],
            "telefone_profissional_solicitante"         => $dados['telefone_profissional_solicitante'],
            "tipo_telefone_unidade"                     => $dados['tipo_telefone_unidade'],
            "telefone_unidade"                          => $dados['telefone_unidade'],
            "unidade_solicitante"                       => $dados['unidade_solicitante'],
            "ap"                                        => $dados['ap'],
            "cnes"                                      => $dados['cnes'],
            "status_id"                                 => $dados['status_id'],
            "hipotese_diagnostica"                      => $dados['hipotese_diagnostica'],
            "historia_clinica"                          => $dados['historia_clinica'],
            "justificativa"                             => $dados['justificativa'],
            "pa"                                        => $dados['pa'],
            "fc"                                        => $dados['fc'],
            "temperatura"                               => $dados['temperatura'],
            "peso"                                      => $dados['peso'],
            "fr"                                        => $dados['fr'],
            "codigo_ser"                                => $dados['codigo_ser'],
            "tipo_finalizacao"                          => $dados['tipo_finalizacao']
        ]);

        if($sqlInserAps == true){
            return true;
        }
        return false;
        
    }

    public function anexos(): HasMany { 

        return $this->hasMany(DAOanexos::class, 'id_aps', 'id');
    }
    
    public function mensagens(): HasMany { 

        return $this->hasMany(DAOmensagens::class, 'id_aps', 'id');
    }
}
