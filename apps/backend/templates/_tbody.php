<?php
// foreach ($itens as $v):
// print_r($v->id);
// endforeach;
// echo $lastId;
// die;
?>

<?php foreach ($itens as $item): ?>
    <?php if($lastId==$item->id): ?>
    <tr class="set">
    <?php else: ?>
    <tr>
    <?php endif; ?>
    
    <?php foreach ($fields['names'] as $name): ?>
        <?php
        if($name=='id')
        {
            echo '<td class="center">';
            $editar=link_to(image_tag('icons/edit.png',array('class' => 'tips', 'title'=>'Ação', 'rel'=>'Editar')), $actions['edit'], array('id' => $item->$name));
            echo "{$editar}";
        }
        else
        {
            if(isset($fields['xtras'][$name]) && $fields['xtras'][$name]['class']) echo '<td class="'.$fields['xtras'][$name]['class'].'">';
            else echo '<td>';
            
            if(isset($fields['xtras'][$name]) && $fields['xtras'][$name]['decode']) $item->getRaw($name); //echo htmlspecialchars_decode($item->$name);
            else echo $item->$name;
        }
        ?>
        </td>
    <?php endforeach; ?>
    </tr>
<?php endforeach; ?>
