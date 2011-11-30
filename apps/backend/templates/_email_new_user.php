<p>Olá <b><?php echo $user->fullname ?></b></p>
<p>Você foi cadastrado no Portal de Sustentabilidade e está recebendo uma senha inicial.</p>
<p>Para este primeiro acesso clique no link: <?php echo preg_replace('/(backend.php\/)/','',link_to('Portal de Sustentabilidade', 'homepage', array(), array('absolute'=>true))); ?></p>
<p>Seus dados de acesso ao sistema:</p>
<table>
  <tr>
    <td align="right" style="text-align:right"><b>Email: </b></td>
    <td><?php echo $user->email ?></td>
  </tr> 
  <tr>
    <td align="right" style="text-align:right"><b>Senha: </b></td>
    <td><?php echo $password ?></td>
  </tr>
</table>
<p>
  Esta é uma mensagem eletrônica. Favor não responder.<br/>
  <b>Fibria - Portal de Sustentabilidade</b>
</p>


