<?php
set_time_limit(0);
class lagdenXmlTask extends sfBaseTask
{
    protected function configure()
    {
        $this->namespace        = 'lagden';
        $this->name             = 'xml';
        $this->briefDescription = 'Pega o XML de carga e gera um YAML';
        $this->detailedDescription = <<<EOF
The [lagden:ftp|INFO] task does things.
Call it with:
    [php symfony lagden:ftp|INFO]
EOF;
    }
    
    protected function execute($arguments = array(), $options = array())
    {
        $ds=DIRECTORY_SEPARATOR;
        $rootdir=sfConfig::get('sf_root_dir');
        $tmp="{$rootdir}{$ds}tmp{$ds}";
        $breno="/home/breno/";
        
        // Vai para o diretório tmp do app
        chdir($tmp);
        // Remove todos os arquivos XML e YML
        exec('rm -f *.xml *.yml *.log');
        
        // Vai para o diretório /home/breno
        chdir($breno);
        
        // Localiza e converte todos os arquivos xml baixados
        $itens = glob("{$breno}{*.xml}",GLOB_BRACE);
        $carga = array();
        $cc = -1;
        if($itens)
        {
            foreach($itens as $item)
            {
                if(is_file($item) && (basename($item)=="microsistec_carga.xml"))
                {
                    // Pega o conteudo do XML
                    $content = file_get_contents($item);
                    if($content)
                    {
                        $cc = 0;
                        // Transforma o XML em JSON
                        $parse=Xml2json::transformXmlStringToJson($content);
                        $obj=json_decode($parse);
                        $attr="@attributes";
                        $valorCond="Valor_Cond.";
                        $infoComp="Info_Compl.";
                        foreach($obj->Carga->Imovel as $k=>$imovel)
                        {
                            $carga[$cc]['titulo']="{$imovel->Tipo_Imovel} em {$imovel->Endereco->Cidade} no bairro {$imovel->Endereco->Bairro}";
                            $carga[$cc]['referencia']=isset($imovel->Codigo) ? $imovel->Codigo : null;
                            if(isset($imovel->$infoComp))
                            {
                                $carga[$cc]['area_util']=isset($imovel->$infoComp->Area_Util) ? $imovel->$infoComp->Area_Util : null;
                                $carga[$cc]['area_total']=isset($imovel->$infoComp->Area_Total) ? $imovel->$infoComp->Area_Total : null;
                                $carga[$cc]['iptu']=isset($imovel->$infoComp->Valor_IPTU) ? $imovel->$infoComp->Valor_IPTU : null;
                                $carga[$cc]['condominio']=isset($imovel->$infoComp->$valorCond) ? $imovel->$infoComp->$valorCond : null;
                                $carga[$cc]['price_sale']=isset($imovel->$infoComp->Valor_Venda) ? $imovel->$infoComp->Valor_Venda : null;
                                $carga[$cc]['price_rent']=isset($imovel->$infoComp->Valor_Locacao) ? $imovel->$infoComp->Valor_Locacao : null;
                            }
                            if(isset($imovel->Composicao))
                            {
                                $carga[$cc]['suites']=isset($imovel->Composicao->Suites) ? $imovel->Composicao->Suites : null;
                                $carga[$cc]['empregadas']=isset($imovel->Composicao->Dep_Empregada) ? $imovel->Composicao->Dep_Empregada : null;
                                $carga[$cc]['quartos']=isset($imovel->Composicao->Dormitorios) ? $imovel->Composicao->Dormitorios : null;
                                $carga[$cc]['banheiros']=isset($imovel->Composicao->Banheiros) ? $imovel->Composicao->Banheiros : null;
                                $carga[$cc]['vagas']=isset($imovel->Composicao->Vagas_Garagem) ? $imovel->Composicao->Vagas_Garagem : null;
                            }
                            //Descrição
                            $descricaoTmp = array();
                            foreach($imovel->Descricao as $v)
                            {
                                if($v)$descricaoTmp[]=$v;
                            }
                            $carga[$cc]['descricao']=join(' - ',$descricaoTmp);
                            $descricaoTmp = null;
                            //
                            $carga[$cc]['ativo']=($imovel->Situacao == 'LIVRE') ? 1 : 0;
                            $carga[$cc]['carga']=json_encode($imovel);
                            $carga[$cc]['is_carga']=1;
                            $carga[$cc]['neighborhood_id']=array('cidade'=>$imovel->Endereco->Cidade,'bairro'=>$imovel->Endereco->Bairro);
                            $carga[$cc]['type_id']="{$imovel->Tipo_Imovel}";
                            $carga[$cc]['Disponibilidades']="{$imovel->Disponibilidade}";
                            $carga[$cc]['Images']=isset($imovel->fotoG) ? $imovel->fotoG : null;
                            $carga[$cc]['updated_at']=Utils::toMysql($imovel->Data_Alteracao);
                            $cc++;
                        }
                    }
                }
            }
        }
        
        // Vai para o diretório root/
        chdir($rootdir);
        
        // Se o contador for maior que -1, significa que houve parser
        if($cc > -1)
        {
            // Gera yml do arquivo de carga
            file_put_contents("{$tmp}carga.yml",sfYaml::dump($carga),LOCK_EX);
            file_put_contents("{$tmp}carga.log","[".date('c')."][xml  ] Arquivo de carga gerado com sucesso. \n",FILE_APPEND);
        }
        else
        {
            file_put_contents("{$tmp}carga.log","[".date('c')."][xml  ] Nenhum arquivo de carga foi gerado. \n",FILE_APPEND);
        }
        die;
    }
}
