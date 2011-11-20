<?php
$title="Amplo apartamento com 3 dormitorios em higienopolis";
$description="APARTAMENTO REFORMADISSIMO!! Excelente Localização, Rua tranquila e arborizada, Predio recuado, portaria 24 horas, Frete, Face Norte, arejado, Janelões, pé direito alto, Amplo Living para 3 ambientes, porcelanato, 3 dormitorios sendo 1 suite com Hidro, closet, cozinha planejada, copa, area de serviço!!!! Venha conhecer!!!";
while($i){
    $title="{$title} Amplo apartamento com 3 dormitorios em higienopolis";
    $i--;
}
?>
<article>
    <div class="efeito">
        <a href="#"><?php echo image_tag('tmp/286.jpg',array('alt'=>$title)); ?></a>
        <header>
            <h3><a href="#"><?php echo $title ?></a></h3>
            <p><a href="#" class="brenoTips" title="<?php echo $description ?>"><?php echo $description ?></a></p>
        </header>
        <table>
            <tbody>
                <tr>
                    <td>Código</td>
                    <td><a href="#">327</a></td>
                </tr>
                <tr>
                    <td>Tipo</td>
                    <td>Apartamento</td>
                </tr>
                <tr>
                    <td>Disponível</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Quartos</td>
                    <td>3</td>
                </tr>
                <tr>
                    <td>Vagas</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>Área útil</td>
                    <td>230</td>
                </tr>
                <tr>
                    <td>Valor</td>
                    <td>R$ 1.150.000,00</td>
                </tr>
            </tbody>
        </table>
        <footer>
            <a href="/works/breno/show/amplo-apartamento-com-3-dormitorios-em-higienopolis" class="btn orange">+ Fotos e Detalhes</a>
        </footer>
    </div>
</article>