<?php
/********************************** Ciencia da Informação - thesa */
$class = 'City';
echo 'Cidades'.cr();
$uf = array('sp','sc','rs','pr','es','sp','rj','pe','mg');
$uf_name = array('São Paulo','Santa Catarina','Rio Grande do Sul','Paraná','Espirito Santo','São Paulo','Rio de Janeiro','Pernanbuco','Minas Gerais');
for ($q=0;$q < count($uf);$q++)
    {  
    $file2 = '../.csv/cidade-'.$uf[$q].'.csv';

    $handle = fopen($file2, "r");
    $row = 0;

    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $line = troca($line,'"','');
            $line = troca($line,';',',');
            $line = utf8_encode($line);
            
            $fd = splitx(',',$line);

            if ($row == 0)
                {
                    $hd = array();
                    for ($r=1;$r < count($fd);$r++)
                        {
                            $hd[$r] = $fd[$r];
                        }
                } else {                
                    $dt = array();
                    $name = $ws->trata($fd[0]);
                    $dt['skos:prefLabel'] = trim($fd[0]);
                    $dt['skos:hasCityState'] = trim($uf_name[$q]);
                    $dt['Class'] = $class;               
                    for ($r=1;$r < count($fd);$r++)
                        {
                            $dt[$hd[$r]] = $fd[$r];
                        }
                    $ws->save($dt, $name,$force);                
                }
                $row++;
        }
        fclose($handle);
    } else {
        echo "Erro ao ler o arquivo ".$file2;
    }
}