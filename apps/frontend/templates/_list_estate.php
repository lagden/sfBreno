<?php $qs=array('slug'=>$estate->slug); ?>
<article>
    <div class="efeito">
        <?php echo link_to(image_tag('tmp/p'.((rand()%2)?1:2).'.jpg',array('alt'=>$estate->titulo)),'estate_show',$qs,array('class'=>'img')); ?>
        <header>
            <h3><?php echo link_to("{$estate->titulo}",'estate_show',$qs); ?></h3>
            <p><?php echo link_to("{$estate->descricao}",'estate_show',$qs,array('class'=>'brenoTips','title'=>$estate->descricao)); ?></p>
        </header>
        <table>
            <tbody>
                <tr>
                    <td>Código</td>
                    <td><?php echo $estate->referencia ?></td>
                </tr>
                <tr>
                    <td>Tipo</td>
                    <td><?php echo $estate->Type->name ?></td>
                </tr>
                <tr>
                    <td>Disponível</td>
                    <td><?php echo $estate->joinDisponibilidades ?></td>
                </tr>
                <tr>
                    <td>Bairro</td>
                    <td><?php echo $estate->Neighborhood->name ?></td>
                </tr>
                <tr>
                    <td>Suítes</td>
                    <td><?php echo $estate->suites ?></td>
                </tr>
                <tr>
                    <td>Quartos</td>
                    <td><?php echo $estate->quartos ?></td>
                </tr>
                <tr>
                    <td>Vagas</td>
                    <td><?php echo $estate->vagas ?></td>
                </tr>
                <tr>
                    <td>Área útil</td>
                    <td><?php echo $estate->area_util ?></td>
                </tr>
                <?php foreach ($estate->Disponibilidades as $d): ?>
                    <?php
                    $label="";
                    $value="";
                    switch($d->id)
                    {
                        case 1:
                        $label="Valor para compra";
                        $value="{$estate->ValorVenda}";
                        break;
                        
                        case 2:
                        $label="Valor para locação";
                        $value="{$estate->ValorAluga}";
                        break;
                        
                        default:
                        $label=$value=false;
                    }
                    ?>
                    <?php if ($label && $value): ?>
                        <tr>
                            <td><?php echo $label; ?></td>
                            <td>R$ <?php echo $value; ?></td>
                        </tr>
                    <?php endif ?>
                <?php endforeach ?>
            </tbody>
        </table>
        <footer>
            <?php echo link_to("+ Fotos e Detalhes",'estate_show',$qs,array('class'=>'btn orange')); ?>
        </footer>
    </div>
</article>