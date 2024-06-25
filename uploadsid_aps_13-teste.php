<?php        
        try {

            $this->begin_transaction();
            $this->autocommit(false);

            $diasSemana                                     = ['0' => 'Domingo', '1' => 'Segunda-feira', '2' => 'Terça-feira', 
                                                               '3' => 'Quarta-feira', '4' => 'Quinta-feira', '5' => 'Sexta-feira',
                                                               '6' => 'Sabado'];
                                                            
            $dias               =   $dados['control']->dias;
            $firstDayOfWeek     =   date('Y-m-d', strtotime("this week"));
            $dayOfWeek          =   date('N', strtotime($firstDayOfWeek)); 
            $data_hora          =   date('Y-m-d', strtotime($firstDayOfWeek . '+7 days'));

        if($dados['control']->typeControl == 1)
        {

            foreach($dias as $values)
                {

                    unset($today);

                    $today = ($today + $values - 1);

                    $dados['agendamento']->data_hora_agendamento= date('Y-m-d H:i:s', strtotime($firstDayOfWeek . '+'.$today.' days'));
                    $dados['agendamento']->diaSemana = $values;
                    $dados['agendamento']->data_registro = Carbon::now()->format('Y-m-d H:i:s');
                    
                    $sql = $this->insert($dados['agendamento'], "tb_agenda");
                    $query = $this->query($sql) or die($this->error);
                    $id_agenda = $this->insert_id;

                    $id_documento = $dados['control']->id_documento;

                    $sql_agenda = "INSERT INTO tb_agenda_documento VALUES('',$id_documento, $id_agenda)";
                    $query_agenda = $this->query($sql_agenda) or die($this->error);
                }   

                    $this->commit();

                    return (array("msg" => "Agendamento efetuado com sucesso!", 'status' => TRUE, 'data'=>array()));
        } else {
                        
                $today = $dados['agendamento']->data_hora_agendamento;
                $diaSemana = date('N', strtotime($today));
                $dados['agendamento']->data_registro = Carbon::now()->format('Y-m-d H:i:s');

                $sql = $this->insert($dados['agendamento'], "tb_agenda");
                $query = $this->query($sql) or die($this->error);
                $id_agenda = $this->insert_id;

                $id_documento = $dados['control']->id_documento;

                $sql_agenda = "INSERT INTO tb_agenda_documento VALUES('',$id_documento, $id_agenda)";
                $query_agenda = $this->query($sql_agenda) or die($this->error);
                    
                $this->commit();

             return (array("msg" => "Agendamento efetuado com sucesso!", 'status' => TRUE, 'data'=>array()));
            
        }    

        } catch (mysqli_exception $e) {
            
            return (array("msg" => "Agendamento não realizado!", 'status' => FALSE, 'data'=>array()));
        
    }