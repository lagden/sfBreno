<div class="grid_4 showDouble">
    <h3>Interessou?</h3>
    <hr/>
    <?php include_component('estate', 'Contato'); ?>
</div>
<div class="grid_4 showDouble">
    <h2><?php echo $estate->titulo ?></h2>

    <h3>Referência</h3>
    <hr/>
    <p><b><?php echo "{$estate->Type->name} - Cód. {$estate->referencia}" ?></b></p>

    <h3><?php echo "Bairro - {$estate->Neighborhood->name}" ?></h3>
    <hr/>
    <p><?php echo "{$estate->descricao}" ?></p>

    <h3><?php echo "Sobre o imóvel" ?></h3>
    <hr/>
    <table>
        <tbody>
            <?php foreach ($lista as $k => $v): ?>
                <tr>
                    <td><?php echo $v ?></td>
                    <td>
                        <?php if ($k=="iptu" || $k=="condominio"): ?>
                            R$ <?php echo number_format($estate->$k, 2, ',', '.'); ?>
                        <?php else: ?>
                            <?php echo $estate->$k ?>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <?php if ($estate->Complementos->count()>0): ?>
        <h3>Características do imóvel</h3>
        <hr/>
        <ul>
            <?php foreach($estate->Complementos as $complemento): ?>
                <li><?php echo $complemento->name; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif ?>

    <h3>Valor</h3>
    <hr/>
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
            <p><b><?php echo $label; ?>: R$ <?php echo $value; ?></b></p>
        <?php endif ?>
    <?php endforeach ?>
</div>
