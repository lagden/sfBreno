<style>
body{
    margin-left: 0px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
    color: #333333;
    font-family: Verdana, Geneva, sans-serif; font-size: 10px;
}

a:hover{text-decoration: underline;}
a:link{text-decoration: none;}
a:visited{text-decoration: none;}
a:active{text-decoration: none;}
</style>
<body bgcolor="#FFFFFF" text="#333333" link="#333333" vlink="#333333" alink="#333333" style="color: #333333; margin-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; font-family: Verdana, Geneva, sans-serif; font-size: 10px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td align="center" valign="top">
                    <table width="600" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td>
                                    <div><?php echo link_to(image_tag('BrenoHomaraBlack.png',array('alt'=>'','absolute'=>true)),'homepage',array(),array('absolute'=>true)); ?></div>
                                    <h2 style="color:#F28510;"><?php echo $post['nome'] ?> quer disponibilizar um imóvel.</h2>
                                    <p>Eu gostaria de:<br><b><?php echo $post['disponibilidade']; ?> um imóvel</b></p>
                                    <p><b>Dados do Contato</b></p>
                                    <p>Nome:<br><?php echo $post['nome']; ?></p>
                                    <p>E-mail:<br><?php echo mail_to($post['email'],$post['email']); ?></p>
                                    <p>Telefone:<br><?php echo $post['telefone']; ?></p>
                                    <p><b>Informações do imóvel</b></p>
                                    <p>Tipo:<br><?php echo $post['tipo']; ?></p>
                                    <p>Bairro:<br><?php echo $post['bairro']; ?></p>
                                    <p>Quartos:<br><?php echo $post['quartos']; ?></p>
                                    <p>Suítes:<br><?php echo $post['suites']; ?></p>
                                    <p>Banheiros:<br><?php echo $post['banheiros']; ?></p>
                                    <p>Vagas:<br><?php echo $post['vagas']; ?></p>
                                    <p>Valor:<br><?php echo $post['valor']; ?></p>
                                    <p>Descrição:</p>
                                    <pre><?php echo $post['descricao']; ?></pre>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
